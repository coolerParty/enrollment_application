<?php

namespace App\Http\Livewire\Admin;

use App\Models\SchoolYear;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SchoolYearAddComponent extends Component
{
    use AuthorizesRequests;
    public $school_yr;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'school_yr' => ['required', 'numeric', 'unique:school_years'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'school_yr' => ['required', 'numeric', 'unique:school_years'],
        ]);

        $sy            = new SchoolYear();
        $sy->school_yr = $this->school_yr;
        $sy->save();

        return redirect()->route('admin.schoolyear.index')
            ->with('success', 'School Year "' . $this->school_yr . '" created successfully.');
    }

    public function confirmation()
    {
        $this->authorize('school-year-create');
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.admin.school-year-add-component')->layout('layouts.base');
    }
}
