<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'desc' => $this->desc,
            'image' => $this->image,
            'price' => $this->price,
            'vote' => $this->vote,
            'brand' => [
                'id' => $this->productBrands->id,
                'name' => $this->productBrands->name,
                'created_at' => $this->productBrands->created_at,
                'update_at' => $this->productBrands->updated_at,
            ],
            'category' => [
                'id' => $this->categories->id,
                'name' => $this->categories->name,
                'created_at' => $this->categories->created_at,
                'update_at' => $this->categories->updated_at,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
