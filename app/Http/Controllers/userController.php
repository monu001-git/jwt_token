<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class userController extends Controller
{

    public function viewUser(Request $request)
    {
        if($request->id){
           $user = DB::table('users')->whereId($request->id)->first();
        }else{
             $user = DB::table('users')->get();
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $user
        ]);
    }

    public function deleteUser(Request $request){

        $user = user::find($request->id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Delete Successfully!!!!!!',
            'data' => $user
        ]);
    }

    function addUser(Request $request)
    {
        if ($request->id) {
           // $title = "Edit User";
            $msg = "User Edited Successfully!";
            $data = User::find($request->id);
        } else {
           // $title = "Add User";
            $msg = "User Added Successfully!";
            $data = new User;
        }

        if ($request->isMethod('post')) {
            if ($request->id) {
                $request->validate([
                   'file' => 'file|mimes:jpeg,png,jpg,gif|max:2048'
                ]);
            } else {
                $request->validate([
                   'email' => 'unique:users',
                   'file' => 'file|mimes:jpeg,png,jpg,gif|max:2048'
                ]);
            }
            $data->name = ucwords($request->name);
            // $data->lname = ucwords($request->lname);
            $data->email  = $request->email ;
            $data->description = $request->description;
            $data->gender  = $request->gender ;
            $data->country = $request->country;
            $data->state  = $request->state ;
            $data->interest = $request->interest;
            $data->status = $request->status;
            
            if($request->password){
                $data->password = $request->password;
            }else{
                $data->password = '$2y$12$QHlp2FAYyky56GXuRI6R3e/KZEiaLS2gwzMsb2hKtWcT8eJSzuCJK';  
            }

            $path = public_path('uploads');
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $newname = time() . rand(10, 99).'.'.$file->getClientOriginalExtension();
                $file->move($path, $newname);
                $data->file = $newname;
            }
            $data->save();
            return response()->json([
                'status' => 200,
                'message' => $msg,
                'data'=>$data
            ]);
        }

    }
}