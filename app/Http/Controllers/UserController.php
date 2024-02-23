<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show(User $user)
    {
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    return response(['success' => true, 'data' => $user]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create($request->all());

        return response(['success' => true, 'data' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'sometimes|required|string|min:8',
        'role' => 'required|in:admin,user',
    ]);

    $user->update($request->all());

    return response(['success' => true, 'data' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['success' => true]);
    }

}
