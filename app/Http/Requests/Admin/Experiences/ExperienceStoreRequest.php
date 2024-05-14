<?php

namespace App\Http\Requests\Admin\Experiences;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\DateTime;
use App\Rules\Image;
use App\Rules\File;

class ExperienceStoreRequest extends FormRequest
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
            'name' => ['required', new Varchar],
            'operating_hours' => 'required',
            'operating_hours_end' => 'required',
        ];
                return $rules;

    }

    public function messages() {
        return [

        ];
    }
}
