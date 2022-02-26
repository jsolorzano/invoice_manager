<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'purchase_id', 'invoice_id'
    ];
    
    /**
     * Get the purchase record associated with the invoice.
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
	
	/**
     * Get the invoice record associated with the purchase.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
