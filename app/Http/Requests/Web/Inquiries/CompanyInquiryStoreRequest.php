<?php

namespace App\Http\Requests\Web\Inquiries;

use Illuminate\Foundation\Http\FormRequest;

class CompanyInquiryStoreRequest extends FormRequest
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
            'leadcontact' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'contact_number' => 'required|digits_between:11,11|numeric',
            'purpose' => 'required',
            'purpose' => 'required',
            'preferreddate' => 'required|date',
            'participants' => 'required|integer|min:1',
        ];
    }

    public function messages() {
        return [
            'contact_number.digits_between' => 'Invalid contact number.',
            'contact_number.required' => 'Contact number is required.',
            'preferreddate.required' => 'Preferred date is required.',
            'preferreddate.date' => 'Preferred date must be a valid date.',
            'leadcontact.required' => 'Lead contact is required'
        ];
    }
}
