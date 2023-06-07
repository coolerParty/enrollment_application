<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseAddComponent extends Component
{
    use AuthorizesRequests;
    public $course_name;
    public $course_description;
    public $gpa;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'course_name'        => ['required', 'min:3', 'max:255', 'String', 'unique:courses'],
            'course_description' => ['required', 'min:3', 'max:255', 'String'],
            'gpa'                => ['required', 'numeric', 'min:0'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'course_name'        => ['required', 'min:3', 'max:255', 'String', 'unique:courses'],
            'course_description' => ['required', 'min:3', 'max:255', 'String'],
            'gpa'                => ['required', 'numeric', 'min:0'],
        ]);

        $course                     = new Course();
        $course->course_name        = $this->course_name;
        $course->course_description = $this->course_description;
        $course->gpa                = $this->gpa;
        $course->save();

        return redirect()->route('admin.course.index')
            ->with('success', 'Course "' . $this->course_name . '" created successfully.');
    }

    public function confirmation()
    {
        $this->authorize('course-create');
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.admin.course-add-component')->layout('layouts.base');
    }

}
