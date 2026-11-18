<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\StudyGroup;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function store(Request $request, StudyGroup $group)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'topic' => 'nullable|string|max:255',
            'starts_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:15|max:300',
        ], [], [
            'title' => 'dars nomi',
            'starts_at' => 'vaqt',
            'duration_minutes' => 'davomiyligi',
        ]);

        $group->lessons()->create($data);

        return redirect()->route('admin.groups.show', $group)->with('success', "Dars qo'shildi.");
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['studyGroup.course', 'studyGroup.teacher', 'attendances']);

        $students = $lesson->studyGroup->enrollments()
            ->where('status', 'active')
            ->with('user')
            ->get()
            ->pluck('user')
            ->filter();

        $attendanceByUser = $lesson->attendances->keyBy('user_id');

        return view('admin.lessons.show', compact('lesson', 'students', 'attendanceByUser'));
    }

    public function destroy(Lesson $lesson)
    {
        $group = $lesson->studyGroup;
        $lesson->delete();

        return redirect()->route('admin.groups.show', $group)->with('success', "Dars o'chirildi.");
    }
}
