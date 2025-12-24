<?php

namespace App\Http\Requests\Api\CatRequests;

use App\Enums\CatRequestTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', Rule::in(CatRequestTypeEnum::values()->pluck('value'))],
            'purpose' => ['required', 'string'],
        ];
    }
}
