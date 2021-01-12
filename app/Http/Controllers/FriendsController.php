<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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
}
