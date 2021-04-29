<?php

namespace App\Http\Requests\Api\v1;

use App\Models\Checkout;
use Illuminate\Foundation\Http\FormRequest;
use Gate;

class StoreCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', [Checkout::class,$this->route('vehicle')]);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_name'         => 'required',
            'datetime'              => 'required|date_format:Y-m-d H:i:s',
            'price'                 => 'required|numeric',
            'seller'                => 'required',
            'payment_method'        =>  'required|in:'.join(',', [Checkout::PAYMENT_CASH, Checkout::PAYMENT_CARD])
        ];
    }
}
