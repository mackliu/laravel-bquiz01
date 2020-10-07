<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('backend.module',['header'=>'最新消息管理','module'=>'News']);
    }
}
