<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Special extends Model
{
    protected $table = 'specials';

	public static function orderDesc($item) {
		return  Special::with('bar')->orderBy('created_at', 'desc')->paginate($item);
	}

	public function getDateAttribute($value) {
		$utc = Carbon::createFromFormat("Y-m-d", $value);
		return $utc->setTimezone('America/Chicago');
	}

	public static $rules =
		[
			'title' => 'required|max:255',
			'content' => 'required|max:500'
		];

    public function bar(){
        return $this->belongsTo(Bar::class);

    }

	public function user(){
		return $this->belongsTo(User::class, 'created_by');

	}
}
