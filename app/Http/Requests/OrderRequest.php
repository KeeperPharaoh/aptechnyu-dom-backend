<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $data;
    /**
     * @var mixed
     */
    private $user;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $delivery = (bool)$this->input('delivery');

        return [
            'delivery'          => ['required', 'boolean'],
            'user'              => ['required'],
            'user.name'         => ['required', 'string'],
            'user.phone_number' => ['required'],
            'user.email'        => ['nullable', 'string', 'email'],
            'user.office'       => ['nullable', Rule::requiredIf(!$delivery)],
            'user.city'         => ['string', Rule::requiredIf($delivery)],
            'user.street'       => ['string', Rule::requiredIf($delivery)],
            'user.house'        => ['string', Rule::requiredIf($delivery)],
            'user.apartment'    => ['string', Rule::requiredIf($delivery)],
            'user.comment'      => ['nullable', 'string'],
            'user.order_type'   => ['integer', Rule::requiredIf($delivery)],
            'user.payment_type' => ['integer', Rule::requiredIf($delivery)],
            'user.bonus'        => ['integer', Rule::requiredIf($delivery)],
            'user.total_sum'    => ['integer', Rule::requiredIf($delivery)],
            'user.porch'        => ['string', Rule::requiredIf($delivery)],
            'user.floor'        => ['string', Rule::requiredIf($delivery)],
            'data'              => ['required'],
            'data.*.id'         => ['required', 'integer', 'exists:products'],
            'data.*.quantity'   => ['required', 'integer'],
        ];
    }
}
