<?php
namespace App\Http\Controllers;

use App\Feature;
use Geocoder\Provider\GoogleMaps;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bar;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;
use Illuminate\Support\Facades\Auth;

class BarsController extends Controller
{
	public function index()
	{
		$bars = Bar::orderBy('bars.beer_rating', 'desc')->get();
		$data = [
		'bars' => $bars
		];
//        dd($data);
		return view ('bars.index', $data);
	}

	public function create()
	{
		if (!Auth::check()) {
			return view('auth.login');
		}
		return view('bars.create');
	}

	public function store(Request $request)
	{
		session()->flash('fail', 'Your post was NOT created. Please fix errors.');
//        dd($request);
		$this->validate($request, Bar::$rules);
		$adapter  = new Guzzle6HttpAdapter();
		$geocoder = new GoogleMaps($adapter);
		$bar = new Bar();
//		$bar->type = $request->get('type');
		$bar->name = $request->get('name');
		$bar->address = $request->get('address');
        ///latlong stuff
		$latlong = $geocoder->geocode($bar->address)->first();
		$bar->latitude = $latlong->getLatitude();
		$bar->longitude = $latlong->getLongitude();
        //dd($latlong->getLatitude(), $latlong->getLongitude());
		$bar->phone = $request->get('phone');
		$bar->website = $request->get('website');
		$bar->email = $request->get('email');
		$bar->save();
//         features ======================================
		$barfeatures = new Feature();
		$barfeatures->bar_id = $bar->id;

		$features = Feature::find(1)->get();
		$features = $features[0]['attributes'];
		$barinput = $request->input('features');
		$barinput = explode(',', $barinput);
		$barinput['constant'] = $barinput[0];
		unset($barinput[0]);

		array_pop($features);
		array_pop($features);
		array_shift($features);
		array_shift($features);
		foreach($features as $feature => $data){
			$barfeatures->$feature = (array_search($feature,$barinput) ? 1 : 0);
		}

		$barfeatures->save();
//        dd($barfeatures, $bar);

		session()->flash('success', 'Your post was created successfully!');
		return redirect()->action('BarsController@show', $bar->id);
	}
	public function show($id)
	{

		$bar = Bar::find($id);
		if (!$bar) {
			abort(404);
		}
		$data = [
		'bar' => $bar
		];
		return view('bars.show', $data);
	}

	public function edit($id)
	{
		if (!Auth::check()) {
			return view('auth.login');
		}
		$bar = Bar::find($id);
		if (!$bar) {
			abort(404);
		}
		$data = [
		'bar' => $bar
		];
		return view('bars.edit', $data);
	}

	public function update(Request $request, $id)
	{
		$bar = Bar::find($id);
		if (!$bar) {
			abort(404);
		}
		session()->flash('fail', $bar->name . ' was NOT updated. Please fix errors.');
		$this->validate($request, Bar::$rules);
		$adapter  = new Guzzle6HttpAdapter();
		$geocoder = new GoogleMaps($adapter);
//		$bar->type = $request->get('type');
		$bar->name = $request->get('name');
		$bar->address = $request->get('address');
        ///latlong stuff
		$latlong = $geocoder->geocode($bar->address)->first();
		$bar->latitude = $latlong->getLatitude();
		$bar->longitude = $latlong->getLongitude();
        //dd($latlong->getLatitude(), $latlong->getLongitude());
		$bar->phone = $request->get('phone');
		$bar->website = $request->get('website');
		$bar->email = $request->get('email');
		$bar->save();
//        features ==================================
		$barfeatures = Feature::where('bar_id', '=', $bar->id);
		$barfeatures->delete();
//        dd($barfeatures);
		$barfeatures = new Feature();
		$barfeatures->bar_id = $bar->id;
		$features = Feature::find(1)->get();
		$features = $features[0]['attributes'];
		$barinput = $request->input('features');
		$barinput = explode(',', $barinput);
		$barinput['constant'] = $barinput[0];
		unset($barinput[0]);

		array_pop($features);
		array_pop($features);
		array_shift($features);
		array_shift($features);
		foreach($features as $feature => $data){
			$barfeatures->$feature = (array_search($feature,$barinput) ? 1 : 0);
		}

		$barfeatures->save();
		session()->flash('success', $bar->name . ' was updated successfully!');
		return redirect()->action('BarsController@show', $bar->id);
	}

	public function destroy(Request $request, $id)
	{
		$bar = Bar::find($id);
		if (!$bar) {
			abort(404);
		}
		$bar->delete();
		$request->session()->flash('success', $bar->name . ' was deleted successfully!');
		return redirect()->action('BarsController@index');
	}

	public function nearby($latitude, $longitude)
	{
		$bars = Bar::all();
		$data = [];
		$distanceInMiles = [];
		foreach($bars as $bar)
		{
			$distance = $bar->getDistance($latitude, $longitude, $bar->latitude, $bar->longitude);
//            dd($distance);
			if($distance<3){
				$data[] = $bar;
				$distanceInMiles[] = $distance;
			}
		}
		$data = [
		'bars' => $data,
		'distance' => $distanceInMiles,
		];
//		dd($data);
		return view('bars.results', $data);
	}

	public function search(Request $request)
	{
		$searchTerm = $request->input('searchTerm');
		$features = $request->input('features');
		$features = explode(',', $features);
		$bars = Bar::searchBy($searchTerm, $features);
		$bars = $bars->orderBy('bars.beer_rating', 'desc')->get();
//        dd($bars);
		$data = [
		'bars' => $bars
		];
		return view('bars.results', $data);
	}

	public function discover() {
		$barCount = Bar::all()->count();
		$randomBar = mt_rand(1, $barCount);
		$bar = Bar::find($randomBar);
		$data = [
			'randomBar' => $randomBar,
			'bar' => $bar
		];
		return view('bars.show', $data);
	}
//
//	public function recent()
//	{
//		$recent = Bar::recentBarsSpecialsEvents();
//        $data = [
//		'recent' => $recent
//		];
//		return view('recent', $data);
//	}
}

