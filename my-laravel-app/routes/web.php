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

// API
Route::get('/api','ApiController@index');

Route::post('/api','ApiController@index');

// API
Route::get('/api/get','ApiController@get');

// Grid
Route::get('/grid/','GridController@index');
