<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentsEditComponent extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public $student_id;

    public $name;
    public $email;
    public $profile_photo_path;

    public $firstname;
    public $lastname;
    public $mobile;
    public $city;
    public $province;
    public $country;

    public $gpa;
    public $scholar = false;

    public $newimage;

    public function mount($student_id)
    {

        $userProfile = Profile::select('id', 'user_id', 'firstname', 'lastname', 'mobile', 'city', 'province', 'country','gpa','scholar')
            ->where('user_id', $student_id)->first();

        if (empty($userProfile)) {
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
            $profile->save();
            return redirect()->to(route('user.profile.edit'));
        }

        $this->student_id = $student_id;
        $this->firstname  = $userProfile->firstname;
        $this->lastname   = $userProfile->lastname;
        $this->mobile     = $userProfile->mobile;
        $this->city       = $userProfile->city;
        $this->province   = $userProfile->province;
        $this->country    = $userProfile->country;
        $this->gpa        = $userProfile->gpa;
        $this->scholar    = $userProfile->scholar;

        $user = User::select('name', 'email','profile_photo_path')->where('id', $student_id)->first();
        $this->name               = $user->name;
        $this->email              = $user->email;
        $this->profile_photo_path = $user->profile_photo_path;
    }

    public function updated($fields)
    {

        $this->validateOnly($fields, [
            'name'      => ['required', 'min:3'],
            'firstname' => ['required', 'min:3'],
            'lastname'  => ['required', 'min:3'],
            'email'     => ['required', 'max:150', Rule::unique('users')->ignore($this->student_id)],
            'mobile'    => ['nullable', 'numeric', 'min:11'],
            'city'      => ['nullable'],
            'province'  => ['nullable'],
            'country'   => ['nullable'],
            'gpa'       => ['nullable','numeric', 'min:0'],
            'scholar'   => ['nullable','boolean'],
        ]);

        if ($this->newimage) {
            $this->validateOnly($fields, ['newimage' => 'required|mimes:jpeg,jpg,png|max:2000',]);
        }
    }

    public function update()
    {
        $this->confirmation();

        $this->validate([
            'name'      => ['required', 'min:3'],
            'firstname' => ['required', 'min:3'],
            'lastname'  => ['required', 'min:3'],
            'email'     => ['required', 'max:150', Rule::unique('users')->ignore($this->student_id)],
            'mobile'    => ['nullable', 'numeric', 'min:11'],
            'city'      => ['nullable'],
            'province'  => ['nullable'],
            'country'   => ['nullable'],
            'gpa'       => ['nullable','numeric', 'min:0'],
            'scholar'   => ['nullable','boolean'],
        ]);

        if ($this->newimage) {
            $this->validate(['newimage' => 'required|mimes:jpeg,jpg,png|max:2000',]);
        }

        $profile            = Profile::where('user_id', $this->student_id)->first();
        $profile->firstname = $this->firstname;
        $profile->lastname  = $this->lastname;
        $profile->mobile    = $this->mobile;
        $profile->city      = $this->city;
        $profile->province  = $this->province;
        $profile->country   = $this->country;
        $profile->gpa       = $this->gpa;
        $profile->scholar   = $this->scholar;

        $profile->save();

        $user           = User::find($this->student_id);
        $user->name     = $this->name;
        $user->email    = $this->email;
        if ($this->newimage) {
            if (!empty($user->profile_photo_path) && file_exists('storage/assets/user/profile-photo/large' . '/' . $user->profile_photo_path)) {
                unlink('storage/assets/user/profile-photo/large' . '/' . $user->profile_photo_path); // Deleting Image
            }
            if (!empty($user->profile_photo_path) && file_exists('storage/assets/user/profile-photo/thumbnail' . '/' . $user->profile_photo_path)) {
                unlink('storage/assets/user/profile-photo/thumbnail' . '/' . $user->profile_photo_path); // Deleting Image
            }
            $imagename     = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $originalPath  = storage_path() . '/app/public/assets/user/profile-photo/large/';
            $thumbnailPath = storage_path() . '/app/public/assets/user/profile-photo/thumbnail/';
            $imageFile     = Image::make($this->newimage);
            $imageFile->fit(800, 800);
            $imageFile->save($originalPath . $imagename);
            $imageFile->fit(190, 190);
            $imageFile->save($thumbnailPath . $imagename);
            $user->profile_photo_path = $imagename;
        }
        $user->save();

        session()->flash('message', 'Profile has been updated successfully!');
        return redirect()->to(route('admin.student.index'));
    }

    public function removeImage()
    {
        $this->newimage = null;
    }

    public function confirmation()
    {
        $this->authorize('student-edit');
    }

    public function render()
    {
        $this->confirmation();
        return view('livewire.admin.students-edit-component')->layout('layouts.base');
    }

}
