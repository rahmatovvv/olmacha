<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Course;
use App\Models\Payment;
use App\Models\StudyGroup;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $monthRevenue = Payment::where('status', 'paid')
            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');

        $stats = [
            'students' => User::students()->count(),
            'groups' => StudyGroup::where('is_active', true)->count(),
            'courses' => Course::active()->count(),
            'teachers' => Teacher::active()->count(),
            'newApplications' => Application::where('status', 'new')->count(),
            'monthRevenue' => $monthRevenue,
        ];

        $recentApplications = Application::with('course')->latest()->take(5)->get();
        $recentPayments = Payment::with(['user', 'studyGroup'])->latest('paid_at')->take(5)->get();

        $popularCourses = Course::withCount('groups')
            ->withCount(['applications' => fn ($q) => $q->where('status', '!=', 'rejected')])
            ->orderByDesc('applications_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications', 'recentPayments', 'popularCourses'));
    }
}
