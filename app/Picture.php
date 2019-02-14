<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'bar_pictures';

    public function bar(){
        return $this->belongsTo(Bar::class);

    }
}
