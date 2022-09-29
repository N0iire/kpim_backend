<?php

namespace App\Http\Controllers;

use App\Models\DetailPinjaman;
use App\Http\Requests\StoreDetailPinjamanRequest;
use App\Http\Requests\UpdateDetailPinjamanRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DetailPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailPinjaman = DetailPinjaman::all();

        return response([
            'status' => true,
            'detail_pinjaman' => KPIMResource::collection($detailPinjaman),
            'message' => 'Data detail pinjaman berhasil diambil!'
        ], MyConstant::OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDetailPinjamanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Array $request)
    {   
        for($i = 0; $i < count($request['barang']); $i++)
        {
            $detailPinjaman[] = [
                'id_barang' => $request['barang'][$i]['id'],
                'id_pinjaman' => $request['barang'][$i]['id_pinjaman'],
                'jumlah' => $request['barang'][$i]['jumlah'],
                'sub_total' => $request['barang'][$i]['sub_total'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];

            $validator = Validator::make($detailPinjaman[$i], [
                'id_pinjaman' => 'required|integer|exists:pinjamans,id',
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
        
        DetailPinjaman::insert($detailPinjaman);

        return response([
            'status' => true,
            'message' => 'Data detail pinjaman berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPinjaman $detailPinjaman)
    {
        return response([
            'detail_pinjaman' => new KPIMResource($detailPinjaman),
            'pinjaman' => new KPIMResource($detailPinjaman->pinjaman),
            'barang' => new KPIMResource($detailPinjaman->barang),
            'message' => 'Data berhasil ditemukan'
        ], MyConstant::OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDetailPinjamanRequest  $request
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDetailPinjamanRequest $request, DetailPinjaman $detailPinjaman)
    {
        $detailPinjaman->update($request->toArray());

        return response([
            'detail_pinjaman' => new KPIMResource($detailPinjaman),
            'message' => 'Data berhasil diperbaharui'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailPinjaman  $detailPinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPinjaman $detailPinjaman)
    {
        $detailPinjaman->delete();

        return response([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
