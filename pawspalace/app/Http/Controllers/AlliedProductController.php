<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ProductAliadosController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        $response = Http::get('http://34.172.10.50/public/api/recipes');
        $recipes = $response->json();

        $viewData['recipes'] = $recipes;

        return view('products.index')->with('viewData', $viewData);
    }
}
