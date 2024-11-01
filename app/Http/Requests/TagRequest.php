<?php

namespace App\Http\Requests;

use App\Models\Tag;

class TagRequest extends BaseRequest
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
        $uniqueSlug = 'unique:tags';
        if($this->tag) $uniqueSlug .= ',slug,'. $this->tag->id;

        return [
            'name' => 'required|min:3',
            'slug' => 'required|'. $uniqueSlug,
            'type' => 'required|in:'. join(',', Tag::$types),
            'description' => '',
        ];
    }
}
