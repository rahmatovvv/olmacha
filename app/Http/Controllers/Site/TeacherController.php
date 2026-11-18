<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::active()
            ->withCount('groups')
            ->orderByDesc('experience_years')
            ->get();

        return view('site.teachers.index', compact('teachers'));
    }
}
