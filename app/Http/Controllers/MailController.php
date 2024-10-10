<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\IssueMail;
use App\Models\mailTable;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        $content = $request->content;
        $mail = $request->mail;

        $mailData = [
            'title' => $title,
            'body' => $content,
        ];

        $data = new mailTable;
        $data->title = $request->title;
        $data->content = $request->content;
        $data->mail = $request->mail;
        $data->save();

        Mail::to($mail)->send(new IssueMail($mailData));

        $msg = "Email is sent successfully.";

        return response()->json([
            'status' => 200,
            'msg' => $msg,
        ]);
    }
}
