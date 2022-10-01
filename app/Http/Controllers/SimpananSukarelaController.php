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
        $this->authorize('can-viewAny-simpanan');
        $simpananSukarela = SimpananSukarela::all();

        return response([
            'simpanan_sukarela' => KPIMResource::collection($simpananSukarela)
        ], MyConstant::OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSimpananSukarelaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimpananSukarelaRequest $request)
    {
        $this->authorize('can-create-simpanan');
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
        $this->authorize('can-view-simpanan');
        return response([
            'simpanan_sukarela' => new KPIMResource($simpananSukarela),
            'user' => new KPIMResource($simpananSukarela->user),
            'message' => 'Data berhasil ditemukan!'
        ], MyConstant::OK);
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
        $this->authorize('can-update-simpanan');

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
        $this->authorize('can-delete-simpanan');

        $simpananSukarela->delete();

        return response([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
