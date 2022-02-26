<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'is_invoiced'
    ];
	
	/**
     * Get the user record associated with the purchase.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	/**
     * Get the product record associated with the purchase.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
