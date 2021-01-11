<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJournalEntryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Journal;
use App\Models\JournalEntry;

class JournalEntryController extends Controller
{
    /**
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index action 
     * 
     * @param int $journal_id
     * 
     * @return \Illuminate\View\View
     */
    public function index($journal_id)
    {
        $journal = Journal::findOrFail($journal_id);

        $data = [
            'title'   => 'New entry - ' . $journal->name,
            'journal' => $journal,
        ];

        return view('journalEntries.create')->with($data);
    }

    /**
     * Store a new journal entry
     * 
     * @param int $journal_id
     * @param \App\Http\Requests\StoreJournalEntryRequest
     */
    public function store($journalId, StoreJournalEntryRequest $request)
    {
        $journal = Journal::findOrFail($journalId);

        $journalEntry = new JournalEntry();

        $journalEntry->title      = $request->title;
        $journalEntry->body       = $request->body;
        $journalEntry->user_id    = Auth::user()->id;
        $journalEntry->journal_id = $journal->id;

        $journalEntry->save();

        return redirect()->route('journals.detail', ['id' => $journal->id])->with('status', 'Journal successfully created');
    }
}
