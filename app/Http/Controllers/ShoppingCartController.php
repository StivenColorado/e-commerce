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
        $products = Product::with('file')->whereIn('id', $productIds)->get()->keyBy('id');
        // dd($products->toArray());
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
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $userId = Auth::id();

        $product = Product::find($productId);

        if (!$product) {
            Session::flash('error', 'El producto no existe.');
            return redirect()->route('shoppingCart.index');
        }

        $existingShoppingCart = ShoppingCart::where('id_user', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingShoppingCart) {
            if ($existingShoppingCart->quantity < $product->stock) {
                $existingShoppingCart->quantity += 1;
                $existingShoppingCart->save();
                Session::flash('success', 'El producto se agregó al carrito correctamente.');
            } else {
                Session::flash('error', 'La cantidad solicitada supera el stock disponible.');
            }
        } else {
            $shoppingCart = new ShoppingCart();
            $shoppingCart->id_user = $userId;
            $shoppingCart->product_id = $productId;
            $shoppingCart->quantity = $request->quantity;
            $shoppingCart->save();
            Session::flash('success', 'El producto se agregó al carrito correctamente.');
        }

        return redirect()->route('shoppingCart.index');
    }

    public function update(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            Session::flash('error', 'El producto no existe.');
            return redirect()->route('shoppingCart.index');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $shoppingCart = ShoppingCart::where('id_user', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($shoppingCart) {
            if ($request->quantity <= $product->stock) {
                $shoppingCart->quantity = $request->quantity;
                $shoppingCart->save();
                Session::flash('success', 'La cantidad se actualizó correctamente.');
            } else {
                Session::flash('error', 'La cantidad solicitada supera el stock disponible.');
            }
        } else {
            Session::flash('error', 'El producto no existe en el carrito.');
        }

        return redirect()->route('shoppingCart.index');
    }

    public function destroy($id)
    {
        // Eliminar el producto del carrito del usuario actual
        $user = Auth::user();
        // $user->shoppingCarts()->detach($id);

        return redirect()->route('shopping.index')->with('success', 'Producto eliminado del carrito correctamente');
    }
}
