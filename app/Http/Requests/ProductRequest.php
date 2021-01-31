<?php

namespace App\Http\Requests;

use App\Models\Product;

class ProductRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueSlug = 'unique:products';
        if($this->product) $uniqueSlug .= ',slug,'. $this->product->id;

        return [
            'name' => 'required|min:3',
            'slug' => 'required|'. $uniqueSlug,
            'description' => '',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:'. join(',', Product::$types),
            'status' => 'required|in:'. join(',', Product::$stati),
        ];
    }
}
