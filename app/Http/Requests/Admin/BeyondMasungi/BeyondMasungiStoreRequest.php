<?php

namespace App\Http\Requests\Admin\BeyondMasungi;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\DateTime;
use App\Rules\Image;

class BeyondMasungiStoreRequest extends FormRequest
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

        $rules = [
            'title' => ['required', new Varchar],
            'description' => ['nullable', 'max:1000'],
        ];
    

        return $rules;
    }
}
