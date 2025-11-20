<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->get();

        return response()->json([
            'success' => true,
            'count' => $users->count(),
            'data' => $users
        ]);
    }

    // Menampilkan detail satu user
    public function show($id)
    {
        $user = User::select('id', 'name', 'email', 'created_at')
                     ->where('id', $id)
                     ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }
}
