<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\StudyGroup;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $status = (string) $request->query('holat');

        $payments = Payment::query()
            ->with(['user', 'studyGroup.course'])
            ->when($search !== '', function ($query) use ($search) {
                $query->whereHas('user', fn ($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->when(array_key_exists($status, Payment::STATUSES), fn ($query) => $query->where('status', $status))
            ->orderByDesc('paid_at')
            ->paginate(12)
            ->withQueryString();

        $monthTotal = Payment::where('status', 'paid')
            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');

        return view('admin.payments.index', compact('payments', 'search', 'status', 'monthTotal'));
    }

    public function create()
    {
        $students = User::students()->orderBy('name')->get();
        $groups = StudyGroup::with('course')->orderBy('name')->get();

        return view('admin.payments.create', compact('students', 'groups'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'study_group_id' => 'nullable|exists:study_groups,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:'.implode(',', array_keys(Payment::METHODS)),
            'status' => 'required|in:'.implode(',', array_keys(Payment::STATUSES)),
            'paid_at' => 'required|date',
            'note' => 'nullable|string|max:255',
        ], [], [
            'user_id' => 'talaba',
            'study_group_id' => 'guruh',
            'amount' => 'summa',
            'method' => "to'lov usuli",
            'status' => 'holat',
            'paid_at' => 'to\'lov sanasi',
        ]);

        Payment::create($data);

        return redirect()->route('admin.payments.index')->with('success', "To'lov qayd etildi.");
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', "To'lov o'chirildi.");
    }
}
