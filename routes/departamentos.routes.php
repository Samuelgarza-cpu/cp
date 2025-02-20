<?php

use App\Http\Controllers\DepartamentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [DepartamentoController::class, 'index']);
Route::get('/selectIndex', [DepartamentoController::class, 'selectIndex']);
Route::get('/{id}', [DepartamentoController::class, 'show']);
