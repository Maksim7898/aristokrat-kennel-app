<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements Viewable
{
    use HasSlug, InteractsWithViews;

    protected bool $removeViewsOnDelete = true;

    protected $fillable = [
        'slug',
        'title',
        'short_title',
        'image_path',
        'is_published',
        'excerpt',
        'content',
        'post_category_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean'
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('short_title')
            ->saveSlugsTo('slug');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('public')->url($this->image_path),
        );
    }
}
