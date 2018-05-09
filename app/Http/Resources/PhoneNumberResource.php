<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PhoneNumberResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => (int) $this->id,
            'contact_id' => (int) $this->contact_id,
            'label' => $this->label,
            'number' => $this->number,
        ];
    }
}
