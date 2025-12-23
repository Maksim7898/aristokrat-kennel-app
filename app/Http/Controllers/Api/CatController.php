<?php

namespace App\Http\Controllers\Api;

use App\Enums\CatGenderEnum;
use App\Enums\CatStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cats\CatIndexRequest;
use App\Http\Resources\CatBreedResource;
use App\Http\Resources\CatClassResource;
use App\Http\Resources\CatResource;
use App\Models\Cat;
use App\Models\CatBreed;
use App\Models\CatClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CatController extends Controller
{
    public function index(CatIndexRequest $request): AnonymousResourceCollection
    {
        $cats = Cat::with(['breed', 'class'])
            ->withViewsCount()
            ->when($request->filled('class'), fn ($query) => $query->where('cat_class_id', $request->input('class')))
            ->when($request->filled('breed'), fn ($query) => $query->where('cat_breed_id', $request->input('breed')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->when($request->filled('gender'), fn ($query) => $query->where('gender', $request->input('gender')))
            ->when($request->filled('priceFrom'), fn ($query) => $query->where('price', '>=', $request->input('priceFrom')))
            ->when($request->filled('priceTo'), fn ($query) => $query->where('price', '<=', $request->input('priceTo')))
            ->get();

        return CatResource::collection($cats);
    }

    public function show(Cat $cat): CatResource
    {
        $cat->loadMissing(['breed', 'class', 'mother', 'father'])
            ->loadCount('views');
        views($cat)->cooldown(5)->record();

        return CatResource::make($cat);
    }

    public function getFilters(): JsonResponse
    {
        $breeds = CatBreed::all();
        $classes = CatClass::all();
        $statuses = CatStatusEnum::values();
        $genders = CatGenderEnum::values();
        $priceRange = Cat::selectRaw('MIN(price) as min_price, MAX(price) as max_price')->first();

        return response()->json([
            'breeds' => CatBreedResource::collection($breeds),
            'classes' => CatClassResource::collection($classes),
            'statuses' => $statuses,
            'genders' => $genders,
            'priceRange' => $priceRange,
        ]);
    }

    public function getBreeds(): AnonymousResourceCollection
    {
        $breeds = CatBreed::all();

        return CatBreedResource::collection($breeds);
    }
}
