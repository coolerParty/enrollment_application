<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\CourseProgram;
use App\Models\SchoolYear;
use App\Models\Subject;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProgramsAddComponent extends Component
{
    use AuthorizesRequests;
    public $school_year_id;
    public $subject_id;
    public $course_id;
    public $active;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'school_year_id' => ['required', 'numeric'],
            'subject_id'     => ['required', 'numeric'],
            'course_id'      => ['required', 'numeric'],
            'active'         => ['required', 'boolean'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'school_year_id' => ['required', 'numeric'],
            'subject_id'     => ['required', 'numeric'],
            'course_id'      => ['required', 'numeric'],
            'active'         => ['required', 'boolean'],
        ]);

        $sy                 = new CourseProgram();
        $sy->school_year_id = $this->school_year_id;
        $sy->subject_id     = $this->subject_id;
        $sy->course_id      = $this->course_id;
        $sy->active         = $this->active;
        $sy->save();

        return redirect()->route('admin.program.index')
            ->with('success', 'New program created successfully.');
    }

    public function confirmation()
    {
        $this->authorize('program-create');
    }

    public function render()
    {
        $this->confirmation();

        $sys = SchoolYear::select('id','school_yr')->orderBy('school_yr','asc')->get();
        $subs = Subject::select('id','sub_code', 'sub_name')->orderBy('sub_code','asc')->get();
        $courses = Course::select('id','course_name', 'gpa')->orderBy('course_name','asc')->get();

        return view('livewire.admin.programs-add-component',['sys'=> $sys, 'subs'=> $subs, 'courses' => $courses])->layout('layouts.base');
    }

}
