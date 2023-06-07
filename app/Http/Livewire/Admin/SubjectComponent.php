<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subject;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class SubjectComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public function destroy($subject_id)
    {
        $this->authorize('subject-delete');

        $subject = Subject::find($subject_id);
        if(empty($subject))
        {
            return session()->flash('error', 'No Item Found!');
        }
        $subject->delete();
        return session()->flash('success', 'Subject has been deleted successfully');
    }

    public function render()
    {
        $this->authorize('subject-show');

        $subjects = Subject::orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.admin.subject-component', ['subjects' => $subjects])->layout('layouts.base');
    }


}
