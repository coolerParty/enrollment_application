<?php

namespace App\Http\Livewire\Admin;

use App\Models\SchoolYear;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class SchoolYearComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public function destroy($school_year_id)
    {
        $this->authorize('school-year-delete');

        $schoolYear = SchoolYear::find($school_year_id);
        if(empty($schoolYear))
        {
            return session()->flash('error', 'No Item Found!');
        }
        $schoolYear->delete();
        return session()->flash('success', 'School Year has been deleted successfully');
    }

    public function render()
    {
        $this->authorize('school-year-show');

        $schoolYears = SchoolYear::orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.admin.school-year-component', ['schoolYears' => $schoolYears])->layout('layouts.base');
    }
}
