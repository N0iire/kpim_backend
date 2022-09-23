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
            'users' => KPIMResource::collection($users),
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
            'user' => new KPIMResource($user),
            'message' => 'Data berhasil ditemukan!'
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
        $user = User::create($request);

        return response([
            'user' => new KPIMResource($user),
            'message' => 'Data berhasil ditambah!'
        ]);
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
        $user->update($request->toArray());

        return response([
            'user' => new KPIMResource($user),
            'message' => 'Data berhasil diperbaharui!'
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
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
