<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function test(Request $request)
    {
        return response()->json([
            'message' => 'kek',
        ]);
    }
    public function index()
    {
        return new UserResourse(Auth()->user());
    }

    public function profileUpdate(ProfileRequest $request)
    {
        $user = User::where('id', Auth::id())->first();

        $update = $request->validated();

        $user->update($update);

        $user->save();

        return response()->json([
            'message' => 'Updated Profile'
        ],200);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => ['required'],
            'conf_password' => ['required'],
        ]);
        $user = User::where('id', Auth::id())->first();

        if ($request->new_password != $request->conf_password) {
            return response()->json([
                'status' => 'Password Incorrect'
            ],418);
        }

        $user->password = Hash::make($request->new_password);

        $user->save();

        return response()->json([
            'status' => 'Password changed'
        ],200);
    }
}
