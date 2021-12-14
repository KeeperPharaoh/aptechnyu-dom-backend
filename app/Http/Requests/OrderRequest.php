<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user'                 => 'required',
            'user.*name'          => 'required|string',
            'user.*phone_number'  => 'required',
            'user.*email'         => 'string|email',
            'user.*city'          => 'required|string',
            'user.*street'        => 'required|string',
            'user.*house'         => 'required',
            'user.*apartment'     => 'required',
            'user.*comment'       => 'string|nullable',
            'user.*order_type'    => 'required|integer',
            'user.*payment_type'  => 'required|integer',
            'user.*bonus'         => 'required|boolean'
        ];
    }
}
