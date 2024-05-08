<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener todos los registros de shopping_carts asociados al usuario actual
        $cartItems = ShoppingCart::where('id_user', $user->id)->get();

        $productIds = $cartItems->pluck('product_id')->unique()->toArray();

        // Obtener los detalles de los productos correspondientes
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $combinedData = [];
        foreach ($cartItems as $cartItem) {
            $productId = $cartItem->product_id;
            $product = $products->get($productId);

            if ($product) {
                $combinedData[] = [
                    'id' => $cartItem->id,
                    'id_user' => $cartItem->id_user,
                    'product_id' => $productId,
                    'quantity' => $cartItem->quantity,
                    'product' => $product->toArray(),
                ];
            }
        }

        if (request()->ajax()) { // si la peticion es ajax
            return response()->json($combinedData);
        }
        return view('shopping.index', compact('combinedData'));
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

        // Establecer un mensaje de éxito
        Session::flash('success', 'El producto se agregó al carrito correctamente.');

        // Redirigir a la página de carrito de compras
        return redirect()->route('shoppingCart.index');
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
