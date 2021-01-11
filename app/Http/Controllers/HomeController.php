<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
use App\Models\JournalEntry;
use App\Models\Journal;
use App\Services\JournalEntryService;

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

        $this->journalEntryService = new JournalEntryService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $journalEntries = $this->journalEntryService->getAllJournalEntriesToShow(Auth::user());

        $data = [
            'title'          => 'Home',
            'page'           => 'home',
            'journalEntries' => $journalEntries,

        ];

        return view('home.index')->with($data);
    }
}
