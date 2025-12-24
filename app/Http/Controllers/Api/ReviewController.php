<?php

namespace App\Http\Controllers\Api;

use App\Enums\CatRequestStatusEnum;
use App\Enums\ReviewStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Reviews\StoreReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Cat;
use App\Models\CatRequest;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewController extends Controller
{
    public function index(Cat $cat): AnonymousResourceCollection
    {
        $reviews = Review::query()
            ->where('cat_id', $cat->id)
            ->where('status', ReviewStatusEnum::APPROVED->value)
            ->with('user')
            ->latest()
            ->get();

        return ReviewResource::collection($reviews);
    }

    public function store(StoreReviewRequest $request, Cat $cat): JsonResponse
    {
        $user = $request->user();
        $catRequest = CatRequest::query()
            ->where('cat_id', $cat->id)
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$catRequest || $catRequest->status !== CatRequestStatusEnum::READY) {
            return response()->json([
                'message' => 'Оставить отзыв можно только после готовой заявки.',
            ], 403);
        }

        $review = Review::create([
            'user_id' => $user->id,
            'cat_id' => $cat->id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
            'status' => ReviewStatusEnum::PENDING->value,
        ]);

        return response()->json([
            'message' => 'Отзыв отправлен на модерацию.',
            'review' => ReviewResource::make($review->load('user')),
        ], 201);
    }
}
