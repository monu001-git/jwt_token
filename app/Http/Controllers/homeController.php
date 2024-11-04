<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;

class homeController extends Controller
{

    public function getMenuTree($menus, $parentId = 0)
    {
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


    public function headerMenu()
    {
        $menus = menu::wherestatus(1)->orderBy('order', 'asc')->get();
        $menuTree = $this->getMenuTree($menus, 0);
        return response()->json([
            'status' => 200,
            'message' => 'Data Get Successfully!!!!!!',
            'data' => $menuTree
        ]);
    }


    public function footerMenu()
    {
        try {
            $data = menu::get();
            return response()->json([
                'status' => 200,
                'message' => 'Data Get Successfully!!!!!!',
                'data' => $data
            ]);
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
