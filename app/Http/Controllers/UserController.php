<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function publicProfile($username)
    {
        $user = User::where('username', $username)
            ->with('blogs', 'followers', 'following')
            ->firstOrFail();

        return view('user.public-profile', compact('user'));
    }
}
