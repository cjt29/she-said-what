<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function scopeByUuid($query, $uuid)
    {
        return $query->where('uuid', '=', $uuid);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
