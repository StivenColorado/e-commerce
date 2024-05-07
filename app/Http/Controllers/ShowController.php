<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Product;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index($id)
    {
        $product = Product::findOrFail($id); // Suponiendo que Product sea el modelo del producto
        // dd($product);
        // Luego, pasas estos datos a la vista
        return view('show.index', compact('product'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $show = Show::findOrFail($id);

        $product = $show->product;

        $category = $product->category;

        $showsInCategory = $category->shows;

        return view('show.index', ["product" => $product, "id" => $id]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
    }
}
