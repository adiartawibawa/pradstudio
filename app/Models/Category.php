<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, HasUuids, HasSlug;

    protected $fillable = [
        'name',
        'description',
        'meta',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected function casts(): array
    {
        return [
            'meta' => 'array',
        ];
    }

    /**
     * Relasi ke post (many-to-many).
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

    /**
     * Scope pencarian berdasarkan nama atau slug.
     */
    public function scopeSearch($query, ?string $term = null)
    {
        if (! $term) {
            return $query;
        }

        return $query->where(
            fn($q) =>
            $q->where('name', 'like', "%{$term}%")
                ->orWhere('slug', 'like', "%{$term}%")
        );
    }

    /**
     * Getter untuk nama singkat (max 30 char).
     */
    public function getShortNameAttribute(): string
    {
        return Str::limit($this->name, 30);
    }

    /**
     * Pastikan detach relasi saat category dihapus.
     */
    protected static function booted()
    {
        static::deleting(function ($item) {
            $item->posts()->detach();
        });
    }
}
