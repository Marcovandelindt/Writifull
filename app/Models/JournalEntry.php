<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Journal;

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
}
