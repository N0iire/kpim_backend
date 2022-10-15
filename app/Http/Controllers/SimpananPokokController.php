<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSimpananPokokRequest;
use App\Models\SimpananPokok;
use App\Http\Requests\UpdateSimpananPokokRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Support\Facades\Validator;

class SimpananPokokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', SimpananPokok::class);

        $simpanan_pokok = SimpananPokok::filter(request(['username', 'search']))->get();

        return response([
            'status' => true,
            'simpanan_pokok' => KPIMResource::collection($simpanan_pokok),
            'message' => 'Data simpanan pokok berhasil diambil!'
        ], MyConstant::OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSimpananPokokRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Array $request)
    {
        $validator = Validator::make($request, [
            'id_user' => 'required|integer|exists:users,id',
            'tgl_bayar' => 'required|date',
            'nominal_pokok' => 'required',
            'ket' => 'nullable|string'
        ]);

        if($validator->fails())
        {
            return response([
                'status' => false,
                'message' => $validator->errors()
            ], MyConstant::BAD_REQUEST);
        }

        $validated = $validator->validated();

        SimpananPokok::create($validated);

        return response([
            'status' => true,
            'message' => 'Data simpanan pokok berhasil ditambahkan!'
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananPokok $simpananPokok)
    {
        $this->authorize('view', $simpananPokok);

        return response([
            'status' => true,
            'simpanan_pokok' => new KPIMResource($simpananPokok),
            'user' => new KPIMResource($simpananPokok->user),
            'message' => 'Berhasil mendapatkan data!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSimpananPokokRequest  $request
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSimpananPokokRequest $request, SimpananPokok $simpananPokok)
    {
        $this->authorize('update', $simpananPokok);

        $simpananPokok->update($request->toArray());

        return response([
            'status' => true,
            'simpanan_pokok' => new KPIMResource($simpananPokok),
            'message' => 'Berhasil mengupdate data!'
        ], MyConstant::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananPokok $simpananPokok)
    {
        $this->authorize('delete', $simpananPokok);

        $simpananPokok->delete();

        return response([
            'status' => true,
            'message' => 'Data simpanan pokok berhasil dihapus!'
        ], MyConstant::OK);
    }
}
