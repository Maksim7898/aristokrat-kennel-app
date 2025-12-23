<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'city' => $this->city,
            'role' => $this->role->getLabel(),
            'pet_experience' => $this->pet_experience,
            'living_conditions' => $this->living_conditions,
            'created_at' => $this->created_at->format('d.m.Y в H:i'),
            'posts' => $this->whenLoaded('posts', fn () => PostResource::collection($this->posts)),
        ];
    }
}
