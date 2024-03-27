<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Home Page - PawsPalace';

        return view('/home')->with('viewData', $viewData);
    }
}
