<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        $request->validated();
        $user = Auth::user();

        $request->user()->authorizeRoles(['is_client']);
        
        $product = Product::find($request->input('product_id'));
        
        if((int)$request->input('quantity') > (int)$product->stock){
			return back()->withErrors(['The product is out of stock, please try again later']);
		}

        $purchase = new Purchase;
        $purchase->user()->associate($user);
        $purchase->product()->associate($product);
        $purchase->quantity = $request->input('quantity');

        $res = $purchase->save();

        if ($res) {
			// stock update 
			$product->stock = $product->stock - (int)$request->input('quantity');
			$upd_stock = $product->save();
			
            return back()->with('status', 'Product has been created sucessfully');
        }

        return back()->withErrors(['msg', 'There was an error saving the purchase, please try again later']);
    }
}
