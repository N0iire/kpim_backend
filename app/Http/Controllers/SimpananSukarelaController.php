<?php

namespace App\Http\Controllers;

use App\Models\SimpananSukarela;
use App\Http\Requests\StoreSimpananSukarelaRequest;
use App\Http\Requests\UpdateSimpananSukarelaRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class SimpananSukarelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', SimpananSukarela::class);

        $simpananSukarela = SimpananSukarela::filter(request(['username', 'search']))->get();

        if(auth()->user()->jabatan->value == 'anggota')
        {
            $check = $simpananSukarela->toArray();

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
            'simpanan_sukarela' => KPIMResource::collection($simpananSukarela),
            'message' => 'Data simpanan sukarela berhasil diambil!'
        ], MyConstant::OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSimpananSukarelaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSimpananSukarelaRequest $request)
    {
        $this->authorize('create', SimpananSukarela::class);

        $simpananSukarela = SimpananSukarela::create($request->toArray());

        return response([
            'simpanan_sukarela' => new KPIMResource($simpananSukarela),
            'message' => 'Data berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananSukarela $simpananSukarela)
    {
        $this->authorize('view', $simpananSukarela);

        return response([
            'simpanan_sukarela' => new KPIMResource($simpananSukarela),
            'message' => 'Data berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSimpananSukarelaRequest  $request
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpananSukarelaRequest $request, SimpananSukarela $simpananSukarela)
    {
        $this->authorize('update', $simpananSukarela);

        $simpananSukarela->update($request->toArray());

        return response([
            'simpanan_sukarela' => new KPIMResource($simpananSukarela),
            'message' => 'Data berhasil diperbaharui'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananSukarela  $simpananSukarela
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananSukarela $simpananSukarela)
    {
        $this->authorize('delete', $simpananSukarela);

        $simpananSukarela->delete();

        return response([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
