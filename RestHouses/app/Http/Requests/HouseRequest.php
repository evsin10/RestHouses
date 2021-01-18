<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class HouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:200',
            'description' => 'required|min:4|max:500',
            'roomcount' => 'integer|required|min:1|max:30',
            'bedcount' => 'integer|required|min:1|max:30',
            'location_id' => 'required',
            'type_id' => 'required',

        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please provide valid name which is between 5 and 200 characters.',
            'description.required' => 'Please provide valid description which is between 4 and 500 characters.',
            'roomcount.max' => 'Please provide valid rooms which is between 1 and 30 .',
            'roomcount.required' => 'Rooms required',
            'bedcount.max' => 'Please provide valid bad numbers which is between 1 and 30 .',
            'bedcount.required' => 'Beds required',
            'location_id.required' => 'Please insert location',
            'type_id.required' => 'Please insert type'
        ];
    }
}
