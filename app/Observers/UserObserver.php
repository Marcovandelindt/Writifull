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
}
