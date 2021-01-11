<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

use App\Http\Requests\StoreJournalEntryRequest;

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
    public function index($journal_id): View
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
    public function store($journalId, StoreJournalEntryRequest $request): RedirectResponse
    {
        $journal = Journal::findOrFail($journalId);

        $journalEntry = new JournalEntry();

        $journalEntry->title      = Crypt::encrypt($request->title);
        $journalEntry->body       = Crypt::encrypt($request->body);
        $journalEntry->user_id    = Auth::user()->id;
        $journalEntry->journal_id = $journal->id;
        $journalEntry->locked     = $request->locked;

        $journalEntry->save();

        return redirect()->route('journals.detail', ['id' => $journal->id])->with('status', 'Journal successfully created');
    }
    
    /**
     * Show the dit view for a journal entry
     * 
     * @param int $journalId
     * @param int $entryId
     * 
     * @return \Illuminate\View\View
     */
    public function edit($journalId, $entryId): View
    {
        $journal = Journal::findOrFail($journalId);

        $journalEntry = JournalEntry::findOrFail($entryId);

        $data = [
            'title'        => 'Edit - ' . $journalEntry->title,
            'journal'      => $journal,
            'journalEntry' => $journalEntry,
        ];

        return view('journalEntries.edit')->with($data);
    }

    /**
     * Update a journal entry
     * 
     * @param int $journalId
     * @param int $entryId
     * @param \App\Http\Requests\StoreJournalEntryRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($journalId, $entryId, StoreJournalEntryRequest $request): RedirectResponse
    {
        $journal = Journal::findOrFail($journalId);

        $journalEntry = JournalEntry::findOrFail($entryId);

        $journalEntry->title  = $request->title;
        $journalEntry->body   = $request->body;
        $journalEntry->locked = $request->locked;

        $journalEntry->save();

        return redirect()->route('journal.entry.edit', ['journal_id' => $journal->id, 'entry_id' => $journalEntry->id])->with('status', 'Entry successfully edited');
    }

    /**
     * Delete a JournalEntry
     * 
     * @param int $entryId
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($entryId): RedirectResponse
    {
        $journalEntry = JournalEntry::findOrFail($entryId);
    
        $journal = Journal::findOrFail($journalEntry->journal_id);

        $journalEntry->delete();

        return redirect()->route('journals.detail', ['id' => $journal->id])->with('status', 'Journal entry successfully deleted');
    }
}
