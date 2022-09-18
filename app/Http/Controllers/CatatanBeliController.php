<?php

namespace App\Http\Controllers;

use App\Models\CatatanBeli;
use App\Http\Requests\StoreCatatanBeliRequest;
use App\Http\Requests\UpdateCatatanBeliRequest;

class CatatanBeliController extends Controller
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
     * @param  \App\Http\Requests\StoreCatatanBeliRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatatanBeliRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanBeli $catatanBeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function edit(CatatanBeli $catatanBeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCatatanBeliRequest  $request
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatatanBeliRequest $request, CatatanBeli $catatanBeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanBeli $catatanBeli)
    {
        //
    }
}
