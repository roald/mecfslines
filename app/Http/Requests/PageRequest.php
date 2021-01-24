<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
     * Prepare the data for validation
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'menu' => !empty($this->menu),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueSlug = 'unique:pages';
        if($this->page) $uniqueSlug .= ',slug,'. $this->page->id;

        return [
            'title' => 'required|min:3',
            'slug' => 'required|min:3|'. $uniqueSlug,
            'description' => '',
            'status' => 'required|in:'. join(',', Page::$stati),
            'order' => 'required|integer|min:1',
            'menu' => 'required|boolean'
        ];
    }
}
