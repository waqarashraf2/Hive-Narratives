<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminContactController extends Controller
{
    /**
     * Display a listing of the contact messages with analytics.
     */
    public function index()
    {
        // Basic analytics data
        $totalMessages = ContactMessage::count();
        $last24hMessages = ContactMessage::where('created_at', '>=', now()->subDay())->count();
        $last7dMessages = ContactMessage::where('created_at', '>=', now()->subDays(7))->count();
        $unreadCount = ContactMessage::where('is_read', false)->count();
        $repliedCount = ContactMessage::where('is_replied', true)->count();
        
        // Growth calculations
        $previous24hMessages = ContactMessage::whereBetween('created_at', [now()->subDays(2), now()->subDay()])->count();
        $previous7dMessages = ContactMessage::whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();
        
        $growth24h = $previous24hMessages > 0 ? (($last24hMessages - $previous24hMessages) / $previous24hMessages) * 100 : 100;
        $growth7d = $previous7dMessages > 0 ? (($last7dMessages - $previous7dMessages) / $previous7dMessages) * 100 : 100;
        
        $repliedPercentage = $totalMessages > 0 ? round(($repliedCount / $totalMessages) * 100, 2) : 0;

        // 30-day growth chart data
        $growthChartData = [];
        $growthChartLabels = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('M j');
            $count = ContactMessage::whereDate('created_at', now()->subDays($i))->count();
            
            $growthChartLabels[] = $date;
            $growthChartData[] = $count;
        }
        
        $dailyAverage = round(array_sum($growthChartData) / 30, 2);

        // Messages by hour data
        $hoursChartData = array_fill(0, 24, 0);
        $hourlyMessages = ContactMessage::select(
            DB::raw('HOUR(created_at) as hour'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('hour')
        ->get();
        
        foreach ($hourlyMessages as $hm) {
            $hoursChartData[$hm->hour] = $hm->count;
        }
        
        $hoursChartLabels = array_map(function($h) {
            return $h . ':00';
        }, range(0, 23));
        
        $peakHour = array_search(max($hoursChartData), $hoursChartData) . ':00';
        $peakHourMessages = max($hoursChartData);

        // Weekly pattern data
        $weeklyData = array_fill(0, 7, 0);
        $weeklyMessages = ContactMessage::select(
            DB::raw('DAYOFWEEK(created_at) as day'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('day')
        ->get();
        
        foreach ($weeklyMessages as $wm) {
            // DAYOFWEEK returns 1=Sunday to 7=Saturday
            $weeklyData[$wm->day - 1] = $wm->count;
        }
        
        $busiestDayIndex = array_search(max($weeklyData), $weeklyData);
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $busiestDay = $days[$busiestDayIndex];
        $busiestDayMessages = max($weeklyData);

        // Monthly growth data
        $monthlyData = [];
        $monthlyLabels = [];
        
        $monthlyMessages = ContactMessage::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();
        
        $cumulative = 0;
        foreach ($monthlyMessages as $mm) {
            $cumulative += $mm->count;
            $monthlyData[] = $cumulative;
            $monthlyLabels[] = Carbon::create($mm->year, $mm->month)->format('M Y');
        }
        
        // Calculate monthly growth rate
        $monthlyGrowthRate = 0;
        if (count($monthlyData) > 1) {
            $lastMonth = $monthlyData[count($monthlyData)-1];
            $prevMonth = $monthlyData[count($monthlyData)-2];
            $monthlyGrowthRate = round((($lastMonth - $prevMonth) / $prevMonth) * 100, 2);
        }

        // Filtered query for the table
        $query = ContactMessage::query();

        // Status filter
        if (request()->has('status') && request('status') != '') {
            switch (request('status')) {
                case 'unread':
                    $query->where('is_read', false);
                    break;
                case 'read':
                    $query->where('is_read', true)->where('is_replied', false);
                    break;
                case 'replied':
                    $query->where('is_replied', true);
                    break;
            }
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
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Order and paginate
        $messages = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contacts.index', compact(
            'messages',
            'totalMessages',
            'last24hMessages',
            'last7dMessages',
            'unreadCount',
            'repliedCount',
            'growth24h',
            'growth7d',
            'repliedPercentage',
            'growthChartLabels',
            'growthChartData',
            'dailyAverage',
            'hoursChartLabels',
            'hoursChartData',
            'peakHour',
            'peakHourMessages',
            'weeklyData',
            'busiestDay',
            'busiestDayMessages',
            'monthlyLabels',
            'monthlyData',
            'monthlyGrowthRate'
        ));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $contact)
    {
        // Mark as read if not already
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified contact message.
     */
    public function destroy(ContactMessage $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
                         ->with('success', 'Message deleted successfully');
    }

    /**
     * Send reply to contact message.
     */
    public function sendReply(Request $request, ContactMessage $contact)
    {
        $request->validate([
            'reply_message' => 'required|string|min:10'
        ]);


// In your sendReply method:
Mail::to($contact->email)->send(new \App\Mail\ContactReplyMail(
    $contact->name,
    $contact->subject,
    $request->reply_message
));

        // Mark as replied
        $contact->update(['is_replied' => true]);

        return back()->with('success', 'Reply sent successfully');
    }
}