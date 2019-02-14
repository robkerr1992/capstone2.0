<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public static $rules =
        [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:244|unique:users',
            'password' => 'required|between:6,60|confirmed'
        ];
    public static $updateRules =
        [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:244'
        ];

    public static $passwordRules = [
        'password' => 'required|between:6,60|confirmed'
    ];

    public static function isEmailDuplicate($email) {
        return User::where('email', $email)->count()>0;
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function reviews(){
        return $this->hasMany(Review::class, 'created_by');

    }

    public function bars(){
        return $this->hasMany(Bar::class, 'owner_id');

    }

    public function events(){
        return $this->hasMany(Event::class, 'created_by');

    }

    public function votes(){
        return $this->hasMany(Vote::class, 'user_id');

    }
////////////////
    public function gameplans(){
        return $this->hasMany(Gameplan::class, 'author_id');

    }
///////////////


    public static function searchBy($searchTerm)
    {
        $query = static::where('users.first_name', 'LIKE', "%$searchTerm%")
            ->orWhere('users.last_name', 'LIKE', "%$searchTerm%");

        return $query;
    }
    public function formatLastName()
    {
        $formattedLastName = substr($this->last_name, 0, 1);
        return $formattedLastName;
    }
    public function totalUserVotes()
    {
        $totalVotes = 0;
        foreach($this->reviews as $reviews) {
            $totalVotes += $reviews->totalVotes();
        }
        return $totalVotes;
    }
}
