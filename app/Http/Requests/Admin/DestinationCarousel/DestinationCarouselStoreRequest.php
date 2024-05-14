<?php

namespace App\Http\Requests\Admin\DestinationCarousel;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\DateTime;
use App\Rules\Image;

class DestinationCarouselStoreRequest extends FormRequest
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
        $image = ['required', new Image];
        if($id) {
            $image = ['nullable', new Image];
        }
        $rules = [
            'name' => 'required',
            'image_path' => $image,
        ];
        return $rules;

    }
}
