<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;

class UserController
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json(['status' => true, 'users' => $users, ]);
    }
}
