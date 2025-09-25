<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\ObatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/kategori',[KategoriController::class,'index']);
Route::get('/obat',[ObatController::class,'index']);
Route::post('/kategori',[KategoriController::class,'store']);
Route::post('/obat',[ObatController::class,'store']);
Route::patch('/kategori/{id}',[KategoriController::class,'update']);
Route::delete('/kategori/{id}',[KategoriController::class,'destroy']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);