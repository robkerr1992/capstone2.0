<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Gameplan extends Model
{
    protected $table = 'gameplans';

	public function getDateAttribute($value) {
		$utc = new Carbon($value);
		return $utc;
	}

	public function getTimeAttribute($value) {
		$utc = new Carbon($value);
		return $utc;
	}

    public function hoppers(){
        return $this->hasMany(Hopper::class, 'gameplan_id');

    }


    public function author(){
        return $this->belongsTo(User::class);

    }

    public function bars(){
        return $this->hasMany(GameplanBar::class, 'gameplan_id');

    }
}
