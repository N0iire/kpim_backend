<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Http\Requests\StorePinjamanRequest;
use App\Http\Requests\UpdatePinjamanRequest;
use App\Http\Resources\KPIMResource;
use App\Models\User;
use App\MyConstant;
use App\Services\Midtrans\CreateSnapTokenService;
use Carbon\Carbon;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Pinjaman::class);

        $pinjaman = Pinjaman::filter(request(['username', 'search', 'reminder']))->get();
        
        if(auth()->user()->jabatan->value == 'anggota')
        {
            $check = $pinjaman->toArray();

            for($i = 0; $i < count($check); $i++)
            {
                if($check[$i]['id_user'] != auth()->user()->id)
                {
                    return response([
                        'status' => false,
                        'message' => 'This action is unathorized!'
                    ], MyConstant::FORBIDDEN);
                }
            }
        }

        return response([
            'status' => true,
            'pinjaman' => KPIMResource::collection($pinjaman),
            'message' => 'Data pinjaman berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePinjamanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePinjamanRequest $request)
    {
        $this->authorize('create', Pinjaman::class);

        $validated = $request->validated();

        $user = User::where('username', $validated['username'])->first();

        $validated['id_user'] = $user->id;
        $validated['nominal_cicilan'] = $validated['total_pinjaman'] / $validated['durasi_cicilan'];
        $validated['jatuh_tempo'] = Carbon::createFromDate($validated['tgl_pinjaman'])->addDays(30);
        $validated['sisa_cicilan'] = $validated['total_pinjaman'];

        Pinjaman::create($validated);

        $pinjaman = Pinjaman::orderBy('id', 'desc')->first();

        for($i = 0; $i < count($validated['barang']); $i++)
        {
            $validated['barang'][$i]['id_pinjaman'] = $pinjaman->id;
        }

        $detailPinjaman = (new DetailPinjamanController)->store($validated)->getOriginalContent();

        if($detailPinjaman['status'] == false)
        {
            return response([
                'status' => false,
                'message' => $detailPinjaman['message']
            ], MyConstant::BAD_REQUEST);
        }

        return response([
            'status' => true,
            'message' => 'Data pinjaman berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        $this->authorize('view', $pinjaman);

        return response([
            'status' => true,
            'pinjaman' => new KPIMResource($pinjaman),
            'user' => new KPIMResource($pinjaman->user),
            'message' => 'Data berhasil ditemukan'
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePinjamanRequest  $request
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePinjamanRequest $request, Pinjaman $pinjaman)
    {
        $this->authorize('update', $pinjaman);

        $validated = $request->validated();

        $user = User::where('username', $validated['username'])->first();
        $validated['id_user'] = $user->id;

        if($validated['durasi_cicilan'] != $pinjaman->durasi_cicilan && $validated['total_pinjaman'] != $pinjaman->total_pinjaman)
        {
            $validated['nominal_cicilan'] = $validated['total_pinjaman'] / $validated['durasi_cicilan'];

            if($pinjaman->sisa_cicilan != $pinjaman->total_pinjaman)
            {
                $validated['sisa_cicilan'] = $validated['total_pinjaman'] - ($pinjaman->total_pinjaman - $pinjaman->sisa_cicilan);
            }else
            {
                $validated['sisa_cicilan'] = $validated['total_pinjaman'];
            }
        }else if($validated['durasi_cicilan'] != $pinjaman->durasi_cicilan)
        {
            $validated['nominal_cicilan'] = $validated['total_pinjaman'] / $validated['durasi_cicilan'];
        }else if($validated['total_pinjaman'] != $pinjaman->total_pinjaman)
        {
            if($pinjaman->sisa_cicilan != $pinjaman->total_pinjaman)
            {
                $validated['sisa_cicilan'] = $validated['total_pinjaman'] - ($pinjaman->total_pinjaman - $pinjaman->sisa_cicilan);
            }else
            {
                $validated['sisa_cicilan'] = $validated['total_pinjaman'];
            }
        }

        $pinjaman->update($validated);

        for($i = 0; $i < count($validated['barang']); $i++)
        {
            if(!$validated['barang'][$i]['id_detailPinjaman'])
            {
                $validated['barang'][$i]['id_pinjaman'] = $pinjaman->id;

                $detailPinjaman = (new DetailPinjamanController)->store($validated)->getOriginalContent();

                if($detailPinjaman['status'] == false)
                {
                    return response([
                        'status' => false,
                        'message' => $detailPinjaman['message']
                    ], MyConstant::BAD_REQUEST);
                }
            }
        }

        return response([
            'status' => true,
            'message' => 'Data pinjaman berhasil diperbaharui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        $this->authorize('delete', $pinjaman);

        $pinjaman->delete();

        return response([
            'status' => true,
            'message' => 'Data pinjaman berhasil dihapus'
        ], MyConstant::OK);
    }

    public function paymentSuccess(Pinjaman $pinjaman)
    {
        $dataCicilan = [
            'id_pinjaman' => $pinjaman->id,
            'tgl_bayar' => now()->toDateTimeString(),
            'nominal_bayar' => $pinjaman->nominal_cicilan
        ];
        $cicilan = (new CicilanController)->store($dataCicilan)->getOriginalContent();

        if($cicilan['status'] == false)
        {
            return response([
                'status' => false,
                'message' => $cicilan['message']
            ], MyConstant::BAD_REQUEST);
        }

        $jatuhTempo = Carbon::createFromDate($pinjaman->jatuh_tempo);
        $overTempo = PinjamanController::overTempo($pinjaman, $jatuhTempo);
        
        $update['sisa_cicilan'] = $pinjaman->sisa_cicilan - $pinjaman->nominal_cicilan;

        if($update['sisa_cicilan'] != 0 && $overTempo == false)
        {
            $update['jatuh_tempo'] = $jatuhTempo->addDays(30);
        }
        if($update['sisa_cicilan'] == 0 || $update['sisa_cicilan'] < 0)
        {
            $update['status'] = true;
        }

        $pinjaman->update($update);

        return response([
            'status' => true,
            'message' => 'Cicilan berhasil dibayar!'
        ], MyConstant::OK);
    }

    public function overTempo(Pinjaman $pinjaman, Carbon $jatuhTempo)
    {
        $maxDays = $pinjaman->durasi_cicilan * 30;
        $tgl_akhir = Carbon::createFromDate($pinjaman->tgl_pinjaman)->addDays($maxDays);

        if($jatuhTempo->gt($tgl_akhir))
        {
            return true;
        }

        return false;
    }
}
