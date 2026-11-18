<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;

class PageController extends Controller
{
    public function about()
    {
        $teachers = Teacher::active()->orderByDesc('experience_years')->take(3)->get();
        $courseCount = Course::active()->count();

        return view('site.about', compact('teachers', 'courseCount'));
    }

    public function contact()
    {
        $courses = Course::active()->orderBy('title')->get();

        return view('site.contact', compact('courses'));
    }
}
