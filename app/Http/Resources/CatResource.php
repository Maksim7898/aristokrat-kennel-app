<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'gender' => $this->gender->getLabel(),
            'status' => $this->status->getLabel(),
            'character' => $this->character,
            'vaccination_info' => $this->vaccination_info,
            'date_of_birth' => $this->date_of_birth->format('d.m.Y'),
            'price' => $this->price,
            'views' => $this->views_count ?? 0,
            'image_url' => 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131?auto=png&fit=crop&w=900&q=80',
            'breed' => $this->whenLoaded('breed', fn () => CatBreedResource::make($this->breed)),
            'class' => $this->whenLoaded('class', fn () => CatClassResource::make($this->class)),
            'mother' => $this->whenLoaded('mother', fn () => CatResource::make($this->mother)),
            'father' => $this->whenLoaded('father', fn () => CatResource::make($this->father)),
        ];
    }
}
