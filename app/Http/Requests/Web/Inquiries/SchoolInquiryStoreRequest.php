<?php

namespace App\Http\Requests\Web\Inquiries;

use Illuminate\Foundation\Http\FormRequest;

class SchoolInquiryStoreRequest extends FormRequest
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
            'leadcontact' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'contact_number' => 'required|digits_between:11,11|numeric',
            'school' => 'required',
            'yearlevel' => 'required',
            'preferredtime' => 'required|date_format:H:i',
            'preferreddate' => 'required|date',
            'trail_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'trail_id.required' => 'Trail is required',
            'contact_number.digits_between' => 'Contact number is invalid number.',
            'contact_number.required' => 'Contact number is required.',
            'yearlevel.required' => 'Year level is required.',
            'preferreddate.required' => 'Preferred date is required.',
            'preferreddate.date' => 'Preferred date must be a valid date.',
            'preferredtime.required' => 'Preferred time is required.',
            'preferredtime.date_format' => 'Preferred time must be a valid time.',
        ];
    }
}
