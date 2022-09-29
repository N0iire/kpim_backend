<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Enums\UserJabatan;
use App\Http\Resources\KPIMResource;
use App\MyConstant;

class UserController extends Controller
{
    /**
    * Show all user
    *
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $users = User::all();

        return response([
            'status' => true,
            'users' => KPIMResource::collection($users),
            'message' => 'Data anggota berhasil diambil!'
        ], MyConstant::OK);
    }

    /**
     * Show specified user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response([
            'status' => true,
            'user' => new KPIMResource($user),
            'message' => 'Data anggota berhasil ditemukan!'
        ]);
    }

    /**
     * Store a newly created user
     *
     * @param \App\Http\Requests\;
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['status'] = true;
        $validated['keanggotaan'] = true;

        $user = User::create($validated);

        $id_user = User::where('username', $validated['username'])->first();
        $validated['id_user'] = $id_user['id'];
        $validated['tgl_bayar'] = $validated['tgl_daftar'];

        $simpananPokok = (new SimpananPokokController)->store($validated)->getOriginalContent();

        if($simpananPokok['status'] == false)
        {
            return response([
                'status' => false,
                'message' => $simpananPokok['message'],
            ], MyConstant::BAD_REQUEST);
        }

        return response([
            'status' => true,
            'message' => 'Data anggota berhasil ditambah!'
        ], MyConstant::OK);
    }

    /**
     * Update the specified user
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return response([
            'status' => true,
            'message' => 'Data anggota berhasil diperbarui!'
        ]);
    }

    /**
     * Delete the specified user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response([
            'status' => true,
            'message' => 'Data anggota berhasil dihapus!'
        ]);
    }

    public function simpananWajib(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|exists:users'
        ]);

        $user = User::where('username', $validated['username']);
        $simpananWajib = $user->simpanan_wajib;
        
        return response([
            'status' => true,
            'simpananWajib' => new KPIMResource($simpananWajib),
            'message' => 'Data simpanan wajib berhasil diambil!'
        ], MyConstant::OK);
    }

    public function simpananPokok(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|exists:users'
        ]);

        $user = User::where('username', $validated['username']);
        $simpananPokok = $user->simpanan_pokok;
        
        return response([
            'status' => true,
            'simpananPokok' => new KPIMResource($simpananPokok),
            'message' => 'Data simpanan pokok berhasil diambil!'
        ], MyConstant::OK);
    }

    public function simpananSukarela(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|exists:users'
        ]);

        $user = User::where('username', $validated['username']);
        $simpananSukarela = $user->simpanan_sukarela;
        
        return response([
            'status' => true,
            'simpananSukarela' => new KPIMResource($simpananSukarela),
            'message' => 'Data simpanan sukarela berhasil diambil!'
        ], MyConstant::OK);
    }

    public function pinjaman(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|exists:users'
        ]);

        $user = User::where('username', $validated['username']);
        $pinjaman = $user->pinjaman;

        return response([
            'status' => true,
            'pinjaman' => new KPIMResource($pinjaman),
            'message' => 'Data pinjaman berhasil diambil!'
        ], MyConstant::OK);
    }
}
