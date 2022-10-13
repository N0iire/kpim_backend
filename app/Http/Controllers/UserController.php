<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Support\Facades\Hash;

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
        $this->authorize('viewAny', User::class);

        $users = User::filter(request('search'))->get();

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
        $this->authorize('view', $user);

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
        // $this->authorize('create', User::class);

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $validated['status'] = true;
        $validated['keanggotaan'] = true;

        User::create($validated);

        $id_user = User::where('username', $validated['username'])->first();
        $validated['id_user'] = $id_user->id;
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
        $this->authorize('update', $user);

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
        $this->authorize('delete', $user);

        $user->delete();

        return response([
            'status' => true,
            'message' => 'Data anggota berhasil dihapus!'
        ]);
    }
}
