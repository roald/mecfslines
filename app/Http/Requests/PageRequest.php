<?php

namespace App\Http\Requests;

use App\Models\Action;
use App\Models\Page;

class PageRequest extends BaseRequest
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
            'page_type' => 'required|in:page,redirect',
            'title' => 'required|min:3',
            'slug' => 'required|min:3|'. $uniqueSlug,
            'description' => '',
            'status' => 'required|in:'. join(',', Page::$stati),
            'order' => 'required|integer|min:1',
            'menu' => 'required|boolean',
            'redirect.type' => 'required_if:type,redirect|in:'. join(',', Action::$types),
            'redirect.page_id' => 'required_if:redirect.type,page|nullable|exists:pages,id',
            'redirect.target' => 'required_if:redirect.type,url',
        ];
    }
}
