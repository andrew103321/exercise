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
        //
        $all = Title::all();
        $cols = ["網站標題","替代文字","顯示","刪除","操作"];
        $rows = [];
        foreach ($all as $a){
            $tmp=[
                [
                    "tag"=>"img",
                    'src'=>$a->img,
                    'style'=>'width:300px;height:30px'  
                ],
                [
                    "tag"=>"",
                    "text"=>$a->text
                ],
                [
                    "tag"=>"button",
                    "type"=>"button",
                    "btn_color"=>"btn-success", 
                    "action"=>"show", 
                    'id'=>$a->id,
                    'text'=>($a->sh==1)?"顯示":"隱藏" 
                ],
                [
                    "tag"=>"button",
                    "type"=>"button",
                    "btn_color"=>"btn-danger", 
                    "action"=>"delete", 
                    'id'=>$a->id,
                    'text'=>"刪除"
                ],
                [
                    "tag"=>"button",
                    "type"=>"button",
                    "btn_color"=>"btn-info", 
                    "action"=>"edit", 
                    'id'=>$a->id,
                    'text'=>"編輯",
                ]
            ];
            $rows[] = $tmp;
        };

        $view = [
            'header'=>'網站標題管理',
            'module'=>'Title',
            "cols"=>$cols,
            'rows'=>$rows
        ];
        return view('backend.module',$view);
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
            'modal_hearder'=>'新增網站標題',
            'modal_body'=>[
                [
                    'label'=>'標題圖片',
                    'tag' =>'input',
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
        return view('modals.base_modal',$view);
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
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            // 檔名
           $filename = $request->file('img')->getClientOriginalName();
           // 存取方式               放置 img 目錄下 檔名  $filename
           $request->file('img')->storeAs('public',$filename);
           $text = $request->input('text');

           $title = new Title;
           $title->img= $filename ;
           $title->text= $text;
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
        $title =  Title:: find($id);

        $view=[
            'action'=>'/admin/title/'.$id,
            'method'=>'PATCH',
            'modal_hearder'=>'編輯網站標題',
            'modal_body'=>[
                [
                    'label'=>'目前標題圖片',
                    'tag'=>'img',
                    'src'=>$title->img,
                    'style'=>'width:300px;height:30px;'
                ],
                [
                    'label'=>'更換標題圖片',
                    'tag' =>'input',
                    'type'=>'file',
                    'name'=>'img'  
                ],
                [
                    'label'=>'標題區替代文字',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>$title->text
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
        $title = Title::find($id);
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            // 檔名
           $filename = $request->file('img')->getClientOriginalName();
           // 存取方式               放置 img 目錄下 檔名  $filename
           $request->file('img')->storeAs('public',$filename);
           $title->img= $filename ;
        }
        if($title->text!=$request->input('text')){
            $text = $request->input('text');
            $title->text= $text;
        }
        
        $title->save();

        return redirect("admin/title");
    }

    /** 
     * 改變資料顯示方法
     * **/

     public function display($id){
         $title = Title::find($id);

         if($title->sh==1){
             // 把顯示變隱藏
            $title->sh=0;
            // 找出隱藏的第一筆變顯示
            $findDefault=Title::where("sh",0)->first();
            $findDefault->sh=1;

            $findDefault->save();

        }else{
            $title->sh=1;
            $findShow = Title::where("sh",1)->first();
            $findShow->sh=0;

        
            $findShow->save();
         }

         $title->save();
            
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
        Title::destroy($id);
    }
}
