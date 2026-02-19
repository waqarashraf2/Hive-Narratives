<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'content', 'featured_image', 'categories', 'status'];

    protected $casts = [
        'categories' => 'array',
    ];


    public function views()
    {
        return $this->hasMany(BlogView::class);
    }
    
    public function uniqueViewsCount()
    {
        return $this->views()->distinct('ip_address')->count();
    }


public function bookmarks(): HasMany
{
    return $this->hasMany(Bookmark::class);
}

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByUser()
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
