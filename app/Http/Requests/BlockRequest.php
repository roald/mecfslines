<?php

namespace App\Http\Requests;

use App\Models\Block;
use Illuminate\Support\Arr;

class BlockRequest extends BaseRequest
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
            'type' => 'required|in:'. join(',', Arr::flatten(Block::$types)),
            'order' => 'required|integer|min:1',
            'heading' => 'required|min:3',
            'topic' => '',
            'body' => '',
            'grant' => 'required|in:'. join(',', Block::$grants),
        ];
    }
}
