<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\StoreJournalRequest;

use App\Models\Journal;
use App\Models\User;

class JournalController extends Controller
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
        $journals = Journal::where('user_id', Auth::user()->id)->get();

        $data = [
            'title'    => 'Journals',
            'page'     => 'journals',
            'journals' => $journals,
        ];

        return view('journals.index')->with($data);
    }

    /**
     * Show view for creating a new Journal
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View 
    {
        $data = [
            'title' => 'Create Journal'
        ];

        return view('journals.create')->with($data);
    }

    /**
     * Store a Journal
     * 
     * @param \App\Http\Requests\StoreJournalRequest
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreJournalRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $journal = new Journal();

        $journal->name    = $request->name;
        $journal->user_id = $user->id;
        $journal->locked  = $request->locked;

        $journal->save();

        return redirect()->route('journals')->with('status', 'Journal created!');
    }

       /**
     * Show detail view of a journal
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function detail($id)
    {
        $journal = Journal::findOrFail($id);

        if (!Auth::user()->isAllowedToJournal($journal)) {
            return redirect()->route('home');
        }
        
        $entries = $journal->entries;        

        $data = [
            'title'   => $journal->name,
            'journal' => $journal,
            'entries' => $entries,
        ];

        return view('journals.detail')->with($data);
    }
}
