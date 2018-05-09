<?php

namespace App\Http\Requests;

class PhoneNumberRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
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
    public function validationData() : array
    {
        return [
            'contact_id' => cleanup($this->input('contact_id')),
            'label' => cleanup($this->input('label')),
            'number' => cleanup($this->input('number')),
        ];
    }
}
