<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/users', function (Request $request) {
//    return response()->json(['status' => true, 'message' => 'Listar usuário',]);
//});

Route::get('/users', [UserController::class, 'index']);
