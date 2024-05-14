<?php

namespace App\Http\Requests\Web\Inquiries;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsStoreRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'nationality' => 'required',
            'affliation' => 'required',
            'contact_number' => 'required|digits_between:11,11|numeric',
        ];
    }

    public function messages() {
        return [
            'contact_number.digits_between' => 'Invalid contact number.',
            'contact_number.required' => 'Contact number is required.'
        ];
    }
}
