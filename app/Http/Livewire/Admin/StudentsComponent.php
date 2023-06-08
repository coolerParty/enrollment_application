<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Users;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class StudentsComponent extends Component
{
    use AuthorizesRequests;
    use WithPagination;


    public function render()
    {
        $this->authorize('student-show');

        $users = User::with('profile')->orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.admin.students-component', ['users' => $users])->layout('layouts.base');
    }

}
