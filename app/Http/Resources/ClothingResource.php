<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClothingResource extends JsonResource
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
            'wadrobe_id' => $this->wadrobe_id,
            'wadrobe_clothing_category_id' => $this->wadrobe_id,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
