<?php

namespace App\Http\Controllers;

use App\Models\SimpananWajib;
use App\Http\Requests\StoreSimpananWajibRequest;
use App\Http\Requests\UpdateSimpananWajibRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Http\Request;

class SimpananWajibController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', SimpananWajib::class);

        $simpananWajib = SimpananWajib::filter(request(['username', 'search', 'reminder']))->get();

        if(auth()->user()->jabatan->value == 'anggota')
        {
            $check = $simpananWajib->toArray();

            for($i = 0; $i < count($check); $i++)
            {
                if($check[$i]['id_user'] != auth()->user()->id)
                {
                    return response([
                        'status' => false,
                        'message' => 'This action is unathorized!'
                    ], MyConstant::FORBIDDEN);
                }
            }
        }

        return response([
            'status' => true,
            'simpanan_wajib' => KPIMResource::collection($simpananWajib),
            'message' => 'Data simpanan wajib berhasil diambil!'
        ], MyConstant::OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSimpananWajibRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimpananWajibRequest $request)
    {
        $this->authorize('create', SimpananWajib::class);

        $simpananWajib = SimpananWajib::create($request->toArray());

        return response([
            'simpanan_wajib' => new KPIMResource($simpananWajib),
            'message' => 'Data berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananWajib $simpananWajib)
    {
        $this->authorize('view', $simpananWajib);

        return response([
            'simpanan_wajib' => new KPIMResource($simpananWajib),
            'user' => new KPIMResource($simpananWajib->user),
            'message' => 'Data berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSimpananWajibRequest  $request
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpananWajibRequest $request, SimpananWajib $simpananWajib)
    {
        $this->authorize('update', $simpananWajib);

        $simpananWajib->update($request->toArray());

        return response([
            'simpanan_wajib' => new KPIMResource($simpananWajib),
            'message' => 'Data berhasil diperbaharui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananWajib $simpananWajib)
    {
        $this->authorize('delete', $simpananWajib);

        $simpananWajib->delete();

        return response([
            'message' => 'Data berhasil dihapus!'
        ]);
    }

    public function paymentSuccess(Request $request){
        if($request['id']){
            $data = SimpananWajib::where('id', $request['id'])->first();

            $update = [
                'status' => true
            ];

            $data->update($update);

            return response([
                'status' => true,
                'message' => 'Payment successful'
            ], MyConstant::OK);
        }else{
            $store = [
                'id_user' => auth()->user()->id,
                'nominal_bayar' => $request['nominal'],
                'tgl_bayar'=> now(),
                'status' => true,
            ];

            SimpananWajib::create($store);

            return response([
                'status' => true,
                'message' => 'Payment successful'
            ], MyConstant::OK);
        }
    }
}
