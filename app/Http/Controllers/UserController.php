<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\KPIMResource;
use App\MyConstant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $this->authorize('create', User::class);

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

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

        if(auth()->user()->username != $user->username)
        {
            return response([
                'status' => false,
                'message' => 'This action is unathorized!'
            ], MyConstant::FORBIDDEN);
        }

        if($request->nik ?? false && $request->nik != $user->nik)
        {
            $update = $request->toArray();

            $validator = Validator::make($update, [
                'username' => 'required|string|max:30',
                'password' => 'nullable|string|min:5',
                'confirm_password' => 'required_with:password|same:password',
                'old_password' => 'required_with:password',
                'avatar' => 'nullable|string',
                'nik' => 'required|string',
                'nama_anggota' => 'required|string',
                'alamat' => 'required|string',
                'ttl' => 'required|string',
                'pekerjaan' => 'required|string',
            ]);

            if($validator->fails())
            {
                return response([
                    'status' => false,
                    'message' => $validator->errors()
                ], MyConstant::BAD_REQUEST);
            }

            $validated = $validator->validated();
        }else
        {
            $validated = $request->validated();
        }

        if($validated['old_password'] ?? false)
        {
            $old_password = Hash::check($validated['old_password'], $user->password);
            
            if($old_password == false)
            {
                return response([
                    'status' => false,
                    'message' => 'Invalid old password!'
                ], MyConstant::BAD_REQUEST);
            }

            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response([
            'status' => true,
            'message' => 'Data anggota berhasil diperbarui!'
        ], MyConstant::OK);
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
