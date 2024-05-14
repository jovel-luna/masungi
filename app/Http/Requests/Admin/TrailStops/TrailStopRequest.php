<?php

namespace App\Http\Requests\Admin\TrailStops;

use Illuminate\Foundation\Http\FormRequest;

class TrailStopRequest extends FormRequest
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
        $image = 'required|mimes:jpg,jpeg,png';
        if($id) {
            $image = 'mimes:jpg,jpeg,png';
        } 

        return [
            'trail_id' => 'required',
            'name' => 'required|unique:trail_stops,name,'. $id,
            'image_path' => $image
        ];
    }

    public function messages() {
        return [
            'trail_id.required' => 'Trail is required.',
        ];
    }
}
