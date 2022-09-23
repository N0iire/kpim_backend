<?php

namespace App\Http\Controllers;

use App\Models\DetailPinjaman;
use App\Http\Requests\StoreDetailPinjamanRequest;
use App\Http\Requests\UpdateDetailPinjamanRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class DetailPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailPinjaman = DetailPinjaman::all();

        return response([
            'detail_pinjaman' => KPIMResource::collection($detailPinjaman),
            'pinjaman' => KPIMResource::collection($detailPinjaman)
        ], MyConstant::OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetailPinjamanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailPinjamanRequest $request)
    {
        $detailPinjaman = DetailPinjaman::create($request->toArray());

        return response([
            'detail_pinjaman' => new KPIMResource($detailPinjaman),
            'message' => 'Data berhasil disimpan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPinjaman $detailPinjaman)
    {
        return response([
            'detail_pinjaman' => new KPIMResource($detailPinjaman),
            'pinjaman' => new KPIMResource($detailPinjaman->pinjaman),
            'barang' => new KPIMResource($detailPinjaman->barang),
            'message' => 'Data berhasil ditemukan'
        ], MyConstant::OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetailPinjamanRequest  $request
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetailPinjamanRequest $request, DetailPinjaman $detailPinjaman)
    {
        $detailPinjaman->update($request->toArray());

        return response([
            'detail_pinjaman' => new KPIMResource($detailPinjaman),
            'message' => 'Data berhasil diperbaharui'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPinjaman $detailPinjaman)
    {
        $detailPinjaman->delete();

        return response([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
