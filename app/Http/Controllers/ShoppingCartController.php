<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function index()
    {
        // Aquí podrías obtener los productos en el carrito del usuario actual
        $user = Auth::user();
        $cartItems = $user->shoppingCarts()->with('product')->get();
        // dd($user->toArray());
        dd($user);
        return view('shopping.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Agregar el producto al carrito del usuario actual
        $user = Auth::user();
        $user->shoppingCarts()->attach($request->product_id, ['quantity' => $request->quantity]);

        return redirect()->route('shopping.index')->with('success', 'Producto agregado al carrito correctamente');
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Actualizar la cantidad del producto en el carrito del usuario actual
        $user = Auth::user();
        $user->shoppingCarts()->updateExistingPivot($id, ['quantity' => $request->quantity]);

        return redirect()->route('shopping.index')->with('success', 'Cantidad de producto actualizada correctamente');
    }

    public function destroy($id)
    {
        // Eliminar el producto del carrito del usuario actual
        $user = Auth::user();
        $user->shoppingCarts()->detach($id);

        return redirect()->route('shopping.index')->with('success', 'Producto eliminado del carrito correctamente');
    }
}
