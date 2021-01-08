<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->userService = new UserService;
    }

    /**
     * Index action
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function index($id): View
    {
        $user = User::findOrFail($id);

        $entries = $this->userService->getJournalEntries($user);

        $data = [
            'title'   => 'Profile - ' . $user->name,
            'page'    => 'user',
            'user'    => $user,
            'entries' => $entries,
        ];

        return view('users.index')->with($data);
    }
}
