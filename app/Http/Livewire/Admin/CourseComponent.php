<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class CourseComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public function destroy($course_id)
    {
        $this->authorize('course-delete');

        $course = Course::find($course_id);
        if(empty($course))
        {
            return session()->flash('error', 'No Item Found!');
        }
        $course->delete();
        return session()->flash('success', 'Course has been deleted successfully');
    }

    public function render()
    {
        $this->authorize('school-year-show');

        $courses = Course::orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.admin.course-component', ['courses' => $courses])->layout('layouts.base');
    }

}
