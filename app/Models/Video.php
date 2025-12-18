<?php

namespace App\Models;

use App\VideoSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'course_id',
        'source',
        'title',
        'slug',
        'youtube_url',
        'thumbnail_url',
        'body',
        'attachment_path',
    ];

    protected static function booted(): void
    {
        static::creating(function (Video $video): void {
            $video->slug = $video->slug ?: $video->generateUniqueSlug($video->title);
        });

        static::updating(function (Video $video): void {
            if ($video->isDirty('title')) {
                $video->slug = $video->generateUniqueSlug($video->title, $video->id);
            }
        });
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'source' => VideoSource::class,
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        if ($field !== null) {
            return $this->where($field, $value)->firstOrFail();
        }

        return $this->where('slug', $value)->first()
            ?? $this->whereKey($value)->firstOrFail();
    }

    protected function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = $this->makeSlug($title);
        $slug = $baseSlug;
        $counter = 1;

        while ($this->newQuery()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists()
        ) {
            $counter++;
            $slug = $baseSlug.'-'.$counter;
        }

        return $slug;
    }

    protected function makeSlug(string $title): string
    {
        $slug = Str::of($title)
            ->trim()
            ->lower();

        $slug = preg_replace('/\\s+/u', '-', $slug);
        $slug = preg_replace('/[^\\p{L}\\p{N}\\-]+/u', '', (string) $slug);
        $slug = trim((string) $slug, '-');

        return $slug !== '' ? $slug : Str::uuid()->toString();
    }
}
