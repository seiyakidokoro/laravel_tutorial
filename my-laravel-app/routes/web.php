<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/grid/','GridController@index');

// API
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


// Blog
Route::get('/content/','ContentController@index');

Route::get('/type/','TypeController@index');
