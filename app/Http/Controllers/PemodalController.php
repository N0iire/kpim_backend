<?php

namespace App\Http\Controllers;

use App\Models\Pemodal;
use App\Http\Requests\StorePemodalRequest;
use App\Http\Requests\UpdatePemodalRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class PemodalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemodal = Pemodal::all();

        return response([
            'pemodal' => KPIMResource::collection($pemodal),
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
     * @param  \App\Http\Requests\StorePemodalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemodalRequest $request)
    {
        $pemodal = Pemodal::create($request->toArray());

        return response([
            'pemodal' => new KPIMResource($pemodal),
            'message' => 'Data berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Http\Response
     */
    public function show(Pemodal $pemodal)
    {
        return response([
            'pemodal' => new KPIMResource($pemodal->toArray()),
            'message' => 'Data berhasil ditemukan!'
        ], MyConstant::OK);
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
        $pemodal->update($request->toArray());

        return response([
            'pemodal' => new KPIMResource($pemodal),
            'message' => 'Data berhasil diperbaharui'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemodal  $pemodal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemodal $pemodal)
    {
        $pemodal->delete();

        return response([
            'message' => 'Data berhasil dihapus'
        ], MyConstant::OK);
    }
}
