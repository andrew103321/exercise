<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagController extends Controller
{
    //
    public function index()
    {
        //
        return view('backend.module',['header'=>'校園','module'=>'Imag']);
    }
}
