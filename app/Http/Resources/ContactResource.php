<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\PhoneNumberResource;

class ContactResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        $phoneNumberResource = new PhoneNumberResource($this->phoneNumbers);

        return [
            'id' => (int) $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'is_favorite' => $this->is_favorite,
            'created_at' => $this->created_at,
            'phones_numbers' => $phoneNumberResource->collection($this->whenLoaded('phoneNumbers')),
        ];
    }
}
