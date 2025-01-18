<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'product_image' => $this->product->image,
            'quantity' => $this->quantity,
            'unit_price' =>number_format($this->unit_price,2),
            'extra_charge' =>number_format($this->extra_charge,2),
            'extra_charge_reason' => $this->extra_charge_reason,
            'subtotal' =>number_format($this->subtotal,2),
            'discount' =>number_format($this->discount,2),
            'payable_subtotal' =>number_format($this->payable_subtotal,2),
        ];
    }
}
