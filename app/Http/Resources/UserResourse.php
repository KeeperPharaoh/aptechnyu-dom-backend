<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'         => $this->name,
            'surname'      => $this->surname,
            'phone_number' => $this->phone_number,
            'address'      => $this->address,
            'avatar'       => $this->avatar,
            'email'        => $this->email,
            'city'         => $this->city,
            'street'       => $this->street,
            'house'        => $this->house,
            'apartment'    => $this->apartment,
            'porch'        => $this->porch,
            'floor'        => $this->floor,
            'bonus'        => $this->bonus
        ];
    }
}
