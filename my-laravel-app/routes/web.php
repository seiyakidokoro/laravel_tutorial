<?php

use Illuminate\Support\Facades\Route;

// タスクダッシュボード表示
Route::get('/task','TaskController@index');

// 新規タスク作成
Route::post('/task','TaskController@store');

// 詳細
Route::get('/task/{task}/show','TaskController@show');

// 編集
Route::get('/task/{task}','TaskController@edit')->name('article_edit');

// タスク更新
Route::put('/task/{task}','TaskController@update');

// タスク削除
Route::post('/task/{task}/delete','TaskController@destroy')->name('article_delete');

