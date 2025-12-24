<?php

namespace App\Http\Controllers\Api;

use App\Enums\CatRequestStatusEnum;
use App\Enums\CatRequestTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CatRequests\StoreCatRequest;
use App\Http\Resources\CatRequestResource;
use App\Models\Cat;
use App\Models\CatRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CatRequestController extends Controller
{
    public function show(Cat $cat, Request $request): JsonResponse
    {
        $catRequest = CatRequest::query()
            ->where('cat_id', $cat->id)
            ->where('user_id', $request->user()->id)
            ->latest()
            ->first();

        return response()->json([
            'request' => $catRequest ? CatRequestResource::make($catRequest) : null,
            'statuses' => CatRequestStatusEnum::values(),
            'types' => CatRequestTypeEnum::values(),
        ]);
    }

    public function cancel(Cat $cat, Request $request): JsonResponse
    {
        $catRequest = CatRequest::query()
            ->where('cat_id', $cat->id)
            ->where('user_id', $request->user()->id)
            ->latest()
            ->firstOrFail();

        $catRequest->update([
            'status' => CatRequestStatusEnum::CANCELED_BY_USER->value,
        ]);

        return response()->json([
            'message' => 'Заявка отменена.',
            'request' => CatRequestResource::make($catRequest),
        ]);
    }

    public function store(StoreCatRequest $request, Cat $cat): JsonResponse
    {
        $catRequest = CatRequest::create([
            'user_id' => $request->user()->id,
            'cat_id' => $cat->id,
            'type' => $request->input('type'),
            'status' => CatRequestStatusEnum::NEW->value,
            'purpose' => $request->input('purpose'),
            'manager_note' => null,
            'amount' => $cat->price,
            'is_paid' => false,
        ]);

        return response()->json([
            'message' => 'Заявка успешно отправлена.',
            'request' => CatRequestResource::make($catRequest),
        ], 201);
    }
}
