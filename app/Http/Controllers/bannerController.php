<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\banner;

class bannerController extends Controller
{
    public function getBanner(Request $request)
    {
        try {
            if ($request->id) {
                $banner = DB::table('banners')->whereId($request->id)->first();
            } else {
                $banner = DB::table('banners')->get();
            }

            return response()->json([
                'status' => 200,
                'message' => 'Data retrieved successfully!',
                'data' => $banner
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

    public function deleteBanner(Request $request)
    {
        try {
            $user = banner::find($request->id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'banner Delete Successfully!!!!!!',
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

    function addBanner(Request $request)
    {
        try {
            if ($request->id) {
                $msg = "banner Edited Successfully!";
                $data = banner::find($request->id);
            } else {
                $msg = "banner Added Successfully!";
                $data = new banner;
            }

            if ($request->isMethod('post')) {
                if ($request->id) {
                    $request->validate([]);
                } else {
                    $request->validate([
                        'name' => 'unique:banner',
                    ]);
                }
                $data->title = ucwords($request->title);
                $data->description  = $request->description;
                $data->image = $request->image;
                $data->url  = $request->url;
                $data->order  = $request->order;
                $data->status  = $request->status;
                $data->save();
                return response()->json([
                    'status' => 200,
                    'message' => $msg,
                    'data' => $data
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
}
