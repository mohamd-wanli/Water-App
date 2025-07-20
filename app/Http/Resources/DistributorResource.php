<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [


            'name'=>$this->name,
            'email'=>$this->email,
//            'password'=>$this->password,
            'phone'=>$this->phone,
            'commercial_license'=>$this->commercial_license,
        ];
    }
}
