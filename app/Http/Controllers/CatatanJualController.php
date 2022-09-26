<?php

namespace App\Http\Controllers;

use App\Models\CatatanJual;
use App\Http\Requests\UpdateCatatanJualRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Support\Facades\Validator;

class CatatanJualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catatanJual = CatatanJual::all();

        return response([
            'status' => true,
            'catatanJual' => KPIMResource::collection($catatanJual),
            'message' => 'Data catatan jual berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCatatanJualRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Array $request)
    {
        $validator = Validator::make($request, [
            'id_user' => 'required|integer|exists:users,id',
            'nama_pembeli' => 'required|string|min:3',
            'tgl_penjualan' => 'required|date',
            'total_penjualan' => 'required'
        ]);

        if($validator->fails())
        {
            return response([
                'status' => false,
                'message' => $validator->errors()
            ], MyConstant::BAD_REQUEST);
        }

        $validated = $validator->validated();

        CatatanJual::create($validated);

        $catatanJual = CatatanJual::orderBy('id', 'desc')->first();

        return response([
            'status' => true,
            'id_catatanJual' => $catatanJual->id,
            'message' => 'Data catatan jual berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatatanJual  $catatanJual
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanJual $catatanJual)
    {
        return response([
            'status' => true,
            'catatanJual' => $catatanJual,
            'message' => 'Data catatan jual berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCatatanJualRequest  $request
     * @param  \App\Models\CatatanJual  $catatanJual
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatatanJualRequest $request, CatatanJual $catatanJual)
    {
        $validated = $request->validated();

        $catatanJual->update($validated);

        return response([
            'status' => true,
            'message' => 'Data catatan jual berhasil diubah!'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanJual  $catatanJual
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanJual $catatanJual)
    {
        $catatanJual->delete();

        return response([
            'status' => true,
            'message' => 'Data catatan jual berhasil dihapus!'
        ], MyConstant::OK);
    }
}
