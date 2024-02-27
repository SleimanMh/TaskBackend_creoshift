<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
use App\Exports\UsersExport;

class UserController extends Controller
{
    //
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

    public function show(User $user)
    {
        $seconds = 60 * 60; 
        $users = Cache::remember('users', $seconds, function () {
        return DB::table('users')->get();
        });
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    return response(['success' => true, 'data' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $seconds = 60 * 60; 
        $users = Cache::remember('users', $seconds, function () {
        return DB::table('users')->get();
        });

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

        return response(['data' => $user], Response::HTTP_NO_CONTENT);
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}
