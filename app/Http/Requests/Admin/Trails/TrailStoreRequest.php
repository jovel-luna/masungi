<?php

namespace App\Http\Requests\Admin\Trails;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\DateTime;
use App\Rules\Image;
use App\Rules\File;

class TrailStoreRequest extends FormRequest
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
            'experience_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'capacity_per_day' => 'required',
        ];
                return $rules;

    }

    public function messages() {
        return [
            'experience_id.required' => 'Please select a experience',
            'capacity_per_day.required' => 'Please input a capacity number',
        ];
    }
}
