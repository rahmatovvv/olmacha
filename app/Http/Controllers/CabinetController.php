<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $enrollments = $user->enrollments()
            ->with(['studyGroup.course', 'studyGroup.teacher'])
            ->orderByDesc('enrolled_at')
            ->get();

        $groupIds = $enrollments->pluck('study_group_id');

        $nextLessons = Lesson::whereIn('study_group_id', $groupIds)
            ->where('starts_at', '>=', now())
            ->with('studyGroup.course')
            ->orderBy('starts_at')
            ->take(5)
            ->get();

        $attendances = $user->attendances()->get();
        $totalLessons = $attendances->count();
        $presentCount = $attendances->whereIn('status', ['present', 'late'])->count();
        $attendanceRate = $totalLessons > 0 ? (int) round($presentCount / $totalLessons * 100) : 0;

        $totalPaid = $user->payments()->where('status', 'paid')->sum('amount');
        $lastPayment = $user->payments()->orderByDesc('paid_at')->first();

        return view('cabinet.dashboard', compact(
            'enrollments', 'nextLessons', 'attendanceRate', 'presentCount', 'totalLessons', 'totalPaid', 'lastPayment'
        ));
    }

    public function group(Request $request, \App\Models\StudyGroup $group)
    {
        $user = $request->user();

        abort_unless(
            $user->enrollments()->where('study_group_id', $group->id)->exists(),
            403,
            "Bu guruh sizga tegishli emas."
        );

        $group->load(['course', 'teacher']);

        $lessons = $group->lessons()
            ->with(['attendances' => fn ($query) => $query->where('user_id', $user->id)])
            ->orderBy('starts_at')
            ->get();

        $myAttendances = $lessons->flatMap->attendances;
        $attended = $myAttendances->whereIn('status', ['present', 'late'])->count();
        $attendanceRate = $myAttendances->count() > 0
            ? (int) round($attended / $myAttendances->count() * 100)
            : 0;

        $payments = $user->payments()
            ->where('study_group_id', $group->id)
            ->orderByDesc('paid_at')
            ->get();

        $upcoming = $lessons->filter(fn ($lesson) => $lesson->starts_at->isFuture())->take(3);

        return view('cabinet.group', compact('group', 'lessons', 'attendanceRate', 'attended', 'payments', 'upcoming'));
    }

    public function payments(Request $request)
    {
        $payments = $request->user()->payments()
            ->with('studyGroup.course')
            ->orderByDesc('paid_at')
            ->paginate(10);

        $totalPaid = $request->user()->payments()->where('status', 'paid')->sum('amount');

        return view('cabinet.payments', compact('payments', 'totalPaid'));
    }
}
