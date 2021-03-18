<?php

namespace App\Http\Requests;

class OrderRequest extends BaseRequest
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
        return [
            'amount' => 'required|numeric|min:0',
            'membership_id' => 'nullable|exists:memberships,id',
            'product_ids' => 'nullable|array',
            'products_ids.*' => 'if:product_ids|exists:products,id',
        ];
    }
}
