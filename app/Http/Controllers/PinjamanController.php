<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Http\Requests\StorePinjamanRequest;
use App\Http\Requests\UpdatePinjamanRequest;

class PinjamanController extends Controller
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
     * @param  \App\Http\Requests\StorePinjamanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePinjamanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }
}
