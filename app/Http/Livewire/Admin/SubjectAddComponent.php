<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubjectAddComponent extends Component
{
    use AuthorizesRequests;
    public $sub_code;
    public $subject_name;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'sub_code' => ['required', 'min:3', 'max:255', 'string', 'unique:subjects'],
            'subject_name' => ['required', 'min:3', 'max:255', 'string'],
        ]);
    }

    public function store()
    {
        $this->confirmation();

        $this->validate([
            'sub_code' => ['required', 'min:3', 'max:255', 'string', 'unique:subjects'],
            'subject_name' => ['required', 'min:3', 'max:255', 'string'],
        ]);

        $subject           = new Subject();
        $subject->sub_code = $this->sub_code;
        $subject->sub_name = $this->subject_name;
        $subject->save();

        return redirect()->route('admin.subject.index')
            ->with('success', 'Subject "' . $this->sub_code . '" created successfully.');
    }

    public function confirmation()
    {
        $this->authorize('subject-create');
    }

    public function render()
    {
        $this->confirmation();

        return view('livewire.admin.subject-add-component')->layout('layouts.base');
    }
}
