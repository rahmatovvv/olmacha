<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));

        $students = User::students()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->withCount(['enrollments' => fn ($query) => $query->where('status', 'active')])
            ->withSum(['payments' => fn ($query) => $query->where('status', 'paid')], 'amount')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.students.index', compact('students', 'search'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:120|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'password' => 'required|string|min:8',
        ], [], [
            'name' => 'ism',
            'email' => 'email',
            'phone' => 'telefon',
            'password' => 'parol',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'role' => 'student',
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Talaba qo\'shildi.');
    }

    public function edit(User $student)
    {
        abort_unless($student->isStudent(), 404);

        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        abort_unless($student->isStudent(), 404);

        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => ['required', 'email', 'max:120', Rule::unique('users', 'email')->ignore($student->id)],
            'phone' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:8',
        ]);

        $student->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
        ]);

        if (! empty($data['password'])) {
            $student->password = Hash::make($data['password']);
        }

        $student->save();

        return redirect()->route('admin.students.index')->with('success', "Talaba ma'lumotlari yangilandi.");
    }

    public function destroy(User $student)
    {
        abort_unless($student->isStudent(), 404);

        $student->delete();

        return redirect()->route('admin.students.index')->with('success', "Talaba o'chirildi.");
    }
}
