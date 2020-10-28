<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Mysql extends Controller
{
    //
    public static function addData(){

        DB::table('account')
        ->insert([
            'name'=>'admin',
            'password'=>1234
            
        ]);
    }
}
