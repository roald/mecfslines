<?php

namespace App\Http\Requests;

use App\Models\Roster;

class RosterRequest extends BaseRequest
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
            'weekday' => 'required|integer|min:1|max:7',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'started_at' => 'required|date',
            'ended_at' => 'nullable|date|after:started_at',
            'title' => 'required|min:3',
            'type' => 'required|in:'. join(',', Roster::$types),
            'url' => 'required_if:type,external|nullable|url',
            'description' => 'nullable|string',
        ];
    }
}
