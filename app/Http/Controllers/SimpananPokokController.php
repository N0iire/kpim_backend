<?php

namespace App\Http\Controllers;

use App\Models\SimpananPokok;
use App\Http\Requests\StoreSimpananPokokRequest;
use App\Http\Requests\UpdateSimpananPokokRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class SimpananPokokController extends Controller
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
        $simpanan_pokok = SimpananPokok::all();

        $response = [
            'simpanan_pokok' => KPIMResource::collection($simpanan_pokok),
        ];

        return response($response, MyConstant::OK);
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimpananPokokRequest $request)
    {
        $simpanan_pokok = SimpananPokok::create($request->toArray());

        return response(
            [
                'simpanan_pokok' => new KPIMResource($simpanan_pokok),
                'message' => 'Simpanan Pokok berhasil ditambahkan!'
            ]
        , MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananPokok $simpananPokok)
    {
        return response([
            'simpanan_pokok' => new KPIMResource($simpananPokok),
            'message' => 'Berhasil mendapatkan data!'
        ], MyConstant::OK);
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpananPokokRequest $request, SimpananPokok $simpananPokok)
    {
        $simpananPokok->update($request->toArray());

        return response([
            'simpanan_pokok' => new KPIMResource($simpananPokok),
            'message' => 'Berhasil mengupdate data!'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananPokok $simpananPokok)
    {
        $simpananPokok->delete();

        return response(['message' => 'Deleted']);
    }
}
