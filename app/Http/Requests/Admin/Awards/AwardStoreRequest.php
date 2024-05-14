<?php

namespace App\Http\Requests\Admin\Awards;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\Image;

class AwardStoreRequest extends FormRequest
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
            'title' => 'required'
        ];
        
        if (!$id) {
            $rules = array_merge($rules, [
                'image_path' => 'required|image',
            ]);
        } else {
            $rules = array_merge($rules, [
                'image_path' => 'nullable|image',
            ]);
        }

        return $rules;
    }
}
