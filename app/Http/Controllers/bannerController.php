<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
}
