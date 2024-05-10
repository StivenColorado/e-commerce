<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    use UploadFile;
    //TODO repasar
    public function home()
    {
        //traer categorias con productos
        $categories = Category::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();
        $productsByCategory = [];
        // Obtener 5 productos por catergoria
        foreach ($categories as $category) {
            $products = Product::with('file')
                ->where('category_id', $category->id)
                ->where('stock', '>', 0)
                ->limit(5)
                ->get();
            // Verificar si la categoría tiene productos
            if ($products->count() > 0) {
                $productsByCategory[$category->name] = $products;
            }
        }
        return view('index', compact('productsByCategory'));
    }

    public function index()
    {
        $products = Product::with('category', 'file')->get();
        return view('products.index', compact('products'));
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
