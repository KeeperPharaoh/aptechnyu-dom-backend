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
            'name'         => ['string'],
            'surname'      => ['string'],
            'address'      => ['string'],
            'avatar'       => ['string'],
            'phone_number' => ['string'],
            'email'        => ['email'],
            'street'       => ['string'],
            'house'        => ['string'],
            'apartment'    => ['integer'],
            'porch'        => ['integer'],
            'floor'        => ['integer']
        ];
    }
}
