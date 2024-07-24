<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/users', function (Request $request) {
//    return response()->json(['status' => true, 'message' => 'Listar usuário',]);
//});


    
// Rota pública
Route::post('/login', [UserController::class, 'login'])->name('login');

// Rota restrita
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store']); // POST - http;//1localhost:8000/api/users
});




//Route::delete('/users/{user}', [UserApiController::class, 'destroy']); // DELETE - http;//1localhost:8000/api/users/1
//Route::get('/users/{user}', [UserApiController::class, 'show']); // GET - http;//1localhost:8000/api/users/1
//Route::put('/users/{user}', [UserApiController::class, 'update']); // PUT - http;//1localhost:8000/api/users/1
