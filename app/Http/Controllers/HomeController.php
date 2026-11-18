<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudyGroup;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::active()->featured()->orderBy('id')->take(6)->get();
        $teachers = Teacher::active()->take(4)->get();
        $upcomingGroups = StudyGroup::active()
            ->with(['course', 'teacher'])
            ->withCount('enrollments')
            ->orderBy('starts_at')
            ->take(4)
            ->get();

        $stats = [
            'students' => User::students()->count(),
            'teachers' => Teacher::active()->count(),
            'courses' => Course::active()->count(),
            'years' => 12,
        ];

        return view('site.home', compact('featuredCourses', 'teachers', 'upcomingGroups', 'stats'));
    }
}
