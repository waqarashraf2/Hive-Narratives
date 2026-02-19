<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    public function comments()
{
    return $this->hasMany(Comment::class);
}


public function hasBookmarked($blogId)
{
    return $this->bookmarks()->where('blog_id', $blogId)->exists();
}

public function bookmarks()
{
    return $this->hasMany(Bookmark::class);
}

public function creditPurchases()
{
    return $this->hasMany(CreditPurchase::class);
}

// Fowlwing 

// public function following()
// {
//     return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
// }

// public function followers()
// {
//     return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')->withTimestamps();
// }





// use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Users that this user follows
use Notifiable; 
public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
    }

    // Users that follow this user
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')->withTimestamps();
    }






public function isFollowing($userId)
{
    return $this->following()->where('following_id', $userId)->exists();
}


public function blogs()
{
    return $this->hasMany(Blog::class);
}






    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    protected $fillable = [
        'name', 'username', 'email', 'password','profile_photo', 'last_activity_at'
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // Add this to your User model
protected static function boot()
{
    parent::boot();

    static::saving(function ($user) {
        if ($user->isDirty('last_activity_at')) {
            $user->last_activity_at = now();
        }
    });
}

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
