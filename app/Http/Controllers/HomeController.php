<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
use App\Models\JournalEntry;
use App\Models\Journal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $journalEntries = [];

        foreach (JournalEntry::where('user_id', Auth::user()->id)->get() as $entry) {
            $journalEntries[] = $entry;
        }

        $data = [
            'title'          => 'Home',
            'page'           => 'home',
            'journalEntries' => $journalEntries,
        ];

        return view('home.index')->with($data);
    }
}
