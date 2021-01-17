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
use App\Http\Controllers\subMenuController;
use App\Http\Controllers\HomeController;
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
Route::get('/',[HomeController::class,'index']);
Route::get('/news',[NewsController::class,'list']);
Route::get('/login',[AdminController::class,'showLoginForm']);
Route::redirect('/admin',"/admin/title");


Route::prefix('admin')->group(function(){
    
    Route::get('/title', [TitleController::class,'index']);
    Route::get('/ad', [AdController::class,'index']);
    Route::get('/image', [ImagController::class,'index']);
    Route::get('/mvim', [MvimController::class,'index']);
    Route::get('/total', [TotalController::class,'index']);
    Route::get('/bottom', [BottomController::class,'index']);
    Route::get('/news', [NewsController::class,'index']);
    Route::get('/admin', [AdminController::class,'index']);
    Route::get('/menu', [MenuController::class,'index']);
    Route::get('/submenu/{menu_id}', [SubMenuController::class,'index']);


    Route::post('/title', [TitleController::class,'store']);
    Route::post('/ad', [AdController::class,'store']);
    Route::post('/image', [ImagController::class,'store']);
    Route::post('/mvim', [MvimController::class,'store']);
    Route::post('/news', [NewsController::class,'store']);
    Route::post('/admin', [AdminController::class,'store']);
    Route::post('/menu', [MenuController::class,'store']);
    Route::post('/submenu/{menu_id}', [SubMenuController::class,'store']);

    //update
    
    Route::patch('/title/{id}',[TitleController::class,'update']);
    Route::patch('/ad/{id}',[AdController::class,'update']);
    Route::patch('/image/{id}',[ImagController::class,'update']);
    Route::patch('/mvim/{id}',[MvimController::class,'update']);
    Route::patch('/total/{id}',[TotalController::class,'update']);
    Route::patch('/bottom/{id}',[BottomController::class,'update']);
    Route::patch('/news/{id}',[NewsController::class,'update']);
    Route::patch('/admin/{id}',[AdminController::class,'update']);
    Route::patch('/menu/{id}',[MenuController::class,'update']);
    Route::patch('/submenu/{id}',[SubMenuController::class,'update']);
    
    //delet
    
    Route::delete('/title/{id}',[TitleController::class,'destroy']);
    Route::delete('/ad/{id}',[AdController::class,'destroy']);
    Route::delete('/image/{id}',[ImagController::class,'destroy']);
    Route::delete('/mvim/{id}',[MvimController::class,'destroy']);
    Route::delete('/news/{id}',[NewsController::class,'destroy']);
    Route::delete('/admin/{id}',[AdminController::class,'destroy']);
    Route::delete('/menu/{id}',[MenuController::class,'destroy']);
    Route::delete('/submenu/{id}',[SubMenuController::class,'destroy']);
    
    
    //sh
    Route::patch('/title/sh/{id}',[TitleController::class,'display']);
    Route::patch('/ad/sh/{id}',[AdController::class,'display']);
    Route::patch('/image/sh/{id}',[ImagController::class,'display']);
    Route::patch('/mvim/sh/{id}',[MvimController::class,'display']);
    Route::patch('/news/sh/{id}',[NewsController::class,'display']);
    Route::patch('/menu/sh/{id}',[MenuController::class,'display']);



});

//modal
// Route::view('/modals/addTitle','modals.base_modal',['modal_hearder'=>'新增網站標題']);
// Route::view('/modals/addImag','modals.base_modal',['modal_hearder'=>'新增校園映像圖片']);
Route::get('/modals/addTitle',[TitleController::class,'create']);
Route::get('/modals/addAd',[AdController::class,'create']);
Route::get('/modals/addImage',[ImagController::class,'create']);
Route::get('/modals/addMvim',[MvimController::class,'create']);
Route::get('/modals/addNews',[NewsController::class,'create']);
Route::get('/modals/addAdmin',[AdminController::class,'create']);
Route::get('/modals/addMenu',[MenuController::class,'create']);
Route::get('/modals/addsubmenu/{menu_id}',[SubMenuController::class,'create']);




//edit
Route::get('/modals/title/{id}',[TitleController::class,'edit']);
Route::get('/modals/ad/{id}',[AdController::class,'edit']);
Route::get('/modals/image/{id}',[ImagController::class,'edit']);
Route::get('/modals/Mvim/{id}',[MvimController::class,'edit']);
Route::get('/modals/total/{id}',[TotalController::class,'edit']);
Route::get('/modals/bottom/{id}',[BottomController::class,'edit']);
Route::get('/modals/News/{id}',[NewsController::class,'edit']);
Route::get('/modals/Admin/{id}',[AdminController::class,'edit']);
Route::get('/modals/menu/{id}',[MenuController::class,'edit']);
Route::get('/modals/submenu/{id}',[SubMenuController::class,'edit']);