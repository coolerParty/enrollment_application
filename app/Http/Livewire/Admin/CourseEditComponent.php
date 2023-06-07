<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class CourseEditComponent extends Component
{
    use AuthorizesRequests;
    public $course_name;
    public $course_description;
    public $gpa;
    public $student_limit;
    public $course_id;

    public function mount($course_id)
    {
        $course = Course::find($course_id);
        if (empty($course)) {
            return redirect()->route('admin.course.index')
                ->with('error', 'Course not found!');
        }
        $this->course_id          = $course->id;
        $this->course_name        = $course->course_name;
        $this->course_description = $course->course_description;
        $this->gpa                = $course->gpa;
        $this->student_limit      = $course->student_limit;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'course_name'        => ['required', 'string', 'min:3', 'max:255', Rule::unique('courses')->ignore($this->course_id)],
            'course_description' => ['required', 'string', 'min:3' , 'max:255'],
            'gpa'                => ['required', 'numeric', 'min:0'],
            'student_limit'      => ['required', 'numeric', 'min:0'],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'course_name'        => ['required', 'string', 'min:3', 'max:255', Rule::unique('courses')->ignore($this->course_id)],
            'course_description' => ['required', 'string', 'min:3' , 'max:255'],
            'gpa'                => ['required', 'numeric', 'min:0'],
            'student_limit'      => ['required', 'numeric', 'min:0'],
        ]);

        $course = Course::find($this->course_id);
        if (empty($course)) {
            return redirect()->route('admin.course.index')
                ->with('error', 'Course not found!');
        }
        $course->course_name        = $this->course_name;
        $course->course_description = $this->course_description;
        $course->gpa                = $this->gpa;
        $course->student_limit      = $this->student_limit;
        $course->save();

        return redirect()->route('admin.course.index')
            ->with('success', 'Course "' . $this->course_name . '" updated successfully.');
    }

    public function confirmation()
    {
        $this->authorize('course-edit');
    }

    public function render()
    {
        $this->confirmation();
        return view('livewire.admin.course-edit-component')->layout('layouts.base');
    }

}
