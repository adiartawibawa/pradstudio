<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory, HasUuids, HasSlug;
    use HasTags;

    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'meta',
        'author_id',
        'category_id',
        'featured_image',
        'is_featured',
        'published',
        'publish_date',
    ];

    protected $casts = [
        'meta'          => 'array',
        'is_featured'   => 'boolean',
        'published'     => 'boolean',
        'publish_date'  => 'datetime',
    ];

    protected $appends = [
        'cover_url',
        'read_time',
    ];

    /**
     * Konfigurasi slug dari Spatie.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeDraft($query)
    {
        return $query->where('published', false);
    }

    public function scopeLive($query)
    {
        return $query->published()->where('publish_date', '<=', now());
    }

    public function scopeScheduled($query)
    {
        return $query->where('publish_date', '>', now());
    }

    public function scopeBeforePublishDate($query, $date)
    {
        return $query->where('publish_date', '<=', $date);
    }

    public function scopeAfterPublishDate($query, $date)
    {
        return $query->where('publish_date', '>', $date);
    }

    public function scopeCategory($query, $category = null)
    {
        if (!$category) {
            return $query;
        }

        return $query->whereHas('category', function ($q) use ($category) {
            if ($category instanceof Category) {
                $q->where('id', $category->id);
            } elseif (is_numeric($category)) {
                $q->where('id', $category);
            } else {
                $q->where('slug', $category);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->featured_image && Storage::exists($this->featured_image)
            ? Storage::url($this->featured_image)
            : 'https://picsum.photos/800/600?random=' . $this->id;
    }

    public function getReadTimeAttribute(): string
    {
        $words   = str_word_count(strip_tags($this->body ?? ''));
        $minutes = max(1, ceil($words / 250));

        return "{$minutes} " . Str::plural('menit', $minutes) . ' baca';
    }

    public function getMetaTitleAttribute(): string
    {
        return $this->meta['title'] ?? $this->title;
    }

    public function getMetaDescriptionAttribute(): string
    {
        return $this->meta['description'] ?? Str::limit(strip_tags($this->excerpt ?? $this->body), 160);
    }
}
