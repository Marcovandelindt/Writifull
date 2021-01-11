<?php

namespace App\Services;

use App\Models\User;
use App\Models\Journal;
use App\Models\JournalEntry;

class JournalEntryService 
{
    public function getAllJournalEntriesToShow(User $user)
    {
        $mine = [];

        # Get journal entries of the current user
        foreach ($user->journals as $journal) {
            foreach ($journal->entries as $entry) {
                $mine[] = $entry;
            }
        }

        $friends = [];

        # Get friends entries
        foreach ($user->friends() as $friend) {
            foreach ($friend->journals as $journal) {
                if (!$journal->locked) {
                    foreach ($journal->entries as $entry) {
                        if (!$entry->locked) {
                            $friends[] = $entry;
                        }
                    }
                }
            }
        }

        # Merge user and friends entries together
        $entries = array_merge($mine, $friends);

        return $entries;
    }
}