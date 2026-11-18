<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));

        $teachers = Teacher::query()
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->withCount('groups')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.teachers.index', compact('teachers', 'search'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'specialty' => 'required|string|max:120',
            'experience_years' => 'required|integer|min:0|max:60',
            'bio' => 'nullable|string|max:2000',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:120',
        ], [], [
            'name' => 'ism',
            'specialty' => 'mutaxassislik',
            'experience_years' => 'tajriba',
        ]);

        Teacher::create($data + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.teachers.index')->with('success', "O'qituvchi qo'shildi.");
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'specialty' => 'required|string|max:120',
            'experience_years' => 'required|integer|min:0|max:60',
            'bio' => 'nullable|string|max:2000',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:120',
        ]);

        $teacher->update($data + ['is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.teachers.index')->with('success', "O'qituvchi ma'lumotlari yangilandi.");
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', "O'qituvchi o'chirildi.");
    }
}
