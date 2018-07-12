<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Note extends Model
{
    use PimpableTrait;

    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = [
        'title', 'content', 'language', 'public', 'encrypted'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Return a unique uuid
     *
     * @return String
     */
    public function generateUuid(): string
    {
        do {
            $uuid = (string) Uuid::uuid4();
        } while (Note::where('id', $uuid)->exists());

        return $uuid;
    }
}
