<?php

namespace App\Http\Requests\Admin\Collaborators;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\DateTime;
use App\Rules\Image;

class CollaboratorStoreRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'image_path' => ['nullable', new Image],

        ];
                return $rules;

    }
}
