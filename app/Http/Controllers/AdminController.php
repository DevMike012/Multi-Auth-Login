<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;

class AdminController extends Controller
{
    public function overview()
    {
        $activeUsers = User::whereNull('deleted_at')->count();
        $adminCount = User::where('is_admin', true)->count();
        $regularUsers = User::where('is_admin', false)->whereNull('deleted_at')->count();
        $deletedUsers = User::onlyTrashed()->count();
        
        // Get recent activity (last 5 changes)
        $recentActivity = Activity::with(['user', 'target'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.overview', compact(
            'activeUsers',
            'adminCount',
            'regularUsers',
            'deletedUsers',
            'recentActivity'
        ));
    }

    public function dashboard()
    {
        $users = User::withTrashed()->get(); // Show all users, including soft deleted
        return view('admin.dashboard', compact('users'));
    }
}