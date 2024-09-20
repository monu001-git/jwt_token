<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class orgStructuteController extends Controller
{
       
    function Add_OrganisationStructure(Request $request, $id = null)
    {
        if ($id) {
            $title = "Edit Organisation Structure";
            $msg = "Organisation Structure Edited Successfully!";
            $data = OrganisationStructure::find(dDecrypt($id));
        } else {
            $title = "Add Organisation Structure";
            $msg = "Organisation Structure Added Successfully!";
            $data = new OrganisationStructure;
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
            $data->department_h = $request->department_h;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->extension = $request->extension;
            $data->designation = $request->designation;
            $data->designation_h = $request->designation_h;
            $data->status = $request->status;
            $data->order = $request->order;
            $data->instagram = $request->instagram;
            $data->Instagram_title = $request->Instagram_title;
            $data->Facebook = $request->Facebook;
            $data->Facebook_title = $request->Facebook_title;
            $data->twitter = $request->twitter;
            $data->Twitter_title = $request->Twitter_title;
            $data->linkedin = $request->linkedin;
            $data->linkedIn_title = $request->linkedIn_title;
            $path = public_path('uploads/organisation');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $newname = time() . rand(10, 99) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $newname);
                $data->image = $newname;
            }
            $data->save();
            return response()->json([
                'status' => 201,
                'message' => $msg,
                'title' => $title
            ]);
        }

    }

}
