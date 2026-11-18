<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudyGroup;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $category = trim((string) $request->query('kategoriya'));

        $courses = Course::active()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('summary', 'like', "%{$search}%");
                });
            })
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->orderByDesc('is_featured')
            ->orderBy('title')
            ->paginate(9)
            ->withQueryString();

        $categories = Course::active()->select('category')->distinct()->orderBy('category')->pluck('category');

        return view('site.courses.index', compact('courses', 'categories', 'search', 'category'));
    }

    public function show(Course $course)
    {
        abort_unless($course->is_active, 404);

        $groups = StudyGroup::active()
            ->where('course_id', $course->id)
            ->with('teacher')
            ->withCount('enrollments')
            ->orderBy('starts_at')
            ->get();

        $related = Course::active()
            ->where('category', $course->category)
            ->where('id', '!=', $course->id)
            ->take(3)
            ->get();

        return view('site.courses.show', compact('course', 'groups', 'related'));
    }
}
