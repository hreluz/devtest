<?php

namespace App\Http\Requests\Api\v1\Vehicle;

use App\Models\Vehicle;
use Illuminate\Foundation\Http\FormRequest;
use Gate;

class SelectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('select', [Vehicle::class, $this->route('vehicle')]);
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
