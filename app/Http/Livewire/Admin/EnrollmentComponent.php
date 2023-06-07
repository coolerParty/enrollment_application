<?php

namespace App\Http\Livewire\Admin;

use App\Models\Enrollment;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class EnrollmentComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public function destroy($school_year_id)
    {
        $this->authorize('enrollment-delete');

        $schoolYear = Enrollment::find($school_year_id);
        if(empty($schoolYear))
        {
            return session()->flash('error', 'No Item Found!');
        }
        $schoolYear->delete();
        return session()->flash('success', 'Enrollment has been deleted successfully');
    }

    public function render()
    {
        $this->authorize('enrollment-show');

        $enrollments = Enrollment::with('course')->with('user')->with('schoolYear')->with('subject')
                    ->orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.admin.enrollment-component', ['enrollments' => $enrollments])->layout('layouts.base');
    }
}
