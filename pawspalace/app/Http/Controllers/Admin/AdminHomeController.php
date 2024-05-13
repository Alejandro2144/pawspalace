<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class AdminHomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = Lang::get('controllers.admin_home.index_title');

        return view('admin.home.index')->with('viewData', $viewData);
    }
}
