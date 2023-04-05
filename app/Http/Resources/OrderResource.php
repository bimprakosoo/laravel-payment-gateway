<?php

namespace App\Http\Resources;

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
        'id' => $this->id,
        'id_user' => $this->id_user,
        'id_product' => $this->id_product,
        'total' => $this->total,
        'status' => $this->status,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at
      ];
    }
}
