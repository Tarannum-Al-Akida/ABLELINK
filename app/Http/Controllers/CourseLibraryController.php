<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\View\View;

class CourseLibraryController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()
            ->published()
            ->with(['media'])
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course): View
    {
        // Public-facing library only shows published courses.
        abort_unless($course->published_at && $course->published_at->isPast(), 404);

        $course->load(['media']);

        return view('courses.show', compact('course'));
    }
}

