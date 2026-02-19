<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
public function dashboard()
{
    $today = Carbon::today();
    $monthly = Carbon::now()->startOfMonth();
    $fiveMinutesAgo = Carbon::now()->subMinutes(5);
    $lastWeek = Carbon::now()->subWeek();

    // Visitor metrics
    $dailyVisitors = Visitor::whereDate('created_at', $today)->count();
    $monthlyVisitors = Visitor::whereDate('created_at', '>=', $monthly)->count();
    $uniqueVisitors = Visitor::distinct('ip_address')->count();
    
    // User metrics
    $joinedUsers = User::count();
    $activeUsers = User::whereNotNull('last_activity_at')
                    ->where('last_activity_at', '>=', $lastWeek)
                    ->count();
    
    // Live metrics
    $liveUsers = User::where('last_activity_at', '>=', $fiveMinutesAgo)->count();
    $liveGuests = Visitor::where('created_at', '>=', $fiveMinutesAgo)->count();

    return view('admin.dashboard', compact(
        'dailyVisitors',
        'monthlyVisitors',
        'uniqueVisitors',
        'joinedUsers',
        'activeUsers',
        'liveUsers',
        'liveGuests'
    ));
}
}
