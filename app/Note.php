<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use PimpableTrait;

    protected $guarded = [];

    protected $fillable = [
        'title', 'content', 'language', 'private', 'encrypted'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
