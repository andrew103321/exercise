<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->sideBar();
        return view('main',$this->view);
    }

    protected function  sideBar(){
           // 待理解
        // $menus = Menu::where("sh",1)->get();
        // foreach($menus as $key=>$menu){
        //     $subs = SubMenu::where("menu_id",$menu->id)->get();
        //     $menu->$subs = $subs;
        //     $menus[$key]=$menu;
        // }

        $menus = Menu::where("sh",1)->get();
        $images = Image::where("sh",1)->get();
        foreach($menus as $key=>$menu){
            $subs = $menu->subs;
            $menu->$subs = $subs;
            $menus[$key]=$menu;
        }
      
        
        $this->view['menus']= $menus;
        $this->view['images']= $images;
    }

}
