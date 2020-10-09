<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all=Title::all();
        return view('backend.module',['header'=>'網站標題管理','module'=>'Title','rows'=>$all]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $view=[
            'action'=>'/admin/title',
            'modal_header'=>"新增網站標題",
            'modal_body'=>[
                [
                    'label'=>'標題區圖片',
                    'tag'=>'input',
                    'type'=>'file',
                    'name'=>'img'
                ],
                [
                    'label'=>'標題區替代文字',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text'
                ],
            ],
        ];


        return view("modals.base_modal",$view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->hasFile('img') && $request->file('img')->isValid()){
            $title=new Title;
            $request->file('img')->storeAs('public',$request->file('img')->getClientOriginalName());

            $title->img=$request->file('img')->getClientOriginalName();
            $title->text=$request->input('text');
            $title->save();
        }

        return redirect('/admin/title');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
