<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class UserProfileEditComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $profile_photo_path;

    public $firstname;
    public $lastname;
    public $mobile;
    public $city;
    public $province;
    public $country;

    public $newimage;

    public function mount()
    {

        $userProfile = Profile::select('id', 'user_id', 'firstname', 'lastname', 'mobile', 'city', 'province', 'country')
            ->where('user_id', Auth::user()->id)->first();

        if (empty($userProfile)) {
            $profile = new Profile();
            $profile->user_id = Auth::user()->id;
            $profile->save();
            return redirect()->to(route('user.profile.edit'));
        }

        $this->firstname = $userProfile->firstname;
        $this->lastname  = $userProfile->lastname;
        $this->mobile    = $userProfile->mobile;
        $this->city      = $userProfile->city;
        $this->province  = $userProfile->province;
        $this->country   = $userProfile->country;

        $user = User::select('name', 'email','profile_photo_path')->where('id', Auth::user()->id)->first();
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
            'email'     => ['required', 'max:150', Rule::unique('users')->ignore(Auth::user()->id)],
            'mobile'    => ['nullable', 'numeric', 'min:11'],
            'city'      => ['nullable'],
            'province'  => ['nullable'],
            'country'   => ['nullable'],

        ]);

        if ($this->newimage) {
            $this->validateOnly($fields, ['newimage' => 'required|mimes:jpeg,jpg,png|max:2000',]);
        }
    }

    public function update()
    {
        $this->validate([
            'name'      => ['required', 'min:3'],
            'firstname' => ['required', 'min:3'],
            'lastname'  => ['required', 'min:3'],
            'email'     => ['required', 'max:150', Rule::unique('users')->ignore(Auth::user()->id)],
            'mobile'    => ['nullable', 'numeric', 'min:11'],
            'city'      => ['nullable'],
            'province'  => ['nullable'],
            'country'   => ['nullable'],
        ]);

        if ($this->newimage) {
            $this->validate(['newimage' => 'required|mimes:jpeg,jpg,png|max:2000',]);
        }

        $profile            = Profile::where('user_id', Auth::user()->id)->first();
        $profile->firstname = $this->firstname;
        $profile->lastname  = $this->lastname;
        $profile->mobile    = $this->mobile;
        $profile->city      = $this->city;
        $profile->province  = $this->province;
        $profile->country   = $this->country;

        $profile->save();

        $user           = User::find(Auth::user()->id);
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
        return redirect()->to(route('user.profile'));
    }

    public function removeImage()
    {
        $this->newimage = null;
    }

    public function render()
    {
        return view('livewire.user.user-profile-edit-component')->layout('layouts.front');
    }
}
