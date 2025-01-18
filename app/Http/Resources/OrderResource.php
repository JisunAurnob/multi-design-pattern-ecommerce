<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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

            'id'=>$this->id,
            'order_number'=>$this->order_number,
            'date'=>Carbon::parse($this->created_at)->format("Y-m-d h:i:s A"),
            'total_amount'=>$this->total_amount,
            'payable_total'=>$this->payable_total,
            'status'=>$this->status,
            'progress'=>getProgressPercentage($this->status),
            'details'=>OrderDetailsResource::collection($this->details),
            'delivery_man'=>DeliveryManResource::make($this->deliveryMan),
            'pickup_man'=>DeliveryManResource::make($this->pickupMan),
            'review_rating'=>ReviewResource::make($this->review_rating),
            'has_review_rating'=>$this->review_rating()->exists(),
        ];
    }
}
