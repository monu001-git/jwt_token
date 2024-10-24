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
        try {

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
        } catch (\PDOException $e) {
            \Log::error('A PDOException occurred: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Database error occurred.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            \Log::error('An exception occurred: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while fetching the data.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Throwable $e) {
            \Log::error('An unexpected exception occurred: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function getMail()
    {
        try {
            $data = mailTable::get();
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } catch (\PDOException $e) {
            \Log::error('A PDOException occurred: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Database error occurred.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            \Log::error('An exception occurred: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while fetching the data.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Throwable $e) {
            \Log::error('An unexpected exception occurred: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
