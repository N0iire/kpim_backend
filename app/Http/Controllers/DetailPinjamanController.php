<?php

namespace App\Http\Controllers;

use App\Models\DetailPinjaman;
use App\Http\Requests\UpdateDetailPinjamanRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
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
        $this->authorize('viewAny', DetailPinjaman::class);

        $detailPinjaman = DetailPinjaman::filter(['pinjaman', 'barang', 'search'])->get();

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
            $request['barang'][$i]['created_at'] = now()->toDateTimeString();
            $request['barang'][$i]['updated_at'] = now()->toDateTimeString();

            $validator = Validator::make($request['barang'][$i], [
                'id_pinjaman' => 'required|integer|exists:pinjamans,id',
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
        
        DetailPinjaman::insert($validated);

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
        $this->authorize('view', $detailPinjaman);

        return response([
            'status' => true,
            'detail_pinjaman' => new KPIMResource($detailPinjaman),
            'message' => 'Data pinjaman berhasil ditemukan!'
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
        $this->authorize('update', $detailPinjaman);

        $validated = $request->validated();

        $detailPinjaman->update($validated);

        return response([
            'status' => true,
            'message' => 'Data pinjaman berhasil diperbaharui!'
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
        $this->authorize('delete', $detailPinjaman);

        $detailPinjaman->delete();

        return response([
            'status' => true,
            'message' => 'Data pinjaman berhasil dihapus!'
        ], MyConstant::OK);
    }
}
