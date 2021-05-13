<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Multimedia;

class MultimediaStoreRequest extends FormRequest
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
        // Amazon is required for larger media files
        if( env('TALC_MEDIA_AMAZON', false) ) $maxSize = 512000;
        else $maxSize = 5120;

        return [
            'media' => 'required|max:'. $maxSize .'|mimetypes:'. join(',', array_keys(Multimedia::$mimetypes)),
        ];
    }
}
