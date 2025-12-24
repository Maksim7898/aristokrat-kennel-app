<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type->getLabel(),
            'status' => [
                'label' => $this->status->getLabel(),
                'value' => $this->status->value,
            ],
            'purpose' => $this->purpose,
            'amount' => $this->amount,
            'created_at' => $this->created_at->format('d.m.Y в H:i'),
            'cat' => $this->whenLoaded('cat', fn () => CatResource::make($this->cat)),
            'user' => $this->whenLoaded('user', fn () => UserShortResource::make($this->user)),
        ];
    }
}
