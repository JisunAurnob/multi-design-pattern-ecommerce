<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderHistoryResource extends JsonResource
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
        ];
    }
}
