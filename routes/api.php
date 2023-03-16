<?php

use Illuminate\Support\Facades\Route;

Route::post('/douyin/token', '\App\Http\Controllers\DouYin\AuthController@getAccessToken');
Route::post('/kuaishou/token', '\App\Http\Controllers\KuaiShou\AuthController@getAccessToken');
