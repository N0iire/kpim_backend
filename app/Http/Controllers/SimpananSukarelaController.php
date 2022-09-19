<?php

namespace App\Http\Controllers;

use App\Models\SimpananSukarela;
use App\Http\Requests\StoreSimpananSukarelaRequest;
use App\Http\Requests\UpdateSimpananSukarelaRequest;

class SimpananSukarelaController extends Controller
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
     * @param  \App\Http\Requests\StoreSimpananSukarelaRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimpananSukarelaRequest $request, $id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananSukarela $simpananSukarela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Http\Response
     */
    public function edit(SimpananSukarela $simpananSukarela)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSimpananSukarelaRequest  $request
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpananSukarelaRequest $request, SimpananSukarela $simpananSukarela, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananSukarela $simpananSukarela)
    {
        //
    }
}
