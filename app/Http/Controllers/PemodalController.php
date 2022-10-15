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
        $this->authorize('viewAny', Pemodal::class);

        $pemodal = Pemodal::filter(request(['username', 'search']))->get();

        return response([
            'status' => true,
            'pemodal' => KPIMResource::collection($pemodal),
            'message' => 'Data pemodal berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePemodalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemodalRequest $request)
    {
<<<<<<< HEAD
=======
        $this->authorize('create', Pemodal::class);
>>>>>>> 0b1dd4f2eeaa538c035eb11330cba2e5e0742023

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
        $this->authorize('view', $pemodal);

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
        $this->authorize('update', $pemodal);

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
        $this->authorize('delete', $pemodal);

        $pemodal->delete();

        return response([
            'message' => 'Data berhasil dihapus'
        ], MyConstant::OK);
    }
}
