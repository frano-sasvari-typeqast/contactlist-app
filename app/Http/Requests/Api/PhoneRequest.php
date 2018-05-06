<?php

namespace App\Http\Requests\Api;

class PhoneRequest extends FormRequest
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
            'contact_id' => 'required|exists:contact,id',
            'label' => 'required',
            'number' => 'required',
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return [
            'contact_id' => cleanup($this->input('contact_id')),
            'label' => cleanup($this->input('label')),
            'number' => cleanup($this->input('number')),
        ];
    }
}
