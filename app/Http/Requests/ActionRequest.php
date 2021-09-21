<?php

namespace App\Http\Requests;

use App\Models\Action;

class ActionRequest extends BaseRequest
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
        $emailTarget = ($this->type == 'email' ? '|email:rfc,dns' : '');
        return [
            'page_id' => 'required_if:type,page|nullable|exists:pages,id',
            'type' => 'required|in:'. join(',', Action::$types),
            'action' => 'required|min:2',
            'target' => 'required_if:type,url,email' . $emailTarget,
            'order' => 'required|integer|min:1',
            'role' => '',
        ];
    }
}
