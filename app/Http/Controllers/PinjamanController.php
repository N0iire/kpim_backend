<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Http\Requests\StorePinjamanRequest;
use App\Http\Requests\UpdatePinjamanRequest;
use App\Http\Resources\KPIMResource;
use App\Models\User;
use App\MyConstant;
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
        $pinjaman = Pinjaman::filter(request(['username', 'search']))->get();

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
        $validated = $request->validated();

        $user = User::where('username', $validated['username'])->first();

        $validated['id_user'] = $user->id;
        $validated['nominal_cicilan'] = $validated['total_pinjaman'] / $validated['durasi_cicilan'];
        $validated['jatuh_tempo'] = Carbon::createFromDate($validated['tgl_pinjaman'])->addDays(30);
        $validated['status'] = false;
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
        return response([
            'status' => true,
            'pinjaman' => new KPIMResource($pinjaman),
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
        $validated = $request->validated();

        $pinjaman->update($validated);

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
        $pinjaman->delete();

        return response([
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function bayarCicilan(Pinjaman $pinjaman)
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

    public function reminderCicilan(Pinjaman $pinjaman)
    {
        $jatuhTempo = Carbon::createFromDate($pinjaman->jatuh_tempo);
        $now = now()->toDateTimeString();

        if($jatuhTempo->lt($now))
        {
            return response([
                'status' => false,
                'jatuhTempo' => $jatuhTempo,
                'message' => 'Jatuh tempo sudah terlewat!'
            ], MyConstant::OK);
        }

        return response([
            'status' => true,
            'jatuhTempo' => $jatuhTempo,
            'message' => 'Jatuh tempo belum terlewat!'
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
