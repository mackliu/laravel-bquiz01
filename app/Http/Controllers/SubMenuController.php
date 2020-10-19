<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubMenu;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($menu_id)
    {

        $all=SubMenu::where("menu_id",$menu_id)->get();
        $cols=['次選單名稱','次選單連結網址','刪除','操作',''];
        $rows=[];

        foreach($all as $a){
            $tmp=[
              [
                  'tag'=>'',
                  'text'=>$a->text
              ],
              [
                  'tag'=>'',
                  'text'=>$a->href
              ],
              [
                'tag'=>'button',
                'type'=>'button',
                'btn_color'=>'btn-danger',
                'action'=>'delete',
                'id'=>$a->id,
                'text'=>'刪除',
              ],
              [
                'tag'=>'button',
                'type'=>'button',
                'btn_color'=>'btn-info',
                'action'=>'edit',
                'id'=>$a->id,
                'text'=>'編輯',
              ]
            ];

            $rows[]=$tmp;
        }

        //dd($rows);

        
        $this->view['header']='次選單管理';
        $this->view['module']='SubMenu';
        $this->view['cols']=$cols;
        $this->view['rows']=$rows;
        $this->view['menu_id']=$menu_id;
        return view('backend.module',$this->view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($menu_id)
    {
        $view=[
            'action'=>'/admin/submenu/'.$menu_id,
            'modal_header'=>"新增次選單",
            'modal_body'=>[
                [
                    'label'=>'次選單名稱',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                ],
                [
                    'label'=>'次選單連結網址',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'href',
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
    public function store(Request $request,$menu_id)
    {
        $sub=new SubMenu;
        $sub->text=$request->input('text');
        $sub->href=$request->input('href');
        $sub->menu_id=$menu_id;
        $sub->save();
  
        return redirect('/admin/submenu/'.$menu_id);
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
        $sub=SubMenu::find($id);
        $view=[
            'action'=>'/admin/submenu/'.$id,
            'method'=>'PATCH',
            'modal_header'=>"編輯次選單內容",
            'modal_body'=>[
                [
                    'label'=>'次選單名稱',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>$sub->text
                ],
                [
                    'label'=>'次選單連結網址',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'href',
                    'value'=>$sub->href
                ],
            ],
        ];


        return view("modals.base_modal",$view);

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

        $sub=SubMenu::find($id);

        
        if($sub->text!=$request->input('text')){
            $sub->text=$request->input('text');
        }
        if($sub->href!=$request->input('href')){
            $sub->href=$request->input('href');
        }
        
        $sub->save();
        return redirect('/admin/submenu/'.$sub->menu_id);
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
        SubMenu::destroy($id);
    }
}
