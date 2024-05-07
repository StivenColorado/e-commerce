<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserRequest;
use App\Providers\RouteServiceProvider;
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

        $user = new User($validatedData);
        $user->assignRole('user'); // Asigna el rol 'user' al usuario
        $user->save();

        Auth::login($user);

        return redirect($this->redirectPath());
    }
}
