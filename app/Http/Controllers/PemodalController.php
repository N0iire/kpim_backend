<?php

namespace App\Http\Controllers;

use App\Models\Pemodal;
use App\Http\Requests\StorePemodalRequest;
use App\Http\Requests\UpdatePemodalRequest;

class PemodalController extends Controller
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
     * @param  \App\Http\Requests\StorePemodalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemodalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Http\Response
     */
    public function show(Pemodal $pemodal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemodal $pemodal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePemodalRequest  $request
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePemodalRequest $request, Pemodal $pemodal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemodal $pemodal)
    {
        //
    }
}
