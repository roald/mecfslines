<?php

namespace App\Http\Requests;

use Auth;

class AdminProfileRequest extends BaseRequest
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
        if( Auth::check() ) $uniqueEmail .= ',email,'. Auth::user()->id;
        return [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns|'. $uniqueEmail,
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}
