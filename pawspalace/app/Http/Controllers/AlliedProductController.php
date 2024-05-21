<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AlliedProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        $response = Http::get('http://temporal.migueljaramillo.tech/api/travels');
        $recipes = $response->json();

        $viewData['recipes'] = $recipes;

        return view('allied.product')->with('viewData', $viewData);
    }
}
