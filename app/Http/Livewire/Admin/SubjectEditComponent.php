<?php

namespace App\Http\Livewire\Admin;


use Livewire\Component;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class SubjectEditComponent extends Component
{
    use AuthorizesRequests;
    public $sub_code;
    public $sub_name;

    public $subject_id;

    public function mount($subject_id)
    {
        $subject = Subject::where('id',$subject_id)->first();
        if (empty($subject)) {
            return redirect()->route('admin.subject.index')
                ->with('error', 'Subject not found!');
        }
        $this->subject_id = $subject->id;
        $this->sub_code   = $subject->sub_code;
        $this->sub_name   = $subject->sub_name;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'sub_code' => ['required', 'min:3', 'max:255', 'string', Rule::unique('subjects')->ignore($this->subject_id)],
            'sub_name' => ['required', 'min:3', 'max:255', 'string']
        ]);
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'sub_code' => ['required', 'min:3', 'max:255', 'string', Rule::unique('subjects')->ignore($this->subject_id)],
            'sub_name' => ['required', 'min:3', 'max:255', 'string']
        ]);

        $subject = Subject::find($this->subject_id);
        if (empty($subject)) {
            return redirect()->route('admin.subject.index')
                ->with('error', 'Subject not found!');
        }
        $subject->sub_code = $this->sub_code;
        $subject->sub_name = $this->sub_name;
        $subject->save();

        return redirect()->route('admin.subject.index')
            ->with('success', 'Subject "' . $this->sub_code . '" updated successfully.');
    }

    public function confirmation()
    {
        $this->authorize('subject-edit');
    }

    public function render()
    {
        $this->confirmation();
        return view('livewire.admin.subject-edit-component')->layout('layouts.base');
    }
}
