<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();

            return response()->json([
                'error' => null,
                'result' => [
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name']
                ]
            ], 200, [], JSON_PRETTY_PRINT);
        }

        return response()->json([
            'error' => 'error',
            'result' => [],
        ], 401);
    }
}
