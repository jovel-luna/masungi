<?php

namespace App\Http\Requests\Admin\AddOns;

use Illuminate\Foundation\Http\FormRequest;

class AddOnStoreRequest extends FormRequest
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
            'name' => 'required',
            'trail_ids' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'trail_ids.required' => 'The trail field is required'
        ];
    }
}