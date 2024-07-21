<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserApiStoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserApiController extends Controller
{
    public function index() : JsonResponse
    {   
        // Recuperar usuarios
        $users = User::orderBy('id', 'desc')->where('deleted_at', '=', null)->paginate(2);
        // Retornar os usuarios como resposta JASON
        return response()->json(['status' => true, 'users' => $users,],200);
    }
    public function show(User $user) : JsonResponse
    {
        return response()->json(['status' => true, 'user' => $user,],200);
    }
    public function store(UserApiStoreRequest $request) : JsonResponse
    {
        //dd($request);
        // Iniciar a transação
        DB::beginTransaction();
        try {
            // Criar o usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
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
    public function update(UserApiStoreRequest $request, User $user) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $user->update($request->all());
            DB::commit();
            return response()->json([
                'status' => true, 
                'user' => $user,
                'message' => 'Usário atualizado com sucesso'
            ],200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false, 
                'message' => $e->getMessage(),
            ],400);
        }
    }
    public function destroy(int $id) : JsonResponse
    {
        //dd($id);
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false, 
                'message' => 'Usário inexistente',
            ],400);
        }
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return response()->json([
                'status' => true, 
                'message' => 'Usário excluído com sucesso',
            ],200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false, 
                'message' => $e->getMessage(),
            ],400);
        }
    }
}
