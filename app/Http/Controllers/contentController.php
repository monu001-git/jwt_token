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
    }
    public function addContent(Request $request)
    {
        
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
    }
    

    public function deleteContent(Request $request)
    {

        $user = content::find($request->id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Delete Successfully!!!!!!',
            'data' => $user
        ]);
    }
}
