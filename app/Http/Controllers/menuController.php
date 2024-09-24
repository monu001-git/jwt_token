<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menu;
use DB;

class menuController extends Controller
{

    public function parendId()
    {
     try {
        $menus = DB::table('menus')->get();  
        return response()->json([
            'status' => 200,
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $menus
        ]);
     } catch (\Exception $e) {
        \Log::error('An exception occurred: ' . $e->getMessage());
        return view('pages.error');
     } catch (\PDOException $e) {
        \Log::error('A PDOException occurred: ' . $e->getMessage());
        return view('pages.error');
     } catch (\Throwable $e) {
        \Log::error('An unexpected exception occurred: ' . $e->getMessage());
        return view('pages.error');
     }
    }
     

    
    public function getMenuTree($menus, $parentId = 0) {
        $branch = array();
        foreach ($menus as $menu) {
            if ($menu->parent_id == $parentId) {
                $children = $this->getMenuTree($menus, $menu->id);
                if ($children) {
                    $menu->children = $children;
                }
                $branch[] = $menu;
            }
        }
        return $branch;
    }

  
    public function buildMenuTree() {
        $menus = DB::table('menus')->get();
        $menuTree = $this->getMenuTree($menus, 0);
        return response()->json([
            'status' => 200,
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $menuTree
        ]);
    }


    public function getMenu(Request $request)
    {
        if($request->id){
           $menus = DB::table('menus')->whereId($request->id)->first();
        }else{
             $menus = DB::table('menus')->get();
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $menus
        ]);
    }

    public function deleteMenu(Request $request){

        $user = menu::find($request->id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Delete Successfully!!!!!!',
            'data' => $user
        ]);
    }

    function addMenu(Request $request)
    {
        if ($request->id) {
           // $title = "Edit User";
            $msg = "Menu Edited Successfully!";
            $data = menu::find($request->id);
        } else {
           // $title = "Add User";
            $msg = "Menu Added Successfully!";
            $data = new menu;
        }

        if ($request->isMethod('post')) {
            if ($request->id) {
                $request->validate([
              
                ]);
            } else {
                $request->validate([
                   'name' => 'unique:menus',
                   'url' => 'unique:menus',
                ]);
            }
            $data->name = ucwords($request->name);
            $data->url  = $request->url ;
            $data->parent_id = $request->parentId;
            $data->order  = $request->order ;
            $data->external  = $request->urlType ;
            $data->save();
            return response()->json([
                'status' => 200,
                'message' => $msg,
                'data'=>$data
            ]);
        }

    }
}