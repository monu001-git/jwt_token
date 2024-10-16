<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\content;
use App\Models\imageContent;
use App\Models\videoContent;
use DB;

class contentController extends Controller
{


    public function getContent(Request $request)
    {
        try {
            if ($request->id) {
                $contents = DB::table('contents')->whereId($request->id)->first();
            } else {
                $contents = DB::table('contents')->get();
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


    public function addContent(Request $request)
    {
        try {
            if ($request->id) {
                $msg = "Content Edited Successfully!";
                $content = Content::findOrFail($request->id);
            } else {
                $msg = "Content Added Successfully!";
                $content = new Content;
            }

            if ($request->isMethod('post')) {

                $content->title = ucwords($request->title);
                $content->description = $request->description;
                $content->status = $request->status;
                $content->order = $request->order;
                $content->image = $request->image;
                $content->save();

                $titles = $request->imageTitle ?? [];
                $alts = $request->imageAlt ?? [];
                $files = $request->imageFile ?? [];

                foreach ($files as $index => $file) {
                    if ($file) {
                        $imageContent = new ImageContent();
                        $imageContent->content_id = $content->id;
                        $imageContent->imageTitle = $titles[$index] ?? null;
                        $imageContent->imageAlt = $alts[$index] ?? null;
                        $imageContent->imageFile = $file;
                        $imageContent->save();
                    }
                }

                $videoAlts  = $request->videoAlt ?? [];
                $videoTitles = $request->videoTitle ?? [];
                $videoUrls = $request->videoUrl ?? [];

                foreach ($videoUrls as $index => $videoUrl) {
                    if ($videoUrl) {
                        $videoContent = new VideoContent();
                        $videoContent->content_id = $content->id;
                        $videoContent->videoTitle = $videoTitles[$index] ?? null;
                        $videoContent->videoAlt = $videoAlts[$index] ?? null;
                        $videoContent->videoUrl = $videoUrl;
                        $videoContent->save();
                    }
                }

                return response()->json([
                    'status' => 200,
                    'message' => $msg,
                    'data' => $content,
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


    public function deleteContent(Request $request)
    {
        try {
            $user = content::find($request->id)->delete();
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
