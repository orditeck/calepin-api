<?php

namespace App\Observers;

use App\Note;

class NoteObserver
{
    /**
     * Listen to the creating event.
     *
     * @param Note $note
     * @return void
     */
    public function creating(Note $note)
    {
        $note->id = $note->generateUuid();
    }
}
