<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        return view('backend.module',['header'=>'動態廣告文字管理','module'=>'Ad']);
     
    }
}
