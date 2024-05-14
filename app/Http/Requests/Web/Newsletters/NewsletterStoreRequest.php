<?php

namespace App\Http\Requests\Web\Newsletters;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterStoreRequest extends FormRequest
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

        $id = $this->route('id');


        return [
            'email' => 'required|unique:newsletters,email|email',
            'agreement' => 'required',
        ];
    }
}
