<?php
namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Bar;
use Illuminate\Support\Facades\Auth;

class BarsController extends Controller
{
	public function index()
	{
		$bars = Bar::orderBy('bars.beer_rating', 'desc')->get();
		$data = [
		'bars' => $bars
		];
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
        $v = Validator::make($request->all(), Bar::$rules);
        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v);
        }
		$bar = new Bar();
		$bar->name = $request->get('name');
		$bar->address = $request->get('address');
		$bar->phone = $request->get('phone');
		$bar->website = $request->get('website');
		$bar->email = $request->get('email');
		$bar->save();


		$barfeatures = new Feature();
		$barfeatures->bar_id = $bar->id;
		$barinput = $request->input('features');
		$barinput = explode(',', $barinput);

		foreach($barinput as $key => $feature){
			$barfeatures->$feature = 1;
		}
		$barfeatures->save();
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
        $v = Validator::make($request->all(), Bar::$rules);
        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v);
        }
        $bar->name = $request->get('name');
        $bar->address = $request->get('address');
        $bar->phone = $request->get('phone');
        $bar->website = $request->get('website');
        $bar->email = $request->get('email');
        $bar->save();

        $barfeatures = Feature::where('bar_id', '=', $bar->id);
        $barfeatures->delete();
        $barfeatures = new Feature();
        $barfeatures->bar_id = $bar->id;
        $barinput = $request->input('features');
        $barinput = explode(',', $barinput);

        foreach($barinput as $key => $feature){
            $barfeatures->$feature = 1;
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

	public function search(Request $request)
	{
		$searchTerm = $request->input('searchTerm');
		$features = $request->input('features');
		$features = explode(',', $features);
		$bars = Bar::searchBy($searchTerm, $features);
		$bars = $bars->orderBy('bars.beer_rating', 'desc')->get();
		$data = [
		'bars' => $bars
		];
		return view('bars.results', $data);
	}

	public function discover() {
		$barCount = Bar::all()->count();
		if(!$barCount) {
            session()->flash('fail', 'We don\'t have any bars yet!');
            return redirect()->action('BarsController@index');
        }
		$randomBar = mt_rand(1, $barCount);
		$bar = Bar::find($randomBar);
		$data = [
			'randomBar' => $randomBar,
			'bar' => $bar
		];
		return view('bars.show', $data);
	}
}

