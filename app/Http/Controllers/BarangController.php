<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\UpdateBarangRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::filter(request('search'))->get();

        return response([
            'status' => true,
            'barang' => KPIMResource::collection($barang),
            'message' => 'Data barang berhasil diambil!',
        ], MyConstant::OK);
    }

    public function store(Array $request)
    {
        for($i = 0; $i < count($request['barang']); $i++)
        {
            $validator = Validator::make($request['barang'][$i], [
                'nama_barang' => 'required|string|min:3',
                'jenis_barang' => 'required|string|min:3',
                'satuan' => 'nullable|string|min:2',
                'stok' => 'required|integer',
                'status' => 'required|boolean',
                'berat' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
                'harga_beli' => 'required',
                'harga_jual' => 'nullable',
            ]);
    
            if($validator->fails())
            {
                return response([
                    'status' => false,
                    'message' => $validator->errors()
                ], MyConstant::BAD_REQUEST);
            }

            $request['barang'][$i]['created_at'] = now()->toDateTimeString();
            $request['barang'][$i]['updated_at'] = now()->toDateTimeString();
            unset($request['barang'][$i]['jumlah']);
            unset($request['barang'][$i]['sub_total']);
        }

        $validated = $request['barang'];
        $barang = Barang::orderBy('id', 'desc')->first();

        Barang::insert($validated);

        return response([
            'status' => true,
            'id_barang' => $barang->id,
            'message' => 'Data barang berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return response([
            'status' => true,
            'barang' => new KPIMResource($barang),
            'message' => 'Data barang berhasil ditemukan!'
        ],MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $validated = $request->validated();

        $barang->update($validated);

        return response([
            'status' => true,
            'message' => 'Data barang berhasil diperbarui!'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return response([
            'status' => true,
            'message' => 'Data barang berhasil dihapus!'
        ], MyConstant::OK);
    }
}
