<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{

    public function index()
    {
        //
        $all = Menu::all();
        $cols = ["主選單","網址","次選單","顯示","刪除","操作",""];
        $rows = [];
        foreach ($all as $a){
            $tmp=[
                [
                    "tag"=>"",
                    "text"=>$a->text
                ],
                [
                    "tag"=>"",
                    "text"=>$a->href
                ],
                [
                    "tag"=>"",
                    "text"=>$a->subs->count(),
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
                ],
                [
                    "tag"=>"button",
                    "type"=>"button",
                    "btn_color"=>"btn-warning", 
                    "action"=>"sub", 
                    'id'=>$a->id,
                    'text'=>"次選單",
                ]
            ];
            $rows[] = $tmp;
        };

        $this->view['header'] = '選單管理';
        $this->view['module'] = 'Menu';
        $this->view['cols'] = $cols;
        $this->view['rows'] = $rows;

        // $view = [
        //     'header'=>'選單管理',
        //     'module'=>'Menu',
        //     "cols"=>$cols,
        //     'rows'=>$rows
        // ];
        return view('backend.module',$this->view);
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
            'action'=>'/admin/menu',
            'modal_hearder'=>'選單管理',
            'modal_body'=>[
                [
                    'label'=>'選單名稱名稱',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text'
                ],
                [
                    'label'=>'選單網址',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'href'
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
        
           $Menu = new Menu;
           $text = $request->input('text');
           $href = $request->input('href');

           $Menu->text= $text;
           $Menu->href= $href;
           $Menu->save();
        
        
        
        return redirect('/admin/menu');
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
        $menu =  menu:: find($id);

        $view=[
            'action'=>'/admin/menu/'.$id,
            'method'=>'PATCH',
            'modal_hearder'=>'編輯網站標題',
            'modal_body'=>[

                [
                    'label'=>'名稱',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'text',
                    'value'=>$menu->text
                ],
                [
                    'label'=>'網址',
                    'tag'=>'input',
                    'type'=>'text',
                    'name'=>'href',
                    'value'=>$menu->href
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
        $Menu = Menu::find($id);
   
        if($Menu->text!=$request->input('text')){
            $text = $request->input('text');
            $Menu->text= $text;
        }
        
        if($Menu->href!=$request->input('href')){
            $href = $request->input('href');
            $Menu->href= $href;
        }
        
        $Menu->save();

        return redirect("admin/menu");
    }

    /** 
     * 改變資料顯示方法
     * **/

     public function display($id){
        $Menu = Menu::find($id);
         
        $Menu->sh=($Menu->sh+1)%2;
        $Menu->save();
            
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
        Menu::destroy($id);
    }
 
}
