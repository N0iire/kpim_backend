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
        $this->authorize('viewAny', CatatanBeli::class);

        $catatanBeli = CatatanBeli::filter(request(['username', 'search']))->get();

        return response([
            'status' => true,
            'catatanBeli' => KPIMResource::collection($catatanBeli),
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
        $this->authorize('create', CatatanBeli::class);

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
        $this->authorize('view', $catatanBeli);

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
        $this->authorize('update', $catatanBeli);

        $validated = $request->validated();

        $catatanBeli->update($validated);

        for($i = 0; $i < count($validated['barang']); $i++)
        {
            if(!$validated['barang'][$i]['id_penjualan'])
            {
                $validated['barang'][$i]['id_catatanBeli'] = $catatanBeli->id;

                $pembelian = (new PembelianController)->store($validated)->getOriginalContent();

                if($pembelian['status'] == false)
                {
                    return response([
                        'status' => false,
                        'message' => $pembelian['message']
                    ], MyConstant::BAD_REQUEST);
                }
            }
        }

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
        $this->authorize('delete', $catatanBeli);

        $catatanBeli->delete();

        return response([
            'status' => true,
            'message' => 'Data catatan beli berhasil dihapus!'
        ], MyConstant::OK);
    }
}
