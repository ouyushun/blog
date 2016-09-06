<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

    //登录，验证码；
    Route::any('admin/login', 'Admin\ManagerController@login');
    Route::any('admin/valid', 'Admin\ManagerController@validateCode');


Route::group(['namespace'=>'Home'], function ()
{
    Route::get('/', 'IndexController@index');
    Route::get('orderbyview', 'IndexController@orderbyview');
    Route::get('read/{art_id}', 'IndexController@read');

});





//Admin

Route::group(['middleware' => 'admin.login','prefix'=>'admin','namespace'=>'Admin'], function () 
{
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('logout', 'ManagerController@logout');
    Route::any('modifypassword', 'ManagerController@modifypassword');
    
    
    //Catrgory
    Route::get('catelist', 'CategoryController@catelist');
    Route::post('changeOrder', 'CategoryController@changeOrder');
    Route::any('cateadd', 'CategoryController@cateadd');
    Route::any('cateedit/{cate_id}', 'CategoryController@cateedit');
    Route::any('cateupdate/{cate_id}', 'CategoryController@cateupdate');
    Route::post('delcate/{cate_id}', 'CategoryController@delCate');
    
    //artical
    Route::get('artical/artlist', 'ArticalController@artlist');
    Route::any('artical/artadd', 'ArticalController@artadd');
    Route::any('artical/upload', 'ArticalController@upload');
    Route::get('artical/edit/{art_id}', 'ArticalController@edit');
    Route::post('artical/update/{art_id}', 'ArticalController@update');
    Route::post('artical/artdel/{art_id}', 'ArticalController@artdel');
    
    //Links
    Route::get('link/list', 'LinkController@linklist');
    Route::post('link/changeOrder', 'LinkController@changeOrder');
    Route::get('link/edit/{link_id}', 'LinkController@edit');
    Route::post('link/update/{link_id}', 'LinkController@update');
    Route::any('link/addlink', 'LinkController@addlink');
    Route::post('link/del/{link_id}', 'LinkController@del');



});







/*
Route::get('user/{id?}', function ($m=null) {
    return 'User '.$m;
});

Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return $postId.$commentId;
});
*/

/*
Route::group(['middleware' => 'web'], function () {
    Route::get('/test', function () {
        session(['key'=>'sss']);
        return 'test';
    });

    Route::get('/sess', function () {
        echo session('key');
        return '#####';
    });
});*/


//Route::group(['middleware' => ['admin.login']], function () {
//    Route::get('/test', function () {
//        
//        return 'test';
//    });
//
//    Route::get('/sess', function () {
//        
//        return '#####';
//    });
//});