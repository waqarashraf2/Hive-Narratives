<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    
    
    public function index()
    {
        // Basic analytics data
        $totalUsers = User::count();
        $last24hUsers = User::where('created_at', '>=', now()->subDay())->count();
        $last7dUsers = User::where('created_at', '>=', now()->subDays(7))->count();
        $adminCount = User::where('role', 'admin')->count();
        
        // Growth calculations
        $previous24hUsers = User::whereBetween('created_at', [now()->subDays(2), now()->subDay()])->count();
        $previous7dUsers = User::whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();
        
        $growth24h = $previous24hUsers > 0 ? (($last24hUsers - $previous24hUsers) / $previous24hUsers) * 100 : 100;
        $growth7d = $previous7dUsers > 0 ? (($last7dUsers - $previous7dUsers) / $previous7dUsers) * 100 : 100;
        
        $adminPercentage = $totalUsers > 0 ? round(($adminCount / $totalUsers) * 100, 2) : 0;

        // 30-day growth chart data
        $growthChartData = [];
        $growthChartLabels = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('M j');
            $count = User::whereDate('created_at', now()->subDays($i))->count();
            
            $growthChartLabels[] = $date;
            $growthChartData[] = $count;
        }
        
        $dailyAverage = round(array_sum($growthChartData) / 30, 2);

        // Registration by hour data
        $hoursChartData = array_fill(0, 24, 0);
        $hourlyRegistrations = User::select(
            DB::raw('HOUR(created_at) as hour'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('hour')
        ->get();
        
        foreach ($hourlyRegistrations as $hr) {
            $hoursChartData[$hr->hour] = $hr->count;
        }
        
        $hoursChartLabels = array_map(function($h) {
            return $h . ':00';
        }, range(0, 23));
        
        $peakHour = array_search(max($hoursChartData), $hoursChartData) . ':00';
        $peakHourRegistrations = max($hoursChartData);

        // Weekly pattern data
        $weeklyData = array_fill(0, 7, 0);
        $weeklyRegistrations = User::select(
            DB::raw('DAYOFWEEK(created_at) as day'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('day')
        ->get();
        
        foreach ($weeklyRegistrations as $wr) {
            // DAYOFWEEK returns 1=Sunday to 7=Saturday
            $weeklyData[$wr->day - 1] = $wr->count;
        }
        
        $busiestDayIndex = array_search(max($weeklyData), $weeklyData);
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $busiestDay = $days[$busiestDayIndex];
        $busiestDayRegistrations = max($weeklyData);

        // Monthly growth data
        $monthlyData = [];
        $monthlyLabels = [];
        
        $monthlyRegistrations = User::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();
        
        $cumulative = 0;
        foreach ($monthlyRegistrations as $mr) {
            $cumulative += $mr->count;
            $monthlyData[] = $cumulative;
            $monthlyLabels[] = Carbon::create($mr->year, $mr->month)->format('M Y');
        }
        
        // Calculate monthly growth rate
        $monthlyGrowthRate = 0;
        if (count($monthlyData) > 1) {
            $lastMonth = $monthlyData[count($monthlyData)-1];
            $prevMonth = $monthlyData[count($monthlyData)-2];
            $monthlyGrowthRate = round((($lastMonth - $prevMonth) / $prevMonth) * 100, 2);
        }

        // Filtered query for the table
        $query = User::query();

        // Role filter
        if (request()->has('role') && request('role') != '') {
            $query->where('role', request('role'));
        }

        // Date filter
        if (request()->has('date_filter')) {
            switch (request('date_filter')) {
                case '24h':
                    $query->where('created_at', '>=', now()->subDay());
                    break;
                case '7d':
                    $query->where('created_at', '>=', now()->subDays(7));
                    break;
                case '30d':
                    $query->where('created_at', '>=', now()->subDays(30));
                    break;
            }
        }

        // Search filter
        if (request()->has('search') && request('search') != '') {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Order and paginate
        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'last24hUsers',
            'last7dUsers',
            'adminCount',
            'growth24h',
            'growth7d',
            'adminPercentage',
            'growthChartLabels',
            'growthChartData',
            'dailyAverage',
            'hoursChartLabels',
            'hoursChartData',
            'peakHour',
            'peakHourRegistrations',
            'weeklyData',
            'busiestDay',
            'busiestDayRegistrations',
            'monthlyLabels',
            'monthlyData',
            'monthlyGrowthRate'
        ));
    }

        // Search filter

    
    
    
    
    
    

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}