<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'bar_features';

    private $labels = [
    	'smoking' => 'Smoking allowed',
    	'food' => 'Kitchen',
    	'pet_friendly' => 'Pet friendly',
    	'live_music' => 'Live music',
    	'tvs' => 'Tvs',
    	'18+' => '18+',
    	'patio' => 'Outside seating',
    	'pool' => 'Pool tables',
    	'darts' => 'Darts',
        'games' => 'Games',
    ];

    public function bar()
    {
        return $this->belongsTo(Bar::class, 'bar_id');

    }
    public function featureIcons() 
    {
    	$icons = [];
    	foreach ($this->labels as $feature => $label) {
    		if ($this->attributes[$feature] ==  1) {
    			$icons[] = $label;
    		}
    	}
    	return implode('<br>', $icons);
    }
}
