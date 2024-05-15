<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{


    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'number_id' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'password' => ['confirmed', 'string', 'min:8'],
        ]);
        //en caso de error (correo repetido etc..)
        try {
            //instanciar  usuario y asignar rol
            $user = new User($validatedData);
            $user->assignRole('user');
            $user->save();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withInput()->withErrors(['email' => 'El correo electrónico ya está registrado']);
            }
            return redirect()->back()->withInput()->withErrors(['general' => 'Hubo un problema al registrar el usuario']);
        }

        Auth::login($user);

        return redirect($this->redirectPath());
    }
}
