<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{

	public function index()
	{
		$reviews = Review::orderDesc(10);
		$data = [
			'reviews' => $reviews
		];
		return view ('reviews.index', $data);
	}

	public function create(Request $request)
	{
		return view('reviews.create', ['id' => $request->get('bar_id')]);
	}

	public function store(Request $request)
	{
		session()->flash('fail', 'Your post was NOT created. Please fix errors.');
		$this->validate($request, Review::$rules);
		$review = new Review();
		$review->title = $request->get('title');
		$review->content = $request->get('content');
		$review->created_by = Auth::user()->id;
		$review->beer_rating = $request->get('beer_rating');
		// Will change based on view
		$review->bar_id = $request->get('bar_id');
		$review->save();
        $bar = $review->bar;
        $bar->beer_rating = round($bar->beerRating());
        $bar->save();
		session()->flash('success', 'Your review was created successfully!');
		return redirect()->action('BarsController@show', $review->bar_id);
	}

	public function show($id)
	{
		$review = Review::find($id);
		if (!$review) {
			abort(404);
		}
		$data = [
			'review' => $review
		];
		return view('reviews.show', $data);
	}

	public function edit($id)
	{
		$review = Review::find($id);
		if (!$review) {
			abort(404);
		}
		$data = [
			'review' => $review
		];
		return view('reviews.edit', $data);
	}

	public function update(Request $request, $id)
	{
		session()->flash('fail', 'Your review was NOT updated. Please fix errors.');
		$this->validate($request, Review::$rules);

		$review = Review::find($id);
		if (!$review) {
			abort(404);
		}
		$review->title = $request->get('title');
		$review->date = $request->get('date');
		$review->content = $request->get('content');
		$review->review_pic = $request->get('review_pic');
		$review->save();
		session()->flash('success', 'Your was updated successfully!');
		return redirect()->action('ReviewsController@show', $review->id);
	}

	public function destroy(Request $request, $id)
	{
		$review = Event::find($id);
		if (!$review) {
			abort(404);
		}
		$review->delete();
		$request->session()->flash('success', 'Your review was deleted successfully!');
		return redirect()->action('ReviewsController@index');
	}
}
