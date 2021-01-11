<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Journal;
use Illuminate\Support\Facades\Crypt;

class JournalEntry extends Model
{
    use HasFactory;

    /**
     * Get the journal belonging to an entry
     */
    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    /**
     * Get the user beloning to an entry
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the title of a journal entry
     */
    public function getTitle()
    {
        return Crypt::decrypt($this->title);
    }

    /**
     * Get the body of a journal entry
     */
    public function getBody()
    {
        return Crypt::decrypt($this->body);
    }
}
