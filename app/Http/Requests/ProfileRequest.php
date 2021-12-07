<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'email'        => 'nullable|email',
            'name'         => 'nullable',
            'surname'      => 'nullable',
            'address'      => 'nullable',
            'avatar'       => 'nullable',
            'phone_number' => 'nullable',
            'city'         => 'nullable',
            'street'       => 'nullable',
            'house'        => 'nullable',
            'apartment'    => 'nullable',
            'porch'        => 'nullable',
            'floor'        => 'nullable'
        ];
    }
}
