<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bottom;
class BottomController extends Controller
{
    //
    public function index()
    {
        //
       // return view('backend.module',['header'=>'頁尾','module'=>'Bottom']);
      // return view('backend.module',['header'=>'進站人數','module'=>'total']);
           $bottom = bottom::first();
           $cols = ["頁尾版權"];
           $rows = [
               
                   [ 
                       "text"=>$bottom->bottom
                   ],
                   [
                       "tag"=>"button",
                       "type"=>"button",
                       "btn_color"=>"btn-info", 
                       "action"=>"edit", 
                       'id'=>$bottom->id,
                       'text'=>"編輯",
                   ]
               
           ];
           
   
           $view = [
               'header'=>'頁尾版權管理',
               'module'=>'Bottom',
               "cols"=>$cols,
               'rows'=>$rows
           ];
           return view('backend.module',$view);
       }
       public function edit($id)
    {
        //
        $bottom =  Bottom:: find($id);

        $view=[
            'action'=>'/admin/bottom/'.$id,
            'method'=>'PATCH',
            'modal_hearder'=>'編輯頁尾版權',
            'modal_body'=>[
                [
                    'label'=>'頁尾版權文字',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'bottom',
                    'value'=>$bottom->bottom
                ],

            ],
        ];

        return view('modals.base_modal',$view);
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
        $bottom = bottom::find($id);
     
        if($bottom->text!=$request->input('bottom')){
            $bottom->bottom= $request->input('bottom');
            $bottom->save();
        }
        

        return redirect("admin/bottom");
    }
    }

