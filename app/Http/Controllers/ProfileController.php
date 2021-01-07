<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
     * @param \Illuminate\Http\Reqeust $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = User::findOrFail(Auth::user()->id);
        
        $user->name       = $request->name;
        $user->username   = $request->username;
        $user->birth_date = $request->birth_date;

        $user->save();

        return redirect()->route('profile');
    }
}
