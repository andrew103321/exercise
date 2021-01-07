<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
class ImagController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = Image::all();
        $cols = ["校園映像圖片","顯示","刪除","操作"];
        $rows = [];
        foreach ($all as $a){
            $tmp=[
                [
                    "tag"=>"img",
                    'src'=>$a->img,
                    'style'=>'width:100px;height:68px'  
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
            'header'=>'校園映像圖片管理',
            'module'=>'Image',
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
            'action'=>'/admin/Image',
            'modal_hearder'=>'新增校園映像圖片',
            'modal_body'=>[
                [
                    'label'=>'新增校園映像',
                    'tag' =>'input',
                    'type'=>'file',
                    'name'=>'img'  
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
      
           $title = new Image;
           $title->img= $filename ;

           $title->save();
        }
        
        
        return redirect('/admin/image');
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
        $image =  Image:: find($id);

        $view=[
            'action'=>'/admin/image/'.$id,
            'method'=>'PATCH',
            'modal_hearder'=>'編輯校園映像圖片',
            'modal_body'=>[
                [
                    'label'=>'目前圖片',
                    'tag'=>'img',
                    'src'=>$image->img,
                    'style'=>'width:100px;height:68px;'
                ],
                [
                    'label'=>'更換標題圖片',
                    'tag' =>'input',
                    'type'=>'file',
                    'name'=>'img'  
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
        $Image = Image::find($id);
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            // 檔名
           $filename = $request->file('img')->getClientOriginalName();
           // 存取方式               放置 img 目錄下 檔名  $filename
           $request->file('img')->storeAs('public',$filename);
           $Image->img= $filename ;
           $Image->save();
        }
     
        

        return redirect("admin/image");
    }

    /** 
     * 改變資料顯示方法
     * **/

     public function display($id){
         $Image = Image::find($id);

         $Image->sh=($Image->sh+1)%2;
         $Image->save();
            
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
        Image::destroy($id);
    }
}
