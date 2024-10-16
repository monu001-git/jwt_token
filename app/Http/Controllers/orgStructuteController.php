<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orgStructure;
use DB;

class orgStructuteController extends Controller
{

    function addOrg(Request $request)
    {
        try {
            if ($request->id) {
                $msg = "Organisation detail Edited Successfully!";
                $data = orgStructure::find($request->id);
            } else {
                $msg = "Organisation detail Added Successfully!";
                $data = new orgStructure;
            }

            if ($request->isMethod('post')) {
                if ($request->id) {
                    $request->validate([
                        // 'title' => 'required',
                        // 'type' => 'required',
                        // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

                    ]);
                } else {
                    $request->validate([
                        // 'title' => 'required',
                        // 'type' => 'required',
                        // 'email' => 'unique:organisation_structures',
                        // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

                    ]);
                }
                $data->name = ucwords($request->name);
                $data->about_us = $request->about_us;
                $data->email = $request->email;
                $data->phone = $request->phone;
                // $data->extension = $request->extension;
                $data->instagram = $request->instagram;
                $data->instagram_title = $request->instagram_title;
                $data->facebook = $request->facebook;
                $data->facebook_title = $request->facebook_title;
                // $data->twitter = $request->twitter;
                // $data->Twitter_title = $request->Twitter_title;
                // $data->linkedin = $request->linkedin;
                // $data->linkedIn_title = $request->linkedIn_title;
                // $path = public_path('uploads/organisation');
                // if ($request->hasFile('image')) {
                //     $file = $request->file('image');
                //     $newname = time() . rand(10, 99) . '.' . $file->getClientOriginalExtension();
                //     $file->move($path, $newname);
                //     $data->image = $newname;
                // }
                $data->save();
                return response()->json([
                    'status' => 200,
                    'message' => $msg,
                ]);
            }
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


    public function getOrg(Request $request)
    {
        try {
            if ($request->id) {
                $contents = DB::table('orgStructures')->whereId($request->id)->first();
            } else {
                $contents = DB::table('orgStructures')->get();
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data Get Successfully!!!!!!',
                'data' => $contents
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

    public function deleteOrg(Request $request)
    {
        try {

            $user = orgStructure::find($request->id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Delete Successfully!!!!!!',
                'data' => $user
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
