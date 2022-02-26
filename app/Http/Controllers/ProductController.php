<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
	/**
     * Buy the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function purchase(Request $request, $product_id)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_client']);
        $product = Product::where('id', $product_id)->where('stock', '>', 0)->first();
        abort_unless($product, 404);
        return view('products/buy', [
            'product' => $product
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $user = $request->user();

        if ($user->isAdmin()) {
            $products = Product::orderBy('id', 'desc')->get();
            $view = 'products/list';
        } elseif ($user->isClient()) {
            $products = Product::where('stock', '>', 0)->orderBy('created_at', 'desc')->get();
            $view = 'products/list_to_clients';
        } else {
            abort_unless(Auth::check(), 404);
        }
        return view($view, [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_admin']);
        return view('products/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        $user = Auth::user();

        $request->user()->authorizeRoles(['is_admin']);

        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->tax = $request->input('tax');
        $product->stock = $request->input('stock');

        $res = $product->save();

        if ($res) {
            return back()->with('status', 'Product has been created sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error saving the product, please try again later']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * \App\Http\Requests\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_admin']);
        $product = Product::find($id);
        if (!$request->user()->isAdmin()) {
            abort_unless(false, 401);
        }
        return view('products/edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $request->validated();
        $request->user()->authorizeRoles(['is_admin']);
        $product = Product::find($id);
        if (!$request->user()->isAdmin()) {
            abort_unless(false, 401);
        }

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->tax = $request->input('tax');
        $product->stock = $request->input('stock');

        $res = $product->save();

        if ($res) {
            return back()->with('status', 'Product has been updated sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error updating the post, please try again later']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        abort_unless(Auth::check(), 404);
        $request->user()->authorizeRoles(['is_admin']);
        $product = Product::where('id', $id)->first();
        if (!$request->user()->isAdmin()) {
            abort_unless(false, 401);
        }

        $product->delete();

        return back()->with('status', 'Product has been deleted sucessfully');
    }
}
