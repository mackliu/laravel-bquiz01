<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BottomController extends Controller
{
    public function index()
    {
        return view('backend.module',['header'=>'頁尾版權管理','module'=>'Bottom']);
        
    }
}
