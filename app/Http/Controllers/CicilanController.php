<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use App\Http\Requests\StoreCicilanRequest;
use App\Http\Requests\UpdateCicilanRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class CicilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cicilan = Cicilan::all();

        return response([
            'cicilan' => KPIMResource::collection($cicilan),
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
     * @param  \App\Http\Requests\StoreCicilanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCicilanRequest $request)
    {
        $cicilan = Cicilan::create($request->toArray());

        return response([
            'cicilan' => new KPIMResource($cicilan),
            'message' => 'Data berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function show(Cicilan $cicilan)
    {
        return response([
            'cicilan' => new KPIMResource($cicilan),
            'message' => 'Data berhasil ditemukan!'
        ], MyConstant::OK);
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCicilanRequest $request, Cicilan $cicilan)
    {
        $cicilan->update($request->toArray());

        return response([
            'cicilan' => new KPIMResource($cicilan),
            'message' => 'Data berhasil diperbaharui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cicilan $cicilan)
    {
        $cicilan->delete();

        return response([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
