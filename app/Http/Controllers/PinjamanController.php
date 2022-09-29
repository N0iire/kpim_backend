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
        $pinjaman = Pinjaman::all();

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
        $pinjaman->update($request->toArray());

        return response([
            'status' => true,
            'pinjaman' => new KPIMResource($pinjaman),
            'message' => 'Data berhasil diperbaharui'
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

    public function detailPinjaman(Pinjaman $pinjaman)
    {
        $detailPinjaman = $pinjaman->detail_pinjaman;
        
        return response([
            'status' => true,
            'detailPinjaman' => new KPIMResource($detailPinjaman),
            'message' => 'Data detail pinjaman berhasil diambil!'
        ], MyConstant::OK);
    }

    public function cicilan(Pinjaman $pinjaman)
    {
        $cicilan = $pinjaman->cicilan;

        return response([
            'status' => true,
            'cicilan' => new KPIMResource($cicilan),
            'message' => 'Data cicilan berhasil diambil!'
        ], MyConstant::OK);
    }

    public function reminderCicilan(Pinjaman $pinjaman)
    {
        $jatuhTempo = Carbon::createFromTimestamp($pinjaman->jatuh_tempo);
        $now = Carbon::createFromTimestamp(Carbon::now()->toDateTimeString());

        $result = $now->eq($jatuhTempo);

        return response([
            'status' => true,
            'jatuhTempo' => $jatuhTempo,
            'message' => 'Data jatuh tempo berhasil dibuat!'
        ], MyConstant::OK);
    }

    public function bayarCicilan()
    {
        
    }
}
