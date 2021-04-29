<?php

namespace App\Http\Requests\Api\v1;

use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->vehicle->status === Vehicle::STATUS_CHECKED_OUT &&  $this->vehicle->current_checkout;
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
