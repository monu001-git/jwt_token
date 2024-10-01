<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\content;

class contentController extends Controller
{

    public function addContent(Request $request)
    {
        $request->validate([
            'titles.*' => 'required|string|max:255',
            'alts.*' => 'required|string|max:255',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $titles = $request->input('titles');
        $alts = $request->input('alts');
        $files = $request->file('files');

        foreach ($files as $index => $file) {
            $data = new Content();
            $data->title = $titles[$index];
            $data->alt = $alts[$index];

            $path = public_path('content');
            if ($file) {
                $newname = time() . rand(10, 99) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $newname);
                $data->file = $newname;
            }
            $data->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Records added successfully',
        ]);
    }
}
