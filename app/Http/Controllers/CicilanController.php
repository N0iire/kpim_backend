<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use App\Http\Requests\StoreCicilanRequest;
use App\Http\Requests\UpdateCicilanRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Support\Facades\Validator;

class CicilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Cicilan::class);
        
        $cicilan = Cicilan::filter(request(['pinjaman', 'search']))->get();

        for($i=0; $i < count($cicilan); $i++){
            $cicilan[$i]['cicilan_ke'] = $i+1;
        }

        return response([
            'status' => true,
            'cicilan' => KPIMResource::collection($cicilan),
            'message' => 'Data cicilan berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCicilanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Array $request)
    {
        $validator = Validator::make($request, [
            'id_pinjaman' => 'required|integer|exists:pinjamans,id',
            'tgl_bayar' => 'required|date',
            'nominal_bayar' => 'required'
        ]);

        if($validator->fails())
        {
            return response([
                'status' => false,
                'message' => $validator->errors()
            ], MyConstant::BAD_REQUEST);
        }

        $validated = $validator->validated();

        Cicilan::create($validated);

        return response([
            'status' => true,
            'message' => 'Data berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function show(Cicilan $cicilan)
    {
        $this->authorize('view', $cicilan);

        return response([
            'status' => true,
            'cicilan' => new KPIMResource($cicilan),
            'message' => 'Data cicilan berhasil ditemukan!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCicilanRequest  $request
     * @param  \App\Models\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCicilanRequest $request, Cicilan $cicilan)
    {
        $this->authorize('update', $cicilan);

        $validated = $request->validated();
        
        $cicilan->update($validated);

        return response([
            'status' => true,
            'cicilan' => new KPIMResource($cicilan),
            'message' => 'Data cicilan berhasil diperbaharui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cicilan  $cicilan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cicilan $cicilan)
    {
        $this->authorize('delete', $cicilan);

        $cicilan->delete();

        return response([
            'status' => true,
            'message' => 'Data cicilan berhasil dihapus!'
        ]);
    }
}
