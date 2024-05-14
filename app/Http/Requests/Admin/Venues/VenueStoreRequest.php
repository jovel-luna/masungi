<?php

namespace App\Http\Requests\Admin\Venues;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Varchar;

class VenueStoreRequest extends FormRequest
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
            'name' => ['required', new Varchar],
        ];
    }
}
