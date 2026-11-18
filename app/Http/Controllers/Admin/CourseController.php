<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));

        $courses = Course::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->withCount('groups')
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        return view('admin.courses.index', compact('courses', 'search'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'Kurs qo\'shildi.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $course->id);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'Kurs yangilandi.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Kurs o\'chirildi.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'slug' => 'nullable|string|max:170',
            'category' => 'required|string|max:60',
            'level' => 'nullable|string|max:60',
            'summary' => 'required|string|max:255',
            'description' => 'required|string',
            'syllabus' => 'nullable|string',
            'duration_months' => 'required|integer|min:1|max:36',
            'lessons_per_week' => 'required|integer|min:1|max:7',
            'price' => 'required|numeric|min:0',
        ], [], [
            'title' => 'nomi',
            'category' => 'kategoriya',
            'summary' => 'qisqa tavsif',
            'description' => 'tavsif',
            'price' => 'narx',
        ]);

        $data['slug'] = trim((string) ($data['slug'] ?? ''));

        return $data;
    }

    private function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = Course::makeSlug($base);
        $original = $slug;
        $counter = 2;

        while (Course::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $original.'-'.$counter++;
        }

        return $slug;
    }
}
