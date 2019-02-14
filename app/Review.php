<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

	public static $rules =
		[
			'title' => 'required|max:50',
			'content' => 'required|max:255',
			'beer_rating' => 'required',
		];

    public function votes(){
        return $this->hasMany(Vote::class, 'review_id');

    }
    public function upvotes() 
    {
        return $this->votes()->where('vote', 1)->count();
    }

    public function downvotes() 
    {
        return $this->votes()->where('vote', 0)->count();
    }

    public function totalVotes() 
    {
        return $this->upvotes() - $this->downvotes();
    }

    public function hasBeenUpvoted()
    {
        return Auth::check() && !is_null($this->userVote(Auth::user())) && $this->userVote(Auth::user())->vote;
    }

    public function hasBeenDownvoted()
    {
        return Auth::check() && !is_null($this->userVote(Auth::user())) && !$this->userVote(Auth::user())->vote;
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');

    }

    public function bar(){
        return $this->belongsTo(Bar::class, 'bar_id');

    }

    public function beerRating()
    {
        $rating = $this->beer_rating;
        $starRating = '';
        switch ($rating) {
            // cant decide to use unicode characters with css styling or stick to <i> tags
            case 0:
            $starRating = '';
            break;
            case 1:
            $starRating = '<i class="fa fa-star" aria-hidden="true"></i>';
            break;
            case 2:
            $starRating = '&#xf005;&#xf005;';
            break;
            case 3:
            $starRating = '&#xf005;&#xf005;&#xf005;';
            break;
            case 4:
            $starRating = '&#xf005;&#xf005;&#xf005;&#xf005;';
            break;
            case 5:
            $starRating = '&#xf005;&#xf005;&#xf005;&#xf005;&#xf005;';
            break;
        }
        return $starRating;
    }
}
