<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

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
}
