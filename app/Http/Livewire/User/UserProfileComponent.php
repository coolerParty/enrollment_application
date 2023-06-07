<?php

namespace App\Http\Livewire\User;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileComponent extends Component
{
    public function render()
    {
        $user = User::select('id','name','email','profile_photo_path')->find(Auth::user()->id);
        $userProfile = Profile::select('id','user_id','firstname','lastname','mobile','city','province','country')
					->where('user_id', Auth::user()->id)->first();

			if(!$userProfile)
			{
				$profile = new Profile();
				$profile->user_id = $user->id;
                $profile->firstname = $user->name;
				$profile->save();
				return redirect()->to(route('user.profile'));
			}


			return view('livewire.user.user-profile-component',['userProfile'=>$userProfile,'user'=>$user])->layout('layouts.front');
    }
}
