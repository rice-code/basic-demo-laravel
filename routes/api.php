<?php

use Illuminate\Support\Facades\Route;

Route::post('/douyin/token', '\App\Http\Controllers\DouYin\AuthController@getAccessToken');
Route::post('/douyin/callback', '\App\Http\Controllers\DouYin\AuthController@callback');

Route::post('/kuaishou/token', '\App\Http\Controllers\KuaiShou\AuthController@getAccessToken');
Route::post('/kuaishou/callback', '\App\Http\Controllers\KuaiShou\AuthController@callback');
