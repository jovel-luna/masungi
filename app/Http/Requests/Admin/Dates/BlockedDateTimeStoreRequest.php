<?php

namespace App\Http\Requests\Admin\Dates;

use Illuminate\Foundation\Http\FormRequest;

class BlockedDateTimeStoreRequest extends FormRequest
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
        $rules = [
            'reason' => 'required',
            'date' => 'required|date',
        ];

        if(!$this->has('is_whole_day')) {
            $rules = array_merge($rules, [
                'time_list' => 'required'
            ]);
        }

        return $rules;
    }

    public function messages() {
        return [
            'time_list.required' => 'Time slot is required.'
        ];
    }
}
