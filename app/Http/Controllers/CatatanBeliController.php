<?php

namespace App\Http\Controllers;

use App\Models\CatatanBeli;
use App\Http\Requests\UpdateCatatanBeliRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Support\Facades\Validator;

class CatatanBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catatanBeli = CatatanBeli::filter(request(['username', 'search']))->get();

        return response([
            'status' => true,
            'catatanBeli' => new KPIMResource($catatanBeli),
            'message' => 'Data catatan beli berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCatatanBeliRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Array $request)
    {
        $validator = Validator::make($request, [
            'id_user' => 'required|integer|exists:users,id',
            'supplier' => 'required|string|min:3',
            'tgl_pembelian' => 'required|date',
            'total_pembelian' => 'required'
        ]);

        if($validator->fails())
        {
            return response([
                'status' => false,
                'message' => $validator->errors()
            ], MyConstant::BAD_REQUEST);
        }

        $validated = $validator->validated();

        CatatanBeli::create($validated);

        $catatanBeli = CatatanBeli::orderBy('id', 'desc')->first();

        return response([
            'status' => true,
            'id_catatanBeli' => $catatanBeli->id,
            'message' => 'Data catatan beli berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanBeli $catatanBeli)
    {
        return response([
            'status' => true,
            'catatanBeli' => new KPIMResource($catatanBeli),
            'message' => 'Data catatan beli berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCatatanBeliRequest  $request
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatatanBeliRequest $request, CatatanBeli $catatanBeli)
    {
        $validated = $request->validated();

        $catatanBeli->update($validated);

        return response([
            'status' => true,
            'message' => 'Data catatan beli berhasil diubah!'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanBeli $catatanBeli)
    {
        $catatanBeli->delete();

        return response([
            'status' => true,
            'message' => 'Data catatan beli berhasil dihapus!'
        ], MyConstant::OK);
    }
}
