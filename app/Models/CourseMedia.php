<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CourseMedia extends Model
{
    use HasFactory;

    public const KIND_VIDEO = 'video';
    public const KIND_AUDIO = 'audio';
    public const KIND_DOCUMENT = 'document';
    public const KIND_LINK = 'link';

    public const KINDS = [
        self::KIND_VIDEO,
        self::KIND_AUDIO,
        self::KIND_DOCUMENT,
        self::KIND_LINK,
    ];

    protected $fillable = [
        'course_id',
        'kind',
        'title',
        'external_url',
        'media_path',
        'mime_type',
        'is_primary',
        'sort_order',
        'captions_path',
        'captions_language',
        'transcript',
        'audio_description_path',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getMediaUrlAttribute(): ?string
    {
        if ($this->external_url) {
            return $this->external_url;
        }

        if (! $this->media_path) {
            return null;
        }

        return Storage::disk('public')->url($this->media_path);
    }

    public function getCaptionsUrlAttribute(): ?string
    {
        if (! $this->captions_path) {
            return null;
        }

        return Storage::disk('public')->url($this->captions_path);
    }

    public function getAudioDescriptionUrlAttribute(): ?string
    {
        if (! $this->audio_description_path) {
            return null;
        }

        return Storage::disk('public')->url($this->audio_description_path);
    }
}

