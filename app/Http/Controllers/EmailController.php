<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Models\Mailing;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function save(EmailRequest $request)
    {
        $mail = new Mailing();
        $mail->email = $request->email;
        $mail->save();

        return response()->json([
            'message'   =>  'Операция прошла успешно'
        ]);
    }
}
