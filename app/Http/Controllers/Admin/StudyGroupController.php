<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\StudyGroup;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class StudyGroupController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));

        $groups = StudyGroup::query()
            ->with(['course', 'teacher'])
            ->withCount(['enrollments' => fn ($query) => $query->where('status', 'active')])
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderByDesc('is_active')
            ->orderBy('starts_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.groups.index', compact('groups', 'search'));
    }

    public function create()
    {
        $courses = Course::orderBy('title')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.groups.create', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        StudyGroup::create($this->validated($request) + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.groups.index')->with('success', 'Guruh yaratildi.');
    }

    public function show(StudyGroup $group)
    {
        $group->load([
            'course',
            'teacher',
            'enrollments.user',
            'lessons' => fn ($query) => $query->orderByDesc('starts_at'),
            'lessons.attendances',
        ]);

        $availableStudents = User::students()
            ->whereNotIn('id', $group->enrollments->pluck('user_id'))
            ->orderBy('name')
            ->get();

        return view('admin.groups.show', compact('group', 'availableStudents'));
    }

    public function edit(StudyGroup $group)
    {
        $courses = Course::orderBy('title')->get();
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.groups.edit', compact('group', 'courses', 'teachers'));
    }

    public function update(Request $request, StudyGroup $group)
    {
        $group->update($this->validated($request) + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.groups.show', $group)->with('success', 'Guruh yangilandi.');
    }

    public function destroy(StudyGroup $group)
    {
        $group->delete();

        return redirect()->route('admin.groups.index')->with('success', "Guruh o'chirildi.");
    }

    public function storeStudent(Request $request, StudyGroup $group)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
        ], [], ['user_id' => 'talaba']);

        if ($group->enrollments()->where('user_id', $data['user_id'])->exists()) {
            return back()->withErrors(['user_id' => 'Bu talaba allaqachon guruhda.']);
        }

        if ($group->seatsLeft() < 1) {
            return back()->withErrors(['user_id' => 'Guruhda bo\'sh joy qolmagan.']);
        }

        Enrollment::create([
            'user_id' => $data['user_id'],
            'study_group_id' => $group->id,
            'status' => 'active',
            'enrolled_at' => now()->toDateString(),
        ]);

        return redirect()->route('admin.groups.show', $group)->with('success', "Talaba guruhga qo'shildi.");
    }

    public function destroyStudent(StudyGroup $group, User $student)
    {
        $group->enrollments()->where('user_id', $student->id)->delete();

        return redirect()->route('admin.groups.show', $group)->with('success', 'Talaba guruhdan chiqarildi.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'name' => 'required|string|max:100',
            'room' => 'nullable|string|max:50',
            'schedule' => 'required|string|max:120',
            'starts_at' => 'required|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'capacity' => 'required|integer|min:1|max:60',
        ], [], [
            'course_id' => 'kurs',
            'teacher_id' => "o'qituvchi",
            'name' => 'guruh nomi',
            'schedule' => 'jadval',
            'starts_at' => 'boshlanish sanasi',
            'capacity' => 'joy soni',
        ]);
    }
}
