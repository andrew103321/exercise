<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
class NewsController extends HomeController
{
    //
    public function list(){
        parent::index();
        return view("news",$this->view);
    }
    public function index()
    {
        //
        // return view('backend.module',['header'=>'最新消息','module'=>'News']);
        
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
     
        $this->view['header'] = '網站標題管理';
        $this->view['module'] = 'Title';
        $this->view['cols'] = $cols;
        $this->view['rows'] = $rows;

        
        // $view = [
        //     'header'=>'網站標題管理',
        //     'module'=>'Title',
        //     "cols"=>$cols,
        //     'rows'=>$rows,
        //     'useTitle'=>$this->useTitle
        // ];
        return view('backend.module',$this->view);
    }
}
