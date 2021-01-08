<?php

namespace App\Services;

use App\Models\User;

class UserService 
{
    /**
     * Get journal entries for a user
     * 
     * @param \App\Models\User
     * 
     * @return array
     */
    public function getJournalEntries(User $user): array
    {
        $entries = [];

        foreach ($user->journals as $journal) {
            $entries[] = $journal->entries;
        }

        return $entries;
    }
}