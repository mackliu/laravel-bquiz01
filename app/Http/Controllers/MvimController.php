<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MvimController extends Controller
{
    public function index()
    {
        return view('backend.module',['header'=>'動畫圖片管理','module'=>'Mvim']);
        
    }
}
