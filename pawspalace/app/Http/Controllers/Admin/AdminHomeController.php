<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Admin - Pawspalace';

        return view('admin.home.index')->with('viewData', $viewData);
    }
}
