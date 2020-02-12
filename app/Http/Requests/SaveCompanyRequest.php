<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveCompanyRequest extends FormRequest
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
        // dd($this->company);
        return [
            'name' => 'required',
            'address' => 'present',
            'phone' => 'present',
            'ruc' => [
                'required',
                'min:11','max:11',
                Rule::unique('companies', 'ruc')->ignore($this->company),
                ],
        ];
    }
}
