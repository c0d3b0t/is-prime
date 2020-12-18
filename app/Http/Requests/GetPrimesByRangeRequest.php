<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetPrimesByRangeRequest extends FormRequest
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
            'from' => 'required|int|min:1',
            'to'   => 'required|int|min:1'
        ];
    }
}
