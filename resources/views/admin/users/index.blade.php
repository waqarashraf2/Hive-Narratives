@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">User Management Dashboard</h2>
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded-lg transition duration-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
            Add User
        </a>
    </div>

    <!-- Analytics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <div class="text-blue-800 font-medium">Total Users</div>
            <div class="text-2xl font-bold text-blue-900">{{ $totalUsers }}</div>
            <div class="text-sm text-blue-600 mt-1">All time</div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
            <div class="text-green-800 font-medium">New (24h)</div>
            <div class="text-2xl font-bold text-green-900">{{ $last24hUsers }}</div>
            <div class="text-sm text-green-600 mt-1">{{ number_format($growth24h, 2) }}% growth</div>
        </div>
        <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
            <div class="text-purple-800 font-medium">New (7d)</div>
            <div class="text-2xl font-bold text-purple-900">{{ $last7dUsers }}</div>
            <div class="text-sm text-purple-600 mt-1">{{ number_format($growth7d, 2) }}% growth</div>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
            <div class="text-yellow-800 font-medium">Admins</div>
            <div class="text-2xl font-bold text-yellow-900">{{ $adminCount }}</div>
            <div class="text-sm text-yellow-600 mt-1">{{ $adminPercentage }}% of total</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- User Growth Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">User Growth (Last 30 Days)</h3>
            <canvas id="userGrowthChart" height="250"></canvas>
            <div class="mt-2 text-sm text-gray-500">
                <span class="font-medium">Average:</span> {{ $dailyAverage }} users/day
            </div>
        </div>

        <!-- Registration Hours Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Registrations by Hour of Day</h3>
            <canvas id="registrationHoursChart" height="250"></canvas>
            <div class="mt-2 text-sm text-gray-500">
                <span class="font-medium">Peak Time:</span> {{ $peakHour }} ({{ $peakHourRegistrations }} registrations)
            </div>
        </div>
    </div>

    <!-- Additional Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Weekly Pattern Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Weekly Registration Pattern</h3>
            <canvas id="weeklyPatternChart" height="250"></canvas>
            <div class="mt-2 text-sm text-gray-500">
                <span class="font-medium">Busiest Day:</span> {{ $busiestDay }} ({{ $busiestDayRegistrations }} registrations)
            </div>
        </div>

        <!-- Monthly Growth Chart -->
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly User Growth</h3>
            <canvas id="monthlyGrowthChart" height="250"></canvas>
            <div class="mt-2 text-sm text-gray-500">
                <span class="font-medium">Growth Rate:</span> {{ $monthlyGrowthRate }}% MoM
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select name="role" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                <select name="date_filter" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">All Time</option>
                    <option value="24h" {{ request('date_filter') == '24h' ? 'selected' : '' }}>Last 24 Hours</option>
                    <option value="7d" {{ request('date_filter') == '7d' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="30d" {{ request('date_filter') == '30d' ? 'selected' : '' }}>Last 30 Days</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or email" class="w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-purple-700 text-white rounded-md hover:bg-purple-800 transition duration-200">Filter</button>
                <a href="{{ route('admin.users.index') }}" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-200">Reset</a>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">ID</th>
                    <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">User</th>
                    <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Role</th>
                    <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700">Joined</th>
                    <th class="px-4 py-3 border-b border-gray-200 font-semibold text-gray-700 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $user->id }}</td>
                        <td class="px-4 py-3 flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                <span class="text-purple-800 font-medium">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                @if($user->created_at->diffInHours() < 24)
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">New</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $user->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="p-2 text-blue-600 hover:text-blue-900 rounded hover:bg-blue-50 transition duration-200"
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 text-red-600 hover:text-red-900 rounded hover:bg-red-50 transition duration-200"
                                            title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="mt-6">
        {{ $users->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // User Growth Chart (Last 30 Days)
    const growthCtx = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($growthChartLabels) !!},
            datasets: [{
                label: 'New Users',
                data: {!! json_encode($growthChartData) !!},
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Registration Hours Chart
    const hoursCtx = document.getElementById('registrationHoursChart').getContext('2d');
    new Chart(hoursCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($hoursChartLabels) !!},
            datasets: [{
                label: 'Registrations',
                data: {!! json_encode($hoursChartData) !!},
                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                borderColor: 'rgba(16, 185, 129, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Weekly Pattern Chart
    const weeklyCtx = document.getElementById('weeklyPatternChart').getContext('2d');
    new Chart(weeklyCtx, {
        type: 'bar',
        data: {
            labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            datasets: [{
                label: 'Registrations',
                data: {!! json_encode($weeklyData) !!},
                backgroundColor: 'rgba(245, 158, 11, 0.7)',
                borderColor: 'rgba(245, 158, 11, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Monthly Growth Chart
    const monthlyCtx = document.getElementById('monthlyGrowthChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Total Users',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection