<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserObserver
{
    /**
     * Handle the retrieved event
     * 
     * @param \App\Models\User
     */
    public function retrieved(User $user)
    {

    }

    /**
     * Handle the creating event
     * 
     * @param \App\Models\User
     */
    public function creating(User $user)
    {
        
    }

    /**
     * Handle the updating event
     * 
     * @param \App\Models\User
     */
    public function updating(User $user)
    {
        if ($user->isDirty('username')) {
            if (User::where('username', $user->username)->first()) {
                Session::flash('error', 'This username already exists, please choose a different one');
                return false;
            }
        }

        if ($user->isDirty('email')) {
            if (User::where('email', $user->email)->first()) {
                Session::flash('error', 'This email already exists, please choose a different one');
                return false;
            }
        }
    }
}
