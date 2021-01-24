<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        $uniqueSlug = 'unique:events';
        if($this->event) $uniqueSlug .= ',slug,'. $this->event->id;

        return [
            'title' => 'required|min:3',
            'slug' => 'required|'. $uniqueSlug,
            'type' => 'required|in:'. join(',', Event::$types),
            'description' => 'required',
            'started_at' => 'required|date',
            'ended_at' => 'required|date|after:started_at',
        ];
    }
}
