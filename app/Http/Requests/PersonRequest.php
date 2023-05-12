<?php

namespace App\Http\Requests;

use App\Models\Person;

class PersonRequest extends BaseRequest
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
        $uniqueSlug = 'unique:people';
        if($this->person) $uniqueSlug .= ',slug,'. $this->person->id;

        return [
            'name' => 'required|min:3',
            'slug' => 'required|'. $uniqueSlug,
            'role' => 'nullable',
            'order' => 'required|integer|min:1',
            'information' => 'nullable',
        ];
    }
}
