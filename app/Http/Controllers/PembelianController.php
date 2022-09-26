<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Http\Requests\UpdatePembelianRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Http\Request;
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
        $pembelian = Pembelian::all();

        return response([
            'status' => true,
            'pembelian' => KPIMResource::collection($pembelian),
            'message' => 'Data pembelian berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePembelianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();

        $catatanBeli = (new CatatanBeliController)->store($all)->getOriginalContent();
        
        if($catatanBeli['status'] == true)
        {
            $barang = (new BarangController)->store($all)->getOriginalContent();

            if($barang['status'] == true)
            {
                $id_barang = 1;

                if($barang['id_barang'])
                {
                    $id_barang = $barang['id_barang'] + 1;
                }

                for($i = 0; $i < count($all['barang']); $i++)
                {
                    $pembelian[] = [
                        'id_catatanBeli' => $catatanBeli['id_catatanBeli'],
                        'id_barang' => $id_barang,
                        'jumlah' => $all['barang'][$i]['jumlah'],
                        'sub_total' => $all['barang'][$i]['sub_total'],
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ];

                    $validator = Validator::make($pembelian[$i], [
                        'id_catatanBeli' => 'required|integer|exists:catatan_belis,id',
                        'id_barang' => 'required|integer|exists:barangs,id',
                        'jumlah' => 'required|integer',
                        'sub_total' => 'required',
                    ]);

                    if($validator->fails())
                    {
                        return response([
                            'status' => false,
                            'message' => $validator->errors()
                        ], MyConstant::BAD_REQUEST);
                    }

                    $id_barang++;
                }
            }else
            {
                return response([
                    'status' => false,
                    'message' => $barang['message']
                ], MyConstant::BAD_REQUEST);
            }
        }else
        {
            return response([
                'status' => false,
                'message' => $catatanBeli['message']
            ], MyConstant::BAD_REQUEST);
        }

        Pembelian::insert($pembelian);

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
        $pembelian->delete();

        return response([
            'status' => true,
            'message' => 'Data pembelian berhasil dihapus!'
        ], MyConstant::OK);
    }
}
