<?php

namespace App\Http\Requests;

class CommentRequest extends BaseRequest
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
            'user_id' => ['required_without:name', 'nullable', 'exists:users,id'],
            'name' => ['required_without:user_id', 'nullable', 'min:3'],
            'message' => ['required', 'min:3'],
            'commented_at' => ['required', 'date'],
        ];
    }
}
