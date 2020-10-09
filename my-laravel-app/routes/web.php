<?php

use Illuminate\Support\Facades\Route;
Route::get('/vue', function () {
    return view('vue');
});

Route::get('/','ContentController@index');

// タスクダッシュボード表示
Route::get('/task','TaskController@index');

// 新規タスク作成
Route::post('/task','TaskController@store');

// 詳細
Route::get('/task/{task}/show','TaskController@show');

// 編集
Route::get('/task/{task}/edit','TaskController@edit')->name('task_edit');

// タスク更新
Route::post('/task/','TaskController@update');

// タスク削除
Route::post('/task/{task}/delete','TaskController@destroy')->name('article_delete');

// Grid
Route::get('/sol/','SolController@index');

// API
Route::get('/api/get_products','ApiController@get_products');

Route::get('/api','ApiController@index');

Route::post('/api','ApiController@index');

Route::post('/api/all','ApiController@all');

Route::post('/api/content','ApiController@content');

Route::post('/api/content_details','ApiController@content_details');

Route::get('/api/get','ApiController@get');

Route::post('/api/add_contents','ApiController@add_contents');


Route::post('/api/add_content_details','ApiController@add_content_details');

Route::post('/api/save_content_detail','ApiController@save_content_detail');

Route::post('/api/delete_content','ApiController@delete_content');

Route::post('/api/delete_content_detail','ApiController@delete_content_detail');


// Blog
Route::get('/content/','ContentController@index');

Route::get('/type/','TypeController@index');


//管理画面
Route::group(['prefix' => 'manager'], function () {
	// 商品一覧表示
	Route::get('/products','ProductController@index');


	// 新規作成
	Route::get('/product/new','ProductController@new');


	// 新規商品作成
	Route::post('/product','ProductController@store');


	// 商品編集
	Route::get('/product/{product}/edit','ProductController@edit')->name('product_edit');


	// 商品更新
	Route::post('/product/update','ProductController@update');


	// 商品削除
	Route::get('/product/{product}/delete','ProductController@delete')->name('product_delete');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
