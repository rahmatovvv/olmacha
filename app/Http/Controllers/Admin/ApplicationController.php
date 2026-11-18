<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('holat');
        $search = trim((string) $request->query('q'));

        $applications = Application::query()
            ->with('course')
            ->when(array_key_exists($status, Application::STATUSES), fn ($query) => $query->where('status', $status))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $counts = Application::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('admin.applications.index', compact('applications', 'counts', 'status', 'search'));
    }

    public function update(Request $request, Application $application)
    {
        $data = $request->validate([
            'status' => 'required|in:'.implode(',', array_keys(Application::STATUSES)),
        ], [], ['status' => 'holat']);

        $application->update($data);

        return back()->with('success', 'Ariza holati yangilandi.');
    }

    public function destroy(Application $application)
    {
        $application->delete();

        return back()->with('success', "Ariza o'chirildi.");
    }
}
