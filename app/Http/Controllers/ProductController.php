<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    use UploadFile;


    public function home()
    {
        // Obtener todas las categorías
        $categories = Category::all();

        // almacenar los productos por categoría
        $productsByCategory = [];

        // Obtener hasta 5 productos para cada categoría
        foreach ($categories as $category) {
            $products = Product::with('supplier', 'file')
                        ->where('category_id', $category->id)
                        ->where('stock', '>', 0)
                        ->limit(5)
                        ->get();

            // matriz de productos por categoría
            $productsByCategory[$category->name] = $products;
        }

        return view('index', compact('productsByCategory'));
    }


    public function index()
    {
        $suppliers = Supplier::get();
        $products = Product::with('supplier', 'category', 'file')->get();
        return view('products.index', compact('products', 'suppliers'));
    }


    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = new Product($request->all());
            $product->save();
            $this->uploadFile($product, $request);
            DB::commit();
            return response()->json([], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function show(Product $product)
    {
        return response()->json(['product' => $product], 200);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update($request->all());
            $this->uploadFile($product, $request);
            DB::commit();
            return response()->json([], 204);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $this->deleteFile($product);
        return response()->json([], 204);
    }
}
