<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\PhoneResource;

class ContactResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $phoneResource = new PhoneResource($this->phones);

        return [
            'id' => (int) $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'is_favorite' => $this->is_favorite,
            'created_at' => $this->created_at,
            'phones' => $phoneResource->collection($this->whenLoaded('phones')),
        ];
    }
}
