<?php

namespace App\Http\Requests;

use App\Models\User;

class UserRequest extends BaseRequest
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
        $uniqueEmail = 'unique:users';
        if( $this->user ) $uniqueEmail .= ',email,'. $this->user->id;
        return [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns|'. $uniqueEmail,
            'role' => 'required|in:'. join(',', User::$roles),
        ];
    }
}
