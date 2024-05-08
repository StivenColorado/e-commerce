<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function index()
    {
        // Aquí podrías obtener los productos en el carrito del usuario actual
        $user = Auth::user();
        $cartItems = $user->shoppingCarts()->with('product')->get();
        // dd($user->toArray());
        // dd($user);
        return view('shopping.index', compact('cartItems'));
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Crear una nueva instancia de ShoppingCart
            $shoppingCart = new ShoppingCart();
            $shoppingCart->id_user = Auth::id(); // Obtener el ID del usuario autenticado
            $shoppingCart->product_id = $request->product_id; // Asignar el ID del producto enviado desde el formulario
            $shoppingCart->quantity = $request->quantity; // Asignar la cantidad del producto

            // Guardar el carrito de compras
            $shoppingCart->save();

            DB::commit();

            // Retornar una respuesta JSON vacía con un código de estado 200
            return response()->json([], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
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
