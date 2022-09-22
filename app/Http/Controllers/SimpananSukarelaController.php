<?php

namespace App\Http\Controllers;

use App\Models\SimpananSukarela;
use App\Http\Requests\StoreSimpananSukarelaRequest;
use App\Http\Requests\UpdateSimpananSukarelaRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class SimpananSukarelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $simpananSukarela = SimpananSukarela::all();

        return response([
            'simpanan_sukarela' => KPIMResource::collection($simpananSukarela)
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
     * @param  \App\Http\Requests\StoreSimpananSukarelaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimpananSukarelaRequest $request)
    {
        $simpananSukarela = SimpananSukarela::create($request->toArray());

        return response([
            'simpanan_sukarela' => new KPIMResource($simpananSukarela),
            'message' => 'Data berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananSukarela $simpananSukarela)
    {
        return response([
            'simpanan_sukarela' => new KPIMResource($simpananSukarela),
            'message' => 'Data berhasil ditemukan!'
        ], MyConstant::OK);
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpananSukarelaRequest $request, SimpananSukarela $simpananSukarela)
    {
        $simpananSukarela->update($request->toArray());

        return response([
            'simpanan_sukarela' => new KPIMResource($simpananSukarela),
            'message' => 'Data berhasil diperbaharui'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananSukarela $simpananSukarela)
    {
        $simpananSukarela->delete();

        return response([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
