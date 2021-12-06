<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AuthController extends BaseController
{

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        try {
            $user = User::create($input);
        }catch (\Exception $exception){
            return $this->sendError('Email уже зарегистрирован');
        }
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['user']  = [
            'name' => $user->name
        ];
        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['user']  = [
                'email'      => $user->email,
                'name'       => $user->name,
            ];
            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError([
                'message' => 'Unauthorised',
                'error' => 'Unauthorised'
            ]);
        }
    }
// Logout
    public function logout()
    {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
