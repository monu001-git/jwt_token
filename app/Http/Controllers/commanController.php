<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class commanController extends Controller
{
    function StatusChange($status,$id,$db){
        DB::table($db)->where('id',$id)->update(['status'=>$status]);
        return response()->json([
            'status' => 200,
            'success' => 'Status Changed Successfully',
        ]);

      }
}