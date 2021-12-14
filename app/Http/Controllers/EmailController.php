<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\FeedbaackRequest;
use App\Models\Feedback;
use App\Models\Mailing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmailController extends Controller
{
    public function save(EmailRequest $request): \Illuminate\Http\JsonResponse
    {
        $mail = new Mailing();
        $mail->email = $request->email;
        $mail->save();

        return response()->json([
            'message'   =>  'Операция прошла успешно'
        ]);
    }

    public function feedback(FeedbaackRequest $request)
    {
        $name = $request->post('name');
        $file = $request->file('file');

        $path = Storage::disk('public')->put('files', $file);

        $feedback = new Feedback();
        $feedback->name = $name;
        $feedback->file = $path;

        $feedback->save();

        return response()->json([
            'message' => 'Операция прошла успешно'
            ]);
    }
}
