<?php

namespace App\Http\Requests\Admin\InformationKits;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\DateTime;
use App\Rules\Image;
use App\Rules\File;

class InformationKitStoreRequest extends FormRequest
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
        $required = 'required';
        if($id) {
            $required = '';
        }

        $rules = [
            'name'  => 'required',
            'image_path' => [$required, new Image],
            'downloadable_path' => [$required],
        ];
        return $rules;
    }

    public function messages() {
        return [
            'image_path.required' => 'Image is required',
            'downloadable_path.required' => 'Downloadable File is required',
        ];
        
    }
}
