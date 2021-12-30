<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResourse;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        return new UserResourse(Auth()->user());
    }

    public function profileUpdate(ProfileRequest $request): JsonResponse
    {
        try {
            $user   = User::query()
                          ->where('id', Auth::id())
                          ->first();
            $update = $request->validated();

            if (isset($update['avatar'])) {

                $image = $update['avatar'];

                $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
                $type = explode(';', $image)[0];
                $type = explode('/', $type)[1]; // png or jpg etc

                $image = str_replace('data:image/' . $type . ';base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = "product-".time()."." . $type;

                Storage::disk('public')->put($imageName, base64_decode($image));
                $update['avatar'] = $imageName;
            }
            $user->update($update);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return response()->json([
                                        'message' => 'Email уже зарегистрирован',
                                    ], 418);
        }
        $user->save();

        return response()->json([
                                    'message' => 'Updated Profile',
                                ], 200);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
                               'new_password'  => ['required'],
                               'conf_password' => ['required'],
                           ]);
        $user = User::where('id', Auth::id())
                    ->first();

        if ($request->new_password != $request->conf_password) {
            return response()->json([
                                        'status' => 'Password Incorrect',
                                    ], 418);
        }

        $user->password = Hash::make($request->new_password);

        $user->save();

        return response()->json([
                                    'status' => 'Password changed',
                                ], 200);
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $user           = User::where('email', $request->email)
                              ->first();
        $new_password   = Str::random(8);
        $user->password = Hash::make($new_password);
        $user->save();

        Mail::to($request->email)
            ->send(new ForgotPassword($new_password))
        ;

        return response()->json([
                                    "message" => "Sent successfully",
                                ]);
    }


}
