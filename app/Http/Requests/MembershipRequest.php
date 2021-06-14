<?php

namespace App\Http\Requests;

use App\Models\Membership;

class MembershipRequest extends BaseRequest
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
            'name' => 'required|min:3',
            'description' => 'required',
            'duration' => 'required|in:'. join(',', Membership::$durations),
            'price' => 'required|min:0',
            'status' => 'required|in:'. join(',', Membership::$stati),
            'extend_id' => 'nullable|exists:memberships,id',
        ];
    }
}
