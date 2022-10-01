<?php

namespace App\Http\Controllers;

use App\Models\SimpananWajib;
use App\Http\Requests\StoreSimpananWajibRequest;
use App\Http\Requests\UpdateSimpananWajibRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Support\Facades\Auth;

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
        $this->authorize('can-viewAny-simpanan');
        $simpananWajib = SimpananWajib::all();

        return response([
            'simpanan_wajib' => KPIMResource::collection($simpananWajib),
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
        $this->authorize('can-created-simpanan');
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
        $this->authorize('can-view-simpanan');
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
        $this->authorize('can-update-simpanan');
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
        $this->authorize('can-delete-simpanan');
        $simpananWajib->delete();

        return response([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
