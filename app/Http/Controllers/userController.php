<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class userController extends Controller
{

    public function viewUser($id=null)
    {
        if($id){
           $user = DB::table('users')->whereId($id)->first();
        }else{
             $user = DB::table('users')->get();
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $user
        ]);
    }

    public function deleteUser($id){

        $user = user::find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Delete Successfully!!!!!!',
            'data' => $user
        ]);
    }

    function addUser(Request $request, $id = null)
    {
        if ($id) {
            $title = "Edit User";
            $msg = "User Edited Successfully!";
            $data = User::find($id);
        } else {
            $title = "Add User";
            $msg = "User Added Successfully!";
            $data = new User;
        }

        if ($request->isMethod('post')) {
            if ($id) {
                $request->validate([
                    'title' => 'required',
                    'type' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

                ]);
            } else {
                $request->validate([
                    'title' => 'required',
                    'type' => 'required',
                    'email' => 'unique:organisation_structures',
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

                ]);
            }
            $data->title = ucwords($request->title);
            $data->title_h = $request->title_h;
            $data->description = $request->description;
            $data->description_h = $request->description_h;
            $data->department = $request->department;
            $path = public_path('uploads/organisation');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $newname = time() . rand(10, 99).'.'.$file->getClientOriginalExtension();
                $file->move($path, $newname);
                $data->image = $newname;
            }
            $data->save();
            return response()->json([
                'status' => 201,
                'message' => $msg,
                'title' => $title,
                'data'=>$data
            ]);
        }

    }
}