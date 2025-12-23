<?php

namespace App\Models;

use App\Enums\CatGenderEnum;
use App\Enums\CatStatusEnum;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Cat extends Model implements Viewable
{
    use HasSlug, InteractsWithViews;

    protected bool $removeViewsOnDelete = true;

    protected $fillable = [
        'slug',
        'name',
        'gender',
        'status',
        'character',
        'vaccination_info',
        'date_of_birth',
        'cat_breed_id',
        'cat_class_id',
        'mother_id',
        'father_id',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'gender' => CatGenderEnum::class,
            'status' => CatStatusEnum::class,
            'date_of_birth' => 'date',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(CatBreed::class, 'cat_breed_id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(CatClass::class, 'cat_class_id');
    }

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Cat::class, 'mother_id');
    }

    public function father(): BelongsTo
    {
        return $this->belongsTo(Cat::class, 'father_id');
    }
}
