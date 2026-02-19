<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address', // Add this line
        'user_id',  // If tracking logged-in users
        'visited_at',  // If tracking timestamps
    ];
}
