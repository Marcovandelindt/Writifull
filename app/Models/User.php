<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
Use Illuminate\Support\Facades\DB;

use App\Models\Journal;
use App\Models\JournalEntry;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username', 
        'birth_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get journals belonging to the user
     */
    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    /**
     * Get the journal entries belonging to the user
     */
    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    /**
     * Get the users friends
     */
    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    /**
     * Check whether the current user is friends with another user
     */
    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    /**
     * Get friends
     */
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', 1)->get()->merge($this->friendOf()->wherePivot('accepted', 1)->get());
    }

    /**
     * Get the profile picture
     * 
     * @return string
     */
    public function getProfilePicture(): string 
    {
        $image = '';

        if (!empty($this->image)) {
            $image = asset('images/profile-pictures/' . $this->image);    
        } else {
            $image = 'https://via.placeholder.com/150';
        }

        return $image;
    }

    /**
     * Get the journal entries from a friend
     */
    public function getFriendJournalEntries()
    {
        $journalEntries = DB::table('users')
                                ->join('journals', 'journals.user_id', '=', 'users.id')
                                ->join('journal_entries', 'journal_entries.journal_id', '=', 'journals.id')
                                ->select('journal_entries.*')
                                ->where('journals.locked', '=', '0')
                                ->where('journal_entries.locked', '0')
                                ->get();

        return $journalEntries;
    }

    /**
     * Check if the currently authenticated user is allowed to see the journal
     * 
     * @param \App\Models\Journal $journal
     */
    public function isAllowedToJournal(Journal $journal)
    {
        if ($journal->user_id == $this->id) {
            return true;
        }

        return false;
    }

    /**
     * Check if the currently authenticated user is allowed to see the journal entry
     * 
     * @param \App\Models\JournalEntry $journal
     */
    public function isAllowedToJournalEntry(JournalEntry $journalEntry)
    {
        if ($journalEntry->user_id == $this->id) {
            return true;
        }

        return false;
    }
}
