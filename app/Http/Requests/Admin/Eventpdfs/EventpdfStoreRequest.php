<?php

namespace App\Http\Requests\Admin\Eventpdfs;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\DateTime;
use App\Rules\Image;
use App\Rules\File;

class EventpdfStoreRequest extends FormRequest
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
            'event_id' => ['required'],
            'name' => ['required', new Varchar],
            'document_path' => ['nullable', new File],
        ];
                return $rules;

    }

    public function messages() {
        return [
            'event_id.required' => 'Event is required.' 
        ];
    }
}
