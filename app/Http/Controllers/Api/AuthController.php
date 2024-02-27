<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
    
        if (auth()->attempt($formFields)) {
            $user = auth()->user();
            
            $token = $user->createToken('auth-token', ['read']);
            
            return response()->json(['success'=>true,'token' => $token->plainTextToken, 'user' => $user]);
        }
    
        return response()->json(['success' => false], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['success' => true]);
    }
}
