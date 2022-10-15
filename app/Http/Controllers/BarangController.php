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
        $this->authorize('viewAny', Barang::class);

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
                'berat' => 'required|numeric',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'nullable|numeric',
            ]);
    
            if($validator->fails())
            {
                return response([
                    'status' => false,
                    'message' => $validator->errors()
                ], MyConstant::BAD_REQUEST);
            }

            $barang = Barang::where('nama_barang', $request['barang'][$i]['nama_barang'])
                            ->where('berat', $request['barang'][$i]['berat'])
                            ->first();

            if($barang)
            {
                $request['barang'][$i]['stok'] = $request['barang'][$i]['jumlah'] + $barang->stok;

                $barang->update($request['barang'][$i]);
            }else
            {
                $validated[] = $validator->validated();

                $key = count($validated) - 1;

                $validated[$key]['stok'] = $request['barang'][$i]['jumlah'];
                $validated[$key]['status'] = true;
                $validated[$key]['created_at'] = now()->toDateTimeString();
                $validated[$key]['updated_at'] = now()->toDateTimeString();
            }
        }
        
        if(isset($validated))
        {
            Barang::insert($validated);
        }

        return response([
            'status' => true,
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
        $this->authorize('view', $barang);

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
        $this->authorize('update', $barang);

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
        $this->authorize('delete', $barang);

        $barang->delete();

        return response([
            'status' => true,
            'message' => 'Data barang berhasil dihapus!'
        ], MyConstant::OK);
    }
}
