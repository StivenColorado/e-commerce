<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index(){
        return view('search.index');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Realiza la consulta en el modelo deseado
        $results = Product::where('title', 'like', "%{$query}%")->get();

        return view('search.index', compact('results', 'query'));
    }
}
