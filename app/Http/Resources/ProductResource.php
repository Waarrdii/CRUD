<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand?
            [
                'id' => $this->brand->id,
                'name' => $this->brand->name,
            ]:null,
            'created_at' => $this->created_at->format('d-m-y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-y H:i:s'),
        ];
    }
}
