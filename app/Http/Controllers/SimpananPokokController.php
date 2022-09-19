<?php

namespace App\Http\Controllers;

use App\Models\SimpananPokok;
use App\Http\Requests\StoreSimpananPokokRequest;
use App\Http\Requests\UpdateSimpananPokokRequest;

class SimpananPokokController extends Controller
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
     * @param  \App\Http\Requests\StoreSimpananPokokRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimpananPokokRequest $request, $id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananPokok $simpananPokok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function edit(SimpananPokok $simpananPokok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSimpananPokokRequest  $request
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpananPokokRequest $request, SimpananPokok $simpananPokok, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananPokok $simpananPokok)
    {
        //
    }
}
