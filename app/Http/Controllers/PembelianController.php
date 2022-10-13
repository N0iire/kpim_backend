<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Http\Requests\UpdatePembelianRequest;
use App\Http\Resources\KPIMResource;
use App\Models\Barang;
use App\MyConstant;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Pembelian::class);

        $pembelian = Pembelian::filter(request(['barang', 'catatan-beli', 'search']))->get();

        return response([
            'status' => true,
            'pembelian' => KPIMResource::collection($pembelian),
            'message' => 'Data pembelian berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Array $request)
    {
        $barang = (new BarangController)->store($request)->getOriginalContent();

        if($barang['status'] == false)
        {
            return response([
                'status' => false,
                'message' => $barang['message']
            ], MyConstant::BAD_REQUEST);
        }

        for($i = 0; $i < count($request['barang']); $i++)
        {
            $barang = Barang::where('nama_barang', $request['barang'][$i]['nama_barang'])
                            ->where('berat', $request['barang'][$i]['berat'])
                            ->first();

            $request['barang'][$i]['id_barang'] = $barang->id;
            $request['barang'][$i]['created_at'] = now()->toDateTimeString();
            $request['barang'][$i]['updated_at'] = now()->toDateTimeString();

            $validator = Validator::make($request['barang'][$i], [
                'id_catatanBeli' => 'required|integer|exists:catatan_belis,id',
                'id_barang' => 'required|integer|exists:barangs,id',
                'jumlah' => 'required|integer',
                'sub_total' => 'required',
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
        
        Pembelian::insert($validated);

        return response([
            'status' => true,
            'message' => 'Data pembelian berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        $this->authorize('view', $pembelian);

        return response([
            'status' => true,
            'pembelian' => $pembelian,
            'message' => 'Data pembelian berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePembelianRequest  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePembelianRequest $request, Pembelian $pembelian)
    {
        $this->authorize('update', $pembelian);

        $validated = $request->validated();

        $pembelian->update($validated);

        return response([
            'status' => true,
            'message' => 'Data pembelian berhasil diubah!'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        $this->authorize('delete', $pembelian);

        $pembelian->delete();

        return response([
            'status' => true,
            'message' => 'Data pembelian berhasil dihapus!'
        ], MyConstant::OK);
    }
}
