<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use App\Http\Requests\StoreCicilanRequest;
use App\Http\Requests\UpdateCicilanRequest;

class CicilanController extends Controller
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
     * @param  \App\Http\Requests\StoreCicilanRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCicilanRequest $request, $id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function show(Cicilan $cicilan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function edit(Cicilan $cicilan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCicilanRequest  $request
     * @param  \App\Models\Cicilan  $cicilan
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCicilanRequest $request, Cicilan $cicilan, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cicilan $cicilan)
    {
        //
    }
}
