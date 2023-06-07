<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseProgram;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class ProgramsComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public function destroy($program_id)
    {
        $this->authorize('program-delete');

        $program = CourseProgram::find($program_id);
        if(empty($program))
        {
            return session()->flash('error', 'No Item Found!');
        }
        $program->delete();
        return session()->flash('success', 'Course Program has been deleted successfully');
    }

    public function render()
    {
        $this->authorize('program-show');

        $cps = CourseProgram::with('course')->with('schoolYear')->with('subject')
                    ->orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.admin.programs-component', ['cps' => $cps])->layout('layouts.base');
    }

}
