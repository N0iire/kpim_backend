<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatatanJualRequest;
use App\Models\CatatanJual;
use App\Http\Requests\UpdateCatatanJualRequest;
use App\Http\Resources\KPIMResource;
use App\Models\Barang;
use App\Models\User;
use App\MyConstant;

class CatatanJualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catatanJual = CatatanJual::filter(request(['username', 'search']))->get();

        return response([
            'status' => true,
            'catatanJual' => new KPIMResource($catatanJual),
            'message' => 'Data catatan jual berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCatatanJualRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatatanJualRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('username', $validated['username'])->first();
        $validated['id_user'] = $user->id;

        CatatanJual::create($validated);

        $catatanJual = CatatanJual::orderBy('id', 'desc')->first();
        
        for($i = 0; $i < count($validated['barang']); $i++)
        {
            $validated['barang'][$i]['id_catatanJual'] = $catatanJual->id;
        }

        $penjualan = (new PenjualanController)->store($validated)->getOriginalContent();

        if($penjualan['status'] == false)
        {
            return response([
                'status' => false,
                'message' => $penjualan['message']
            ], MyConstant::BAD_REQUEST);
        }

        return response([
            'status' => true,
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

        $user = User::where('username', $validated['username'])->first();
        $validated['id_user'] = $user->id;

        $catatanJual->update($validated);

        for($i = 0; $i < count($validated['barang']); $i++)
        {
            if(!isset($validated['barang'][$i]['id_penjualan']))
            {
                $store['barang'][] = [
                    'id_catatanJual' => $catatanJual->id,
                    'id_barang' => $validated['barang'][$i]['id_barang'],
                    'jumlah' => $validated['barang'][$i]['jumlah'],
                    'sub_total' => $validated['barang'][$i]['sub_total']
                ];
            }
        }

        $penjualan = (new PenjualanController)->store($store)->getOriginalContent();

        if($penjualan['status'] == false)
        {
            return response([
                'status' => false,
                'message' => $penjualan['message']
            ], MyConstant::BAD_REQUEST);
        }

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
