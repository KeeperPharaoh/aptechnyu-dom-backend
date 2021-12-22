<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'total_sum'      => 'required',
            'data'           => 'required',
            'data.*.id'       => 'required|integer|exists:products',
            'data.*.quantity' => 'required|integer'
        ];
        //
    }
}
