<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Http\Requests\PostUserRequest;
use Illuminate\Support\Facades\Storage;

use App\Services\ProfileService;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->profileService = new ProfileService();
    }

    /**
     * Index action 
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View 
    {
        $data = [
            'title' => 'Profile - ' . Auth::user()->name,
            'page'  => 'profile'
        ];

        return view('profile.index')->with($data);
    }

    /**
     * Update the user's details
     * 
     * @param \App\Http\Reqeusts\PostUserRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUserRequest $request): RedirectResponse
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->name       = $request->name;
        $user->username   = $request->username;
        $user->birth_date = $request->birth_date;


        if ($request->image) {
            $image       = $this->profileService->handleImageUploadForProfilePicture($request->image, $user);
            $user->image = $image;
        }

        $user->save();

        return redirect()->route('profile');
    }
}
