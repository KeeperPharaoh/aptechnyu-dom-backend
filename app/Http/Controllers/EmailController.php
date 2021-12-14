<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\FeedbaackRequest;
use App\Models\Feedback;
use App\Models\Mailing;
use Illuminate\Http\Request;

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
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $file = $request->file('file');
        $path = $file->store('files');
        $feedback->file = $path;
        $resume = $request->file('file')->store('public/files');
        $file =[];
        $file[] = [
            'download_link' => str_replace('public/', '', $resume),
            'original_name' => 'download_link',
        ];
        $feedback->file = $file[0]['download_link'];
        $feedback->save();

        return response()->json([
            'message' => 'Операция прошла успешно'
            ]);
    }
}
