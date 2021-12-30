<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(9, '*', 'products_page');

        return view('pages.products.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:products,slug|string|max:255',
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.1',
            'in_stock' => 'required|numeric|min:0',
            'active' => 'in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = Product::create($request->except(['_token']));

        if ($request->has('image') && $product) {
            $image = $request->file('image');
            $newName = md5($image->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $image->getExtension();

            $upload = Storage::disk('do_spaces')->putFileAs(
                'products', $image, $newName
            );

            Storage::disk('do_spaces')->setVisibility($upload, 'public');

            $product->update([
                'image' => $upload
            ]);
        }

        if ($product) {
            return redirect()->to(route('products.index'))->with('success_short', 'Продукт добавлен');
        }

        return back()->with('error_short', 'Продукт не добавлен');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'slug' => 'required|unique:products,slug,' . $id .'|string|max:255',
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.1',
            'in_stock' => 'required|numeric|min:0',
            'active' => 'in:0,1',
            'image' => 'nullable|image|string|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product->update($request->except(['_token']));

        if ($request->has('image') && $product) {
            $image = $request->file('image');
            $newName = md5($image->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $image->getExtension();

            $upload = Storage::disk('do_spaces')->putFileAs(
                'products', $image, $newName
            );

            Storage::disk('do_spaces')->setVisibility($upload, 'public');

            $product->update([
                'image' => $upload
            ]);
        }

        if ($product) {
            return redirect()->to(route('products.index'))->with('success_short', 'Продукт обновлен');
        }

        return back()->with('error_short', 'Продукт не обновлен');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.products.edit', compact('product'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->delete()) {
            return redirect()->to(route('products.index'))->with('success_short', 'Продукт удален');
        }
        return back()->with('error_short', 'Продукт не удален');
    }
}
