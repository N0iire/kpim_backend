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
        $this->authorize('viewAny', DetailNonPembelian::class);

        $nonPembelian = DetailNonPembelian::filter(request(['pengeluaran', 'search']))->get();

        return response([
            'status' => true,
            'detail_non_pembelian' => KPIMResource::collection($nonPembelian),
            'message' => 'Data detail non pembelian berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetailNonPembelianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailNonPembelianRequest $request)
    {
        $this->authorize('create', DetailNonPembelian::class);

        $validated = $request->validated();

        DetailNonPembelian::create($validated);

        return response([
            'status' => true,
            'message' => 'Data detail non pembelian berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailNonPembelian  $detailNonPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(DetailNonPembelian $detailNonPembelian)
    {
        $this->authorize('view', $detailNonPembelian);

        return response([
            'status' => true,
            'detail_non_pembelian' => new KPIMResource($detailNonPembelian),
            'message' => 'Data detail non pembelian berhasil ditemukan!'
        ], MyConstant::OK);
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
        $this->authorize('update', $detailNonPembelian);

        $validated = $request->validated();

        $detailNonPembelian->update($validated);

        return response([
            'status' => true,
            'detail_non_pembelian' => $detailNonPembelian,
            'message' => 'Data detail non pembelian berhasil diperbaharui'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailNonPembelian  $detailNonPembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailNonPembelian $detailNonPembelian)
    {
        $this->authorize('delete', $detailNonPembelian);

        $detailNonPembelian->delete();

        return response([
            'status' => true,
            'message' => 'Data detail non pembelian berhasil dihapus'
        ], MyConstant::OK);
    }
}
