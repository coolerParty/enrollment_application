<?php

namespace App\Http\Livewire\Admin;

use App\Models\SchoolYear;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class SchoolYearEditComponent extends Component
{
    use AuthorizesRequests;
    public $school_yr;
    public $school_id;

    public function mount($school_year_id)
    {
        $sy = SchoolYear::where('id',$school_year_id)->first();
        if (empty($sy)) {
            return redirect()->route('admin.schoolyear.index')
                ->with('error', 'School Year not found!');
        }
        $this->school_id = $sy->id;
        $this->school_yr = $sy->school_yr;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'school_yr' => ['required', 'numeric', Rule::unique('school_years')->ignore($this->school_id)],
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'school_yr' => ['required', 'numeric', Rule::unique('school_years')->ignore($this->school_id)],
        ]);

        $sy = SchoolYear::find($this->school_id);
        if (empty($sy)) {
            return redirect()->route('admin.schoolyear.index')
                ->with('error', 'School Year not found!');
        }
        $sy->school_yr = $this->school_yr;
        $sy->save();

        return redirect()->route('admin.schoolyear.index')
            ->with('success', 'Subject "' . $this->school_yr . '" updated successfully.');
    }

    public function confirmation()
    {
        $this->authorize('school-year-edit');
    }

    public function render()
    {
        $this->confirmation();
        return view('livewire.admin.school-year-edit-component')->layout('layouts.base');
    }
}
