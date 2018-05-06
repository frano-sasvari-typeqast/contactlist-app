<?php

namespace App\Http\Requests;

class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'upload_avatar' => 'nullable|image',
            'is_favorite' => 'nullable',
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
            'firstname' => cleanup($this->input('firstname')),
            'lastname' => cleanup($this->input('lastname')),
            'email' => cleanup($this->input('email')),
            'upload_avatar' => $this->file('upload_avatar'),
            'is_favorite' => $this->input('is_favorite') ? 1 : null,
        ];
    }
}
