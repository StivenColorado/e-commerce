<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AuthRequest;

class AuthUserApiController extends Controller
{
    public function login(AuthRequest $request)
    {
        // obtener el primer correo
        $user = User::where('email', $request->email)->first();
        // validar
        if (!$user) return response()->json($this->handlerMessage(401), 401);
        if (!Hash::check($request->password, $user->password)) {
            return response()->json($this->handlerMessage(401), 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        $data =  ['access_token' => $token];
        return response()->json($this->handlerMessage(200, $data), 200);
    }

    public function logout()
    {
        // se utiliza el metodo Auth por que ya esta autenticado
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([], 204);
    }
    public function profile()
    {
        return response()->json(['auth_user'=>Auth::user()], 200);
    }


    private function handlerMessage($code, $data = null)
    {
        switch ($code) {
            case 401:
                return ['login' => false, 'message' => 'Password or email not valid'];
            default:
                return ['login' => true, 'message' => 'Login Succesful', 'data' => $data];
        }
    }
}
