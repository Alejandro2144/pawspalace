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

    public function about()
    {
        $viewData = [];
        $viewData['title'] = 'About us - Online Store';
        $viewData['subtitle'] = 'About us';
        $viewData['description'] = 'This is an about page ...';
        $viewData['author'] = 'Developed by: Your Name';

        return view('home.about')->with('viewData', $viewData);
    }
}
