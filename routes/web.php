`<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ImagController;
use App\Http\Controllers\MvimController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\BottomController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*---------------筆記--------------------
     直接呼叫 view
     Route::view('/home','home',['name'=>'mack']);
     Route::get('/', function () {
         return view('welcome');
     }) 
      路由寫法
     Route::get('/user', [UserController::class,'index']);

     //    (前墜)           (群主化) 
    Route::prefix('admin')->group(function(){
    Route::view('/','backend.title');
    Route::view('/ad','backend.ad');
})
 
*/
// --------------- 練習題開始-----------------

Route::view('/','home');
Route::redirect('/admin',"/admin/title");


Route::prefix('admin')->group(function(){
    
    Route::get('/title', [TitleController::class,'index']);
    Route::get('/ad', [AdController::class,'index']);
    Route::get('/imag', [ImagController::class,'index']);
    Route::get('/mvim', [MvimController::class,'index']);
    Route::get('/total', [TotalController::class,'index']);
    Route::get('/bottom', [BottomController::class,'index']);
    Route::get('/news', [NewsController::class,'index']);
    Route::get('/admin', [AdminController::class,'index']);
    Route::get('/menu', [MenuController::class,'index']);


    Route::post('/title', [TitleController::class,'store']);
    Route::post('/ad', [AdController::class,'store']);
    Route::post('/imag', [ImagController::class,'store']);
    Route::post('/mvim', [MvimController::class,'store']);
    Route::post('/news', [NewsController::class,'store']);
    Route::post('/admin', [AdminController::class,'store']);
    Route::post('/menu', [MenuController::class,'store']);

   
});

//modal
// Route::view('/modals/addTitle','modals.base_modal',['modal_hearder'=>'新增網站標題']);

Route::get('/modals/addTitle',[TitleController::class,'create']);
Route::get('/modals/addAd',[AdController::class,'create']);
Route::view('/modals/addImag','modals.base_modal',['modal_hearder'=>'新增校園映像圖片']);



