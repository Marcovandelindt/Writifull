<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\JournalEntry;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'locked', 
    ];

    /**
     * Get entries belonging to a journal
     */
    public function entries()
    {
        return $this->hasMany(JournalEntry::class, 'journal_id');
    }

    /**
     * Get user belonging to a journal
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
