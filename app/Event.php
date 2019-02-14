<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $table = 'events';

	public static function orderDesc($item) {
		return Event::with('user')->orderBy('created_at', 'desc')->paginate($item);
	}

	public function getDateAttribute($value) {
		$utc = new Carbon($value);
		return $utc;
	}

	public static $rules =
		[
			'title' => 'required|max:50',
			'date' => 'required',
			'content' => 'required|max:255'
		];

    public function user(){
        return $this->belongsTo(User::class, 'created_by');

    }

    public function bar(){
        return $this->belongsTo(Bar::class, 'bar_id');

    }

    public static function upcomingEvents()
    {
    	$currentDate = Carbon::now();
    	return Event::where('date', '>=', $currentDate)->orderBy('date', 'asc');
    }
}
