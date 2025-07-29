<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    
    public function create()
    {
        return view('courses.create');
    }

public function store(Request $request)
{
    
  $validated = $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'required|string',
    'course_category' => 'nullable|string|max:255',
    'modules' => 'required|array|min:1',
    'modules.*.title' => 'required|string|max:255',
    'modules.*.contents' => 'required|array|min:1',
    'modules.*.contents.*.type' => 'required|string|in:text,image,link',
    'modules.*.contents.*.value' => 'required|string',
]);


    $course = Course::create([
    'title' => $validated['title'],
    'description' => $validated['description'],
    'category' => $validated['course_category'] ?? null,
]);


    foreach ($validated['modules'] as $moduleData) {
        $module = Module::create([
            'course_id' => $course->id,
            'title' => $moduleData['title'],
        ]);

        foreach ($moduleData['contents'] as $contentData) {
            Content::create([
                'module_id' => $module->id,
                'type' => $contentData['type'],
                'value' => $contentData['value'],
            ]);
        }
    }

    return redirect()->route('home')->with('success', 'Course created successfully.');
}


}
