<?php

namespace App\Http\Requests\Api\Cats;

use App\Enums\CatGenderEnum;
use App\Enums\CatStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CatIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'class' => ['nullable', 'integer', 'exists:cat_classes,id'],
            'breed' => ['nullable', 'integer', 'exists:cat_breeds,id'],
            'status' => ['nullable', 'string', Rule::enum(CatStatusEnum::class)],
            'gender' => ['nullable', 'string', Rule::enum(CatGenderEnum::class)],
            'priceFrom' => ['nullable', 'numeric', 'min:0'],
            'priceTo' => ['nullable', 'numeric', 'min:0', 'gte:priceFrom'],
        ];
    }
}
