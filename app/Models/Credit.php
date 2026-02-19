<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $table = 'credits';

    protected $fillable = [
        'user_id',
        'credits',
    ];

    /**
     * Relation: Each credit record belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation: A credit record can have multiple purchase entries
     */
    public function purchases()
    {
        return $this->hasMany(CreditPurchase::class, 'user_id', 'user_id');
    }
}
