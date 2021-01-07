<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Totla;
class totalController extends Controller
{
    //
    public function index()
    {
        //
        // return view('backend.module',['header'=>'進站人數','module'=>'total']);
        $total = Totla::first();
        $cols = ["進站總人數"];
        $rows = [
            
                [
                    
                    "text"=>$total->total
                ],
                [
                    "tag"=>"button",
                    "type"=>"button",
                    "btn_color"=>"btn-info", 
                    "action"=>"edit", 
                    'id'=>$total->id,
                    'text'=>"編輯",
                ]
            
        ];
        

        $view = [
            'header'=>'進站總人數管理',
            'module'=>'Total',
            "cols"=>$cols,
            'rows'=>$rows
        ];
        return view('backend.module',$view);
    }
    public function edit($id)
    {
        //
        $total =  Totla:: first();

        $view=[
            'action'=>'/admin/total/'.$id,
            'method'=>'PATCH',
            'modal_hearder'=>'編輯進站總人數',
            'modal_body'=>[
                [
                    'label'=>'編輯進站總人',
                    'tag'=>'input',
                    'type'=>'number',
                    'name'=>'total',
                    'value'=>$total->total
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
        $total = Totla::find($id);
     
        if($total->text!=$request->input('total')){
            $total->total= $request->input('total');
            $total->save();
        }
        

        return redirect("admin/total");
    }

}
