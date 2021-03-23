<?php

namespace App\Http\Requests;

use App\Models\Project;

class ProjectRequest extends BaseRequest
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
        $uniqueSlug = 'unique:projects';
        if($this->project) $uniqueSlug .= ',slug,'. $this->project->id;

        return [
            'title' => 'required|min:3',
            'slug' => 'required|'. $uniqueSlug,
            'type' => 'required|in:'. join(',', Project::$types),
            'status' => 'required|in:'. join(',', Project::$stati),
            'description' => 'nullable',
            'link' => 'nullable|url',
            'published_at' => 'required|date',
        ];
    }
}
