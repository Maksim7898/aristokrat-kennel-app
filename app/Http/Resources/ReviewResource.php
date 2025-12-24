<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author' => $this->user?->full_name,
            'rating' => $this->rating,
            'text' => $this->comment,
            'date' => $this->created_at?->format('d.m.Y'),
        ];
    }
}
