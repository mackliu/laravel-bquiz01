<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');
Route::view('/admin','backend.module',['header'=>'網站標題管理','module'=>'Title']);
Route::get('/admin/{module}',function($module){
    switch($module){
        case "title":
            return view('backend.module',['header'=>'網站標題管理','module'=>'Title']);
        break;
        case "ad":
            return view('backend.module',['header'=>'動態廣告文字管理','module'=>'Ad']);
        break;
        case "image":
            return view('backend.module',['header'=>'校園映像圖片管理','module'=>'Image']);
        break;
        case "mvim":
            return view('backend.module',['header'=>'動畫圖片管理','module'=>'Mvim']);
        break;
        case "total":
            return view('backend.module',['header'=>'進站人數管理','module'=>'Total']);
        break;
        case "bottom":
            return view('backend.module',['header'=>'頁尾版權管理','module'=>'Bottom']);
        break;
        case "news":
            return view('backend.module',['header'=>'最新消息管理','module'=>'News']);
        break;
        case "admin":
            return view('backend.module',['header'=>'管理者管理','module'=>'Admin']);
        break;
        case "menu":
            return view('backend.module',['header'=>'選單管理','module'=>'Menu']);
        break;
        
    }
});


//modals

Route::view("/modals/addTitle",'modals.base_modal',['modal_header'=>"新增網站標題"]);
Route::view("/modals/addAd",'modals.base_modal',['modal_header'=>"新增動態廣告文字"]);
Route::view("/modals/addImage",'modals.base_modal',['modal_header'=>"新增校園映像圖片"]);
