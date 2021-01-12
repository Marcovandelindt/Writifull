<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Models\User;

class FriendsController extends Controller
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
            'title' => 'Friends',
            'page'  => 'friends'
        ];

        return view('friends.index')->with($data);
    }

    /**
     * Show the requests view
     * 
     * @return \Illuminate\View\View
     */
    public function showRequests()
    {
        $requests = Auth::user()->getFriendRequests();
        $pending  = Auth::user()->getPendingFriendRequests();

        $data = [
            'title'    => 'Friend Requests',
            'page'     => 'requests',
            'requests' => $requests,
            'pending'  => $pending,
        ];

        return view('friends.requests')->with($data);
    }

    /**
     * Accept a friend request
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFriend($id): RedirectResponse
    {
        $user = User::findOrFail($id);

        # Check if any friend requests are already pending
        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()
                ->route('users', ['id' => $user->id])
                ->with('status', 'Friend request already waiting approval!');
        }

        # Check if users are not already friends
        if (Auth::user()->isFriendsWith($user)) {
            return redirect()
                ->route('users', ['id' => $user->id])
                ->with('status', 'You and ' . $user->name . ' are already friends');
        }

        # Send friend request
        Auth::user()->sendFriendRequest($user);

        return redirect()
            ->route('users', ['id' => $user->id])
            ->with('status', 'You have successfully send a friend request to ' . $user->name . '!');
    }
}
