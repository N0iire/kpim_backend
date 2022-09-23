<?php

namespace App\Http\Controllers;

use App\Models\DetailNonPembelian;
use App\Http\Requests\StoreDetailNonPembelianRequest;
use App\Http\Requests\UpdateDetailNonPembelianRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class DetailNonPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nonPembelian = DetailNonPembelian::all();

        return response([
            'detail_non_pembelian' => $nonPembelian,
        ], MyConstant::OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetailNonPembelianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailNonPembelianRequest $request)
    {
        $nonPembelian = DetailNonPembelian::create($request->toArray());

        return response([
            'detail_non_pembelian' => $nonPembelian,
            'message' => 'Data berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailNonPembelian  $detailNonPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(DetailNonPembelian $detailNonPembelian)
    {
        return response([
            'detail_non_pembelian' => new KPIMResource($detailNonPembelian),
            'pengeluaran' => new KPIMResource($detailNonPembelian->pengeluaran),
            'message' => 'Data berhasil ditemukan!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetailNonPembelianRequest  $request
     * @param  \App\Models\DetailNonPembelian  $detailNonPembelian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetailNonPembelianRequest $request, DetailNonPembelian $detailNonPembelian)
    {
        $detailNonPembelian->update($request->toArray());

        return response([
            'detail_non_pembelian' => $detailNonPembelian,
            'message' => 'Data berhasil diperbaharui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailNonPembelian  $detailNonPembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailNonPembelian $detailNonPembelian)
    {
        $detailNonPembelian->delete();

        return response([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
