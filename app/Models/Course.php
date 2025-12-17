<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
    ];

    protected static function booted(): void
    {
        static::creating(function (Course $course): void {
            $course->slug = $course->slug ?: $course->generateUniqueSlug($course->title);
        });

        static::updating(function (Course $course): void {
            if ($course->isDirty('title')) {
                $course->slug = $course->generateUniqueSlug($course->title, $course->id);
            }
        });
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
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
