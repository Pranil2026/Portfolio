<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'thumb',
        'badge',
        'title',
        'description',
        'tags',
        'live_url',
        'github_url',
        'position',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
