<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Lesson;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function store(Request $request, Lesson $lesson)
    {
        $data = $request->validate([
            'statuses' => 'required|array',
            'statuses.*' => 'in:present,late,absent,excused',
            'notes' => 'nullable|array',
            'notes.*' => 'nullable|string|max:255',
        ], [], ['statuses' => 'davomat']);

        $enrolledIds = $lesson->studyGroup->enrollments()
            ->where('status', 'active')
            ->pluck('user_id')
            ->all();

        foreach ($data['statuses'] as $userId => $status) {
            if (! in_array((int) $userId, $enrolledIds, true)) {
                continue;
            }

            Attendance::updateOrCreate(
                ['lesson_id' => $lesson->id, 'user_id' => (int) $userId],
                ['status' => $status, 'note' => $data['notes'][$userId] ?? null]
            );
        }

        return redirect()->route('admin.lessons.show', $lesson)->with('success', 'Davomat saqlandi.');
    }
}
