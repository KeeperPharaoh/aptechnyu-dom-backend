<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $data;

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
            'user'                => 'required',
            'user.*name'          => 'required|string',
            'user.*phone_number'  => 'required',
            'user.*email'         => 'nullable|string|email',
            'user.*city'          => 'required|string',
            'user.*street'        => 'required|string',
            'user.*house'         => 'required|string',
            'user.*apartment'     => 'required|string',
            'user.*comment'       => 'nullable|string',
            'user.*order_type'    => 'required|integer',
            'user.*payment_type'  => 'required|integer',
            'user.*bonus'         => 'required|integer',
            'user.*total_sum'     => 'required|integer',
            'user.*porch'         => 'nullable|string',
            'user.*floor'         => 'nullable|string',
            'data'                => 'required',
            'data.*.id'           => 'required|integer|exists:products',
            'data.*.quantity'     => 'required|integer'
        ];
    }
}
