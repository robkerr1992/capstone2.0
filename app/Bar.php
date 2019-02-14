<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bar extends Model
{
	protected $table = 'bars';

    public static $rules =
    [
    'name' => 'required|max:50',
	// 'type' => 'required|max:255',
    'address' => 'required|max:255',
    'email' => 'email|max:244|unique:users',
    'phone' => 'min:7|max:10',
    ];

	public function events()
	{
		return $this->hasMany(Event::class, 'bar_id');

	}

	public function specials()
	{
		return $this->hasMany(Special::class, 'bar_id');

	}

	public function pictures()
	{
		return $this->hasMany(Picture::class, 'bar_id');

	}

	public function features()
	{
		return $this->hasMany(Feature::class, 'bar_id');

	}

	public function reviews()
	{
		return $this->hasMany(Review::class, 'bar_id');

	}

	public static function barOptions()
	{
		$bars = Bar::all();
		$bars = $bars->pluck('name', 'id');
		return $bars;
	}

	public function getDistance($userLat, $userLon, $barLat, $barLon)
	{
//      earth radius in miles
		$earth_radius = 3960;

		$dLat = deg2rad($barLat - $userLat);
		$dLon = deg2rad($barLon - $userLon);

		$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($userLat)) * cos(deg2rad($barLat)) * sin($dLon / 2) * sin($dLon / 2);
		$c = 2 * asin(sqrt($a));
		$distance = $earth_radius * $c;

		return $distance;
	}

	public static function searchBy($searchTerm, $features)
	{
//        dd($features);
		$query = static::join('bar_features', 'bar_features.bar_id', '=', 'bars.id')->where('bars.name', 'LIKE', "%$searchTerm%");
		if ($features[0] != '') {
			foreach ($features as $key => $feature) {
				$query = $query->where("bar_features.$feature", '=', 1);
			}
		}
		return $query;
	}


//    public static function recentBarsSpecialsEvents()
//    {
//        //change limit to increase results
//        // infinite scroll??
//        $bars = Bar::limit(10)->orderBy('created_at', 'desc')->get();
//        $events = Event::limit(10)->orderBy('created_at', 'desc')->get();
//        $specials = Special::limit(10)->orderBy('created_at', 'desc')->get();
//        $recent['bars'] = $bars;
//        $recent['events'] = $events;
//        $recent['specials'] = $specials;
//        return $recent;
//    }

	public function averageBarRating()
	{
		$averageRating = round($this->beerRating());

		switch ($averageRating) {
			// cant decide to use unicode characters with css styling or stick to <i> tags
			case 0:
			$starRating = '';
			break;
			case 1:
			$starRating = '&#xf005;';
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

	public function beerRating()
	{
		return $this->reviews()->avg('beer_rating');
	}

	public function formatPhoneNumber()
	{
		$formatNumber = '';
		if (strlen($this->phone) == 7) {
			$formatNumber = substr($this->phone, 0, 3) . '-' . substr($this->phone, 3);
		} elseif (strlen($this->phone) == 10) {
			$formatNumber = '(' . substr($this->phone, 0, 3) . ') ' . substr($this->phone, 3, 3) . '-' . substr(($this->phone), 6);
		} elseif (strlen($this->phone) !== 10 && strlen($this->phone) !== 7) {
			$formatNumber = $this->phone;
		}
		return $formatNumber;
	}
	public static function highestRated()
	{
		return static::orderBy('beer_rating', 'desc')->take(5);
	}
}
