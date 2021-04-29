<?php

namespace App\Http\Requests\Api\v1\Checkout;

use App\Models\Checkout;
use Illuminate\Foundation\Http\FormRequest;
use Gate;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update', [Checkout::class,$this->route('vehicle')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
