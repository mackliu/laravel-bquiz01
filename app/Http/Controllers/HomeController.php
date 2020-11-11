<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Image;
use App\Models\AD;
use App\Models\Mvim;
use App\Models\News;
use Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->sideBar();


        $mvims=Mvim::where('sh',1)->get();
        $news=News::where("sh",1)->get()->filter(function($val,$idx){
            if($idx>4){
                $this->view['more']='/news';     
            }else{
                return $val;
            }
        });

        //dd($news,$this->view);

        $this->view['mvims']=$mvims;
        $this->view['news']=$news;
        return view('main',$this->view);
    }

   
    protected function sideBar(){
        $menus=Menu::where('sh',1)->get();
        $images=Image::where('sh',1)->get();
        $ads=implode("　",AD::where("sh",1)->get()->pluck('text')->all());
        foreach($menus as $key => $menu){
            $subs=$menu->subs;
            $menu->subs=$subs;
            $menu->show=false;
            $menus[$key]=$menu;
        }

        if(Auth::user()){
            $this->view['user']=Auth::user();
        }

        $this->view['ads']=$ads;
        $this->view['menus']=$menus;
        $this->view['images']=$images;
    }

}
