<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        return[

            'id'=>$this->id,
            'first_name' => $this->first_name, 
            'last_name' => $this->last_name, 
            'name' => $this->first_name . ' ' . $this->last_name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'image'=>$this->image,
            // 'date_of_birth'=>$this->date_of_birth,
            'address'=>$this->address,
            
        ];

    }
}


