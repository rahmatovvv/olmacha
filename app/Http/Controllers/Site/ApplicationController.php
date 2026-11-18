<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:120',
            'course_id' => 'nullable|exists:courses,id',
            'message' => 'nullable|string|max:1000',
        ], [], [
            'name' => 'ism',
            'phone' => 'telefon raqam',
            'email' => 'email',
            'course_id' => 'kurs',
            'message' => 'izoh',
        ]);

        Application::create($data + ['status' => 'new']);

        return back()->with('success', "Arizangiz qabul qilindi. Administratorlarimiz tez orada bog'lanadi.");
    }
}
