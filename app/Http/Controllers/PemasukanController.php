<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;

class PemasukanController extends Controller
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
     * @param  \App\Http\Requests\StorePemasukanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemasukanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePemasukanRequest  $request
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePemasukanRequest $request, Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasukan $pemasukan)
    {
        //
    }
}
