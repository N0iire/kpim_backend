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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', SimpananWajib::class);

        $simpananWajib = SimpananWajib::filter(request(['username', 'search']))->get();

        return response([
            'status' => true,
            'simpanan_wajib' => KPIMResource::collection($simpananWajib),
            'message' => 'Data simpanan wajib berhasil diambil!'
        ], MyConstant::OK);
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
        $this->authorize('create', SimpananWajib::class);

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
        $this->authorize('view', $simpananWajib);

        return response([
            'simpanan_wajib' => new KPIMResource($simpananWajib),
            'user' => new KPIMResource($simpananWajib->user),
            'message' => 'Data berhasil ditemukan!'
        ], MyConstant::OK);
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
        $this->authorize('update', $simpananWajib);

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
        $this->authorize('delete', $simpananWajib);

        $simpananWajib->delete();

        return response([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
