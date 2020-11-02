<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        //
        return view('backend.module',['header'=>'帳號管理','module'=>'Admin']);
    }
}
