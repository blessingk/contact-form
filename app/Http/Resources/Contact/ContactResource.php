<?php

namespace App\Http\Resources\Contact;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'   => $this->name,
            'email'  => $this->email,
            'gender' => $this->gender,
            'content' => $this->content,
        ];
    }
}
