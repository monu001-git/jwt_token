<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class profileController extends Controller
{
    public function getProfile()
    {
       $user = DB::table('users')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $user
        ]);
    }
}