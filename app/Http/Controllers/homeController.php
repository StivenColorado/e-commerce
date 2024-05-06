<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('admin')) return redirect('users');
        return redirect('/');
    }
}
