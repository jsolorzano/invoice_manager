<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:App\Models\Product,name,'.$this->id,
            'price' => 'required|numeric',
            'tax' => 'required|integer',
            'stock' => 'required|integer',
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.max' => 'A name cannot exceed 255 characters',
            'name.unique' => 'The name already exists ',
            'price.required' => 'You must sent a price',
            'price.integer' => 'You must sent a numeric value for the price',
            'tax.required' => 'You must sent a tax',
            'tax.integer' => 'You must send an integer value for the tax',
            'stock.required' => 'You must sent a stock',
            'stock.integer' => 'You must send an integer value for the stock',
        ];
    }
}
