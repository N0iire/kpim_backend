<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatatanBeliRequest;
use App\Models\CatatanBeli;
use App\Http\Requests\UpdateCatatanBeliRequest;
use App\Http\Resources\KPIMResource;
use App\Models\User;
use App\MyConstant;

class CatatanBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catatanBeli = CatatanBeli::filter(request(['username', 'search']))->get();

        return response([
            'status' => true,
            'catatanBeli' => new KPIMResource($catatanBeli),
            'message' => 'Data catatan beli berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCatatanBeliRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCatatanBeliRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('username', $validated['username'])->first();
        $validated['id_user'] = $user->id;

        CatatanBeli::create($validated);

        $catatanBeli = CatatanBeli::orderBy('id', 'desc')->first();
        
        for($i = 0; $i < count($validated['barang']); $i++)
        {
            $validated['barang'][$i]['id_catatanBeli'] = $catatanBeli->id;
        }

        $pembelian = (new PembelianController)->store($validated)->getOriginalContent();

        if($pembelian['status'] == false)
        {
            return response([
                'status' => false,
                'message' => $pembelian['message']
            ], MyConstant::BAD_REQUEST);
        }

        return response([
            'status' => true,
            'message' => 'Data catatan beli berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function show(CatatanBeli $catatanBeli)
    {
        return response([
            'status' => true,
            'catatanBeli' => new KPIMResource($catatanBeli),
            'message' => 'Data catatan beli berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCatatanBeliRequest  $request
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCatatanBeliRequest $request, CatatanBeli $catatanBeli)
    {
        $validated = $request->validated();

        $catatanBeli->update($validated);

        return response([
            'status' => true,
            'message' => 'Data catatan beli berhasil diubah!'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatatanBeli  $catatanBeli
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatatanBeli $catatanBeli)
    {
        $catatanBeli->delete();

        return response([
            'status' => true,
            'message' => 'Data catatan beli berhasil dihapus!'
        ], MyConstant::OK);
    }
}
