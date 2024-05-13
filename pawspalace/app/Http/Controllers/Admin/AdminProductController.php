<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => Lang::get('controllers.admin_product.index_title'),
            'products' => Product::all(),
        ];

        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Product::validateProduct($request);

        $newProduct = new Product();
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setCategory($request->input('category'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setStock($request->input('stock'));
        $newProduct->setImage('game.png');
        $newProduct->save();

        if ($request->hasFile('image')) {
            $imageName = $newProduct->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newProduct->setImage($imageName);
            $newProduct->save();
        }

        return back();
    }

    public function delete(string $id): RedirectResponse
    {
        Product::destroy($id);

        return back();
    }

    public function edit($id): View
    {
        $viewData = [
            'title' => Lang::get('controllers.admin_product.edit_title'),
            'product' => Product::findOrFail($id),
        ];

        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        Product::validateProduct($request);

        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setCategory($request->input('category'));
        $product->setPrice($request->input('price'));
        $product->setStock($request->input('stock'));

        if ($request->hasFile('image')) {
            $imageName = $product->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
        }

        $product->save();

        return redirect()->route('admin.product.index');
    }
}
