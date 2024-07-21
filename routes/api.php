<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/users', function (Request $request) {
//    return response()->json(['status' => true, 'message' => 'Listar usuário',]);
//});

Route::get('/users', [UserApiController::class, 'index']); // GET - http;//1localhost:8000/api/users?page=1
Route::post('/users', [UserApiController::class, 'store']); // POST - http;//1localhost:8000/api/users
Route::delete('/users/{user}', [UserApiController::class, 'destroy']); // DELETE - http;//1localhost:8000/api/users/1
Route::get('/users/{user}', [UserApiController::class, 'show']); // GET - http;//1localhost:8000/api/users/1
Route::put('/users/{user}', [UserApiController::class, 'update']); // PUT - http;//1localhost:8000/api/users/1
