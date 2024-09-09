<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\UserApiStoreRequest;
use Illuminate\Support\Facades\DB;


class UserController
{
    public function index() : JsonResponse
    {
//        $users = User::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->paginate(1);
        return response()->json(['status' => true, 'users' => $users, ]);
    }
    public function store(Request $request) : JsonResponse
    {
        //dd($request);
        // Iniciar a transação
        DB::beginTransaction();
        try {
            // Criar o usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            // Confirmar a transação
            DB::commit();

            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usário criado com sucesso'
            ],400);


        } catch (Exception $e) {
            // Rollback da transação
            DB::rollBack();
            // Tratar o erro
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ],400);
        }
    }
    public function login(Request $request) : JsonResponse
    {
        if (auth()->attempt($request->only('email', 'password'))) {

            // Recuperar dados do usuário
            $user = Auth()->user();
            // Gerar um token
            $token = $request->user()->createToken('api-token')->plainTextToken; //$user->createToken('token')->plainTextToken;


            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user,
                'message' => 'Login realizado com sucesso',
            ],201);

        } else {
            return response()->json([
                'status' => false,
                'token' => '1234567890987654321',
                'message' => 'Login ou senha incorreta!',
                'email' => $request->email,
            ],404);
        };
    }
    public function logout() : JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout realizado com sucesso',
        ],200);
    }
// teste
}
