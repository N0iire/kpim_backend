<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Http\Resources\KPIMResource;
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
        $penjualan = Penjualan::all();

        return response([
            'status' => true,
            'penjualan' => KPIMResource::collection($penjualan),
            'message' => 'Data penjualan berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenjualanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();

        $catatanJual = (new CatatanJualController)->store($all)->getOriginalContent();

        if($catatanJual['status'] == true)
        {
            for($i = 0; $i < count($all['barang']); $i++)
            {
                $penjualan[] = [
                    'id_catatanJual' => $catatanJual['id_catatanJual'],
                    'id_barang' => $all['barang'][$i]['id'],
                    'jumlah' => $all['barang'][$i]['jumlah'],
                    'sub_total' => $all['barang'][$i]['sub_total'],
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString()
                ];

                $validator = Validator::make($penjualan[$i], [
                    'id_catatanJual' => 'required|integer|exists:catatan_juals,id',
                    'id_barang' => 'required|integer|exists:barangs,id',
                    'jumlah' => 'required|integer',
                    'sub_total' => 'required'
                ]);

                if($validator->fails())
                {
                    return response([
                        'status' => false,
                        'message' => $validator->errors()
                    ], MyConstant::BAD_REQUEST);
                }
            }
        }else
        {
            return response([
                'status' => false,
                'message' => $catatanJual['message']
            ], MyConstant::BAD_REQUEST);
        }

        Penjualan::insert($penjualan);

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
