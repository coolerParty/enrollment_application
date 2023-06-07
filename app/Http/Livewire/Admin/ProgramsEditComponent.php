<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\CourseProgram;
use App\Models\SchoolYear;
use App\Models\Subject;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProgramsEditComponent extends Component
{
    use AuthorizesRequests;
    public $school_year_id;
    public $subject_id;
    public $course_id;
    public $active;
    public $program_id;

    public $schoolYear;

    public function mount($program_id)
    {
        $cp = CourseProgram::find($program_id);
        if (empty($cp)) {
            return redirect()->route('admin.program.index')
                ->with('error', 'Program not found!');
        }
        $this->program_id     = $cp->id;
        $this->school_year_id = $cp->school_year_id;
        $this->subject_id     = $cp->subject_id;
        $this->course_id      = $cp->course_id;
        $this->active         = $cp->active;
        $this->schoolYear     = $cp->schoolYear->school_yr;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'school_year_id' => ['required', 'numeric'],
            'subject_id'     => ['required', 'numeric'],
            'course_id'      => ['required', 'numeric'],
            'active'         => ['required', 'boolean'],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'school_year_id' => ['required', 'numeric'],
            'subject_id'     => ['required', 'numeric'],
            'course_id'      => ['required', 'numeric'],
            'active'         => ['required', 'boolean'],
        ]);

        $cp = CourseProgram::find($this->program_id);
        if (empty($cp)) {
            return redirect()->route('admin.program.index')
                ->with('error', 'Program not found!');
        }
        $cp->school_year_id = $this->school_year_id;
        $cp->subject_id     = $this->subject_id;
        $cp->course_id      = $this->course_id;
        $cp->active         = $this->active;
        $cp->save();

        return redirect()->route('admin.program.index')
            ->with('success', 'Program updated successfully.');
    }

    public function confirmation()
    {
        $this->authorize('program-edit');
    }

    public function render()
    {
        $this->confirmation();

        $sys = SchoolYear::select('id','school_yr')->orderBy('school_yr','asc')->get();
        $subs = Subject::select('id','sub_code', 'sub_name')->orderBy('sub_code','asc')->get();
        $courses = Course::select('id','course_name', 'gpa')->orderBy('course_name','asc')->get();

        return view('livewire.admin.programs-edit-component',['sys'=> $sys, 'subs'=> $subs, 'courses' => $courses])->layout('layouts.base');
    }
}
