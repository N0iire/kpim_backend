<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use App\MyConstant;

class ApiAuthController extends Controller
{
    /**
     * Create a new ApiAuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Registering new user to the system
     *
     * @param \App\Http\Requests\Auth\RegisterRequest
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $registerRequest)
    {
        $this->authorize('create', User::class);

        $registerRequest['password'] = Hash::make($registerRequest['password']);
        $user = User::create($registerRequest->toArray());
        if ($user){
            $response = ['Message' => 'Register is success'];

            return response($response, MyConstant::OK);
        }else{
            $response = ['Message' => 'Register is failed'];

            return response($response, MyConstant::BAD_REQUEST);
        }
            $response = ['Message' => 'Server Error'];

            return response($response, MyConstant::BAD_REQUEST);
    }

    /**
     * Login to the system
     *
     * @param \App\Http\Requests\Auth\LoginRequest
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $loginRequest)
    {

        if( $token = auth()->attempt(['username' => $loginRequest->username,
            'password' => $loginRequest->password])) {
                return $this->createNewToken($token);
        } else {
            $response = ['message' => 'User does not exist'];

            return response($response, MyConstant::BAD_REQUEST);
        }
    }

    /**
     * Logout from system
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function logout (Request $request) {
        auth()->logout();
        $response = ['message' => 'You have been successfully logged out!'];

        return response($response, MyConstant::OK);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'message' => 'Login Success',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
}
