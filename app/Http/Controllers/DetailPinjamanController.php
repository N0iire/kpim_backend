<?php

namespace App\Http\Controllers;

use App\Models\DetailPinjaman;
use App\Http\Requests\StoreDetailPinjamanRequest;
use App\Http\Requests\UpdateDetailPinjamanRequest;

class DetailPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreDetailPinjamanRequest  $request
     * @param  $id1
     * @param  $id2
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailPinjamanRequest $request, $id1, $id2)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPinjaman $detailPinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailPinjaman $detailPinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetailPinjamanRequest  $request
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @param  $id1
     * @param  $id2
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetailPinjamanRequest $request, DetailPinjaman $detailPinjaman, $id1, $id2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPinjaman $detailPinjaman)
    {
        //
    }
}
