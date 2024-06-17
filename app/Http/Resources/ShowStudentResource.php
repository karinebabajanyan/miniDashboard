<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowStudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'first_name'=> $this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'country'=>$this->profile->country->id,
            'city'=>$this->profile->city,
            'birthday'=>$this->profile->birthday
        ];
    }
}
