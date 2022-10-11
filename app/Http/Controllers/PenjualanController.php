<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Http\Resources\KPIMResource;
use App\Models\Barang;
use App\Models\User;
use App\MyConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::filter(request(['barang', 'catatan-jual', 'search']))->get();

        return response([
            'status' => true,
            'penjualan' => new KPIMResource($penjualan),
            'message' => 'Data penjualan berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenjualanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Array $request)
    {
        for($i = 0; $i < count($request['barang']); $i++)
        {
            $barang = Barang::where('id', $request['barang'][$i]['id_barang'])->first();

            if($request['barang'][$i]['jumlah'] > $barang->stok)
            {
                return response([
                    'status' => false,
                    'message' => 'Stok tidak cukup!'
                ], MyConstant::BAD_REQUEST);
            }

            $update['stok'] = $barang->stok - $request['barang'][$i]['jumlah'];

            $barang->update($update);

            $request['barang'][$i]['created_at'] = now()->toDateTimeString();
            $request['barang'][$i]['updated_at'] = now()->toDateTimeString();

            $validator = Validator::make($request['barang'][$i], [
                'id_catatanJual' => 'required|integer|exists:catatan_juals,id',
                'id_barang' => 'required|integer|exists:barangs,id',
                'jumlah' => 'required|integer',
                'sub_total' => 'required|numeric',
                'created_at' => 'required',
                'updated_at' => 'required'
            ]);

            if($validator->fails())
            {
                return response([
                    'status' => false,
                    'message' => $validator->errors()
                ], MyConstant::BAD_REQUEST);
            }

            $validated[] = $validator->validated();
        }

        Penjualan::insert($validated);

        return response([
            'status' => true,
            'message' => 'Data penjualan berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        return response([
            'status' => true,
            'penjualan' => new KPIMResource($penjualan),
            'message' => 'Data penjualan berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenjualanRequest  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        $validated = $request->validated();

        $penjualan->update($validated);

        return response([
            'status' => true,
            'message' => 'Data penjualan berhasil diubah!'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return response([
            'status' => true,
            'message' => 'Data penjualan berhasil dihapus!'
        ], MyConstant::OK);
    }
}
