<?php

namespace App\Http\Requests;

class PostRequest extends BaseRequest
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
        $uniqueSlug = 'unique:posts';
        if($this->post) $uniqueSlug .= ',slug,'. $this->post->id;

        return [
            'title' => ['required','min:3'],
            'slug' => ['required',$uniqueSlug],
            'content' => ['nullable'],
            'published_at' => ['required','date'],
        ];
    }
}
