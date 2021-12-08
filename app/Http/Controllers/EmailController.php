<?php

namespace App\Http\Controllers;

use App\Models\Mailing;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $mail = new Mailing();
        $mail->email = $request->email;
        $mail->save();

        return response()->json([
            'message'   =>  'Операция прошла успешно'
        ]);
    }
}
