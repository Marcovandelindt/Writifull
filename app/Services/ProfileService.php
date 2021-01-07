<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Models\User;

class ProfileService 
{
    /**
     * Handle the image upload for a profile picture
     * 
     * @param \Illuminate\Http\UploadedFile $image
     * @param \App\Models\User
     * 
     * @return string
     */
    public function handleImageUploadForProfilePicture(UploadedFile $image, User $user): string
    {
        $name = time() . '_' . $user->id . '.' . $image->extension();
        $image->move(public_path('images') . '/profile-pictures', $name);

        return $name;
    }
}