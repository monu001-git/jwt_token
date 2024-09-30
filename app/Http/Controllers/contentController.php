<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\content;

class contentController extends Controller
{
   

    public function addContent(Request $request)
    {
    //   $files = $request->imageFiles;  
      $titles = $request->imageTitles; 
      $alts = $request->imageAlts;  

        foreach ($titles as $index => $title) {
            $data = new Content();
            $data->title = $titles[$index];
            $data->alt = $alts[$index];
            $data->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Record added successfully',
        ]);
    }

    
    

}