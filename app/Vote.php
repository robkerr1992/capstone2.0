<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    public function review(){
        return $this->belongsTo(Review::class);

    }
    public function user(){
        return $this->belongsTo(User::class);

    }

}
