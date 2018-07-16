<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'last_login'];

    protected $hidden = ['password', 'api_token'];

    public function notes()
    {
        return $this->hasMany(Note::class, 'author_id');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Return a unique personal access token.
     *
     * @return String
     */
    public function generateApiToken(): string
    {
        do {
            $api_token = str_random(60);
        } while (User::where('api_token', $api_token)->exists());

        return $api_token;
    }
}
