<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\CourseProgram;
use App\Models\Enrollment;
use App\Models\Profile;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function store($school_year_id, $subject_id, $course_id)
    {
        $course = Course::find($course_id);

        $profile = Profile::where('user_id', Auth::user()->id)->first();

        if($profile->gpa <= 50 and $profile->scholar == true)
        {
            return redirect()->route('home')
            ->with('error', ' You are below GPA requirement!');
        }
        if($profile->gpa < $course->gpa and $profile->scholar == false)
        {
            return redirect()->route('home')
            ->with('error', 'You are below GPA requirement!');
        }

        $totalEnrolled = Enrollment::where('school_year_id', $school_year_id)
        ->where('subject_id', $subject_id)
        ->where('course_id', $course_id)
        ->whereNot('user_id', Auth::user()->id)
        ->count();

        if($course->student_limit < $totalEnrolled)
        {
            return redirect()->route('home')
            ->with('error', 'This course is full!');
        }

        $cps = Enrollment::where('school_year_id', $school_year_id)
        ->where('subject_id', $subject_id)
        ->where('course_id', $course_id)
        ->where('user_id', Auth::user()->id)
        ->first();

        if($cps)
        {
            return redirect()->route('home')
            ->with('error', 'Already Added!');
        }

        $enrolment = new Enrollment();
        $enrolment->school_year_id = $school_year_id;
        $enrolment->subject_id = $subject_id;
        $enrolment->course_id = $course_id;
        $enrolment->user_id = Auth::user()->id;
        $enrolment->save();
        return session()->flash('success', 'Successfully Added!');

    }

    public function render()
    {
        if(Auth::user())
        {
            $userProfile = Profile::select('id','user_id','firstname','lastname','mobile','city','province','country')
            ->where('user_id', Auth::user()->id)->first();
            if(!$userProfile)
                {
                    $profile = new Profile();
                    $profile->user_id = Auth::user()->id;
                    $profile->firstname = Auth::user()->name;
                    $profile->gpa = 0;
                    $profile->scholar = false;
                    $profile->save();
                    // return redirect()->to(route('user.profile'));
                }
        }


        $cps = CourseProgram::with('course')->with('schoolYear')->with('subject')
            ->orderBy('created_at', 'ASC')
            ->where('active', 1)
            ->get();

        $courseId = array_unique($cps->pluck('course_id')->all());
        $courses = Course::select('id','course_name','gpa','student_limit')->whereIn('id', $courseId)->get();

        $syId = array_unique($cps->pluck('school_year_id')->all());
        $sy = SchoolYear::whereIn('id',$syId)->first();

        return view('livewire.home-component', ['cps'=>$cps, 'courses'=>$courses,'sy'=>$sy])->layout('layouts.front');
    }
}
