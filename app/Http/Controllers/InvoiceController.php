<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Purchase;
use App\Models\PurchaseInvoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $user = $request->user();

        if ($user->isAdmin()) {
            $invoices = Invoice::orderBy('id', 'desc')->get();
            $view = 'invoices/list';
        } else {
            abort_unless(Auth::check(), 404);
        }
        return view($view, [
            'invoices' => $invoices
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $invoice_id
     * @return \Illuminate\Http\Response
     */
    public function detail($invoice_id)
    {
		abort_unless(Auth::check(), 404);
        $user = Auth::user();

        if ($user->isAdmin()) {
			$invoice = Invoice::where('id', $invoice_id)->first();
			
			abort_unless($invoice, 404);
			
			// Purchases associated with invoices
			$invoice_purchases = PurchaseInvoice::where('invoice_id', $invoice->id)->orderBy('id', 'desc')->get();
			$invoice->invoice_purchases = $invoice_purchases;
			$invoice->client = $invoice_purchases[0]->purchase->user->name;
		} else {
            abort_unless(false, 404);
        }
		
        return view('invoices/invoice_detail', [
            'invoice' => $invoice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $user = $request->user();

        if ($user->isAdmin()) {
            
            // Uninvoiced purchases 
            $available_purchases = Purchase::where('is_invoiced', false)->orderBy('id', 'desc')->get();
            
            if(!$available_purchases->isEmpty()){
				
				// Get users_ids
				$users_ids = [];
				foreach($available_purchases as $purchase){
					if(!in_array($purchase->user_id, $users_ids)){
						$users_ids[] = $purchase->user_id;
					}
				}
				
				// Create invoices and associate purchases by user.
				foreach($users_ids as $user_id){
					$invoice = new Invoice;
					$invoice->user()->associate($user);

					$invoice->save();
					
					foreach($available_purchases as $purchase){
						if($purchase->user_id == $user_id){
							$purchase_invoice = new PurchaseInvoice;
							$purchase_invoice->purchase()->associate($purchase);
							$purchase_invoice->invoice()->associate($invoice);

							$purchase_invoice->save();
							
							// Update purchase
							$purchase->is_invoiced = true;
							$purchase->save();
						}
					}
				}
				
			}
            
            $invoices = Invoice::orderBy('id', 'desc')->get();
            
            if ($invoices->isEmpty()) {
				return back()->withErrors(['msg', 'There was an error updating the post, please try again later']);
			}
			
			// Purchases associated with invoices
			foreach($invoices as $invoice){
				$invoice_purchases = PurchaseInvoice::where('invoice_id', $invoice->id)->orderBy('id', 'desc')->get();
				$invoice->invoice_purchases = $invoice_purchases;
				$invoice->client = $invoice_purchases[0]->purchase->user->name;
			}

            $view = 'invoices/invoices';
            
			return view($view, [
				'invoices' => $invoices
			]);
			
        } else {
			
            abort_unless(false, 401);
            
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
