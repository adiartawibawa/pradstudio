<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;
use DateTimeInterface;

class Page extends Model
{
    use HasFactory, HasUuids, HasSlug;

    protected $fillable = [
        'title',
        'body',
        'meta',
        'featured_image',
        'is_published',
        'publish_date',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'is_published' => 'boolean',
            'publish_date' => 'datetime',
        ];
    }

    /**
     * Scope hanya untuk halaman yang dipublish.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('publish_date', '<=', now());
    }

    /**
     * Scope hanya untuk draft (belum publish).
     */
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Scope untuk pencarian berdasarkan judul/slug.
     */
    public function scopeSearch($query, ?string $term = null)
    {
        if (! $term) {
            return $query;
        }

        return $query->where(
            fn($q) =>
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('slug', 'like', "%{$term}%")
        );
    }

    /**
     * Accessor konten renderable.
     */
    public function getContentAttribute(): string
    {
        return $this->body;
    }

    /**
     * Accessor ringkasan konten (excerpt).
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->body), 200);
    }

    /**
     * Custom serialize date format.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
