<?php

namespace App\Http\Requests\Web\Inquiries;

use Illuminate\Foundation\Http\FormRequest;

class WeddingInquiryStoreRequest extends FormRequest
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
            'fullname' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required|digits_between:11,11|numeric',
            'eventtype' => 'required',
            'guestsnumber' => 'required',
            'date' => 'required|date',
        ];
    }
    
    public function messages()
    {
        return [
            'contact_number.digits_between' => 'Contact number is invalid number.',
            'contact_number.required' => 'Contact number is required.',
            'eventtype.required' => 'Event type is required.',
            'guestsnumber.required' => 'Guest number is required.',
        ];
    }
}
