<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public static function valueFor(string $key, array $default = []): array
    {
        return static::firstOrCreate(
            ['key' => $key],
            ['value' => $default]
        )->value ?? $default;
    }

    public static function setValue(string $key, array $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
