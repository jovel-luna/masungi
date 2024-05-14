<?php

namespace App\Http\Requests\Admin\EventTypes;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Varchar;
use App\Rules\HTMLText;
use App\Rules\DateTime;
use App\Rules\Image;
use App\Rules\File;

class EventTypeStoreRequest extends FormRequest
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
         'event_id' => ['required', new Varchar],
         'name' => ['required', new Varchar],
         'activity' => ['required', new Varchar],
         'duration' => ['required', new Varchar],
         'age_group' => ['required', new Varchar],
         'participants' => ['required', 'max:1000'],
         'conservation_fees' => ['required', 'max:1000'],
         'conservation_info' => ['required', 'max:1000'],
         'features' => ['required', 'max:1000'],
         'description' => ['required', 'max:1000'],
        ];

            return $rules;

    }

    public function messages() {
        return [

        ];
    }
}
