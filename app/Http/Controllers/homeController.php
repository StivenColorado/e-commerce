<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('admin')) return redirect('users');

        $cart = ShoppingCart::where('user_id', $user->id)->first();
        $amountItemCard = $cart ? $cart->items->count() : 0;

        return view('welcome', compact('amountItemCard'));
    }

    public function getAmountItemCard()
    {
        $user = Auth::user();
        $cart = ShoppingCart::where('user_id', $user->id)->first();
        $amountItemCard = $cart ? $cart->items->count() : 0;

        return response()->json(['amountItemCard' => $amountItemCard]);
    }
}
