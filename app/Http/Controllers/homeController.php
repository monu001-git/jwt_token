<?php

namespace App\Http\Controllers;
use App\Models\menu;
use Illuminate\Http\Request;

class homeController extends Controller
{
    
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

  
    public function headerMenu() {
        $menus = menu::wherestatus(1)->orderBy('order', 'asc') ->get();
        $menuTree = $this->getMenuTree($menus, 0);
        return response()->json([
            'status' => 200,
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $menuTree
        ]);
    }


    public function footerMenu()
    {

        $data = menu::get();
        return response()->json([
            'status' => 200,
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $data
        ]);
    }
}
