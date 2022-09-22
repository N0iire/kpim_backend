<?php

namespace App\Http\Controllers;

use App\Models\SimpananWajib;
use App\Http\Requests\StoreSimpananWajibRequest;
use App\Http\Requests\UpdateSimpananWajibRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class SimpananWajibController extends Controller
{

    /**
     * Create a new ApiAuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $simpananWajib = SimpananWajib::all();

        return response([
            'simpanan_wajib' => KPIMResource::collection($simpananWajib),
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
     * @param  \App\Http\Requests\StoreSimpananWajibRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimpananWajibRequest $request)
    {
        $simpananWajib = SimpananWajib::create($request->toArray());

        return response([
            'simpanan_wajib' => new KPIMResource($simpananWajib),
            'message' => 'Data berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananWajib $simpananWajib)
    {
        return response([
            'simpanan_wajib' => new KPIMResource($simpananWajib),
            'message' => 'Data berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function edit(SimpananWajib $simpananWajib)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSimpananWajibRequest  $request
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpananWajibRequest $request, SimpananWajib $simpananWajib)
    {
        $simpananWajib->update($request->toArray());

        return response([
            'simpanan_wajib' => new KPIMResource($simpananWajib),
            'message' => 'Data berhasil diperbaharui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananWajib $simpananWajib)
    {
        $simpananWajib->delete();

        return response([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
