<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'features',
        'faqs',
        'price',
        'delivery_time',
        'revisions',
        'image',
        'gallery',
        'is_active',
        'order',
        'category',
        'tags'
    ];

    protected $casts = [
        'features' => 'array',
        'faqs' => 'array',
        'gallery' => 'array',
        'is_active' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}