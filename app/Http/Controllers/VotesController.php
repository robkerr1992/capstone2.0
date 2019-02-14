<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vote;
use App\Review;
use Log;
use Auth;

class VotesController extends Controller
{
	public function vote(Request $request)
	{   
		if (Auth::check()) {

			if ($request->ajax()) {
				$review = $request->input('review');
				$vote = $request->input('vote');
				$user = Auth::user()->id;

								// Grab the vote if it already exists.
				$entry = Vote::where('user_id', $user)->where('review_id', $review)->first();
				if ($entry) {
					$entry->vote = $vote;
					$entry->save();
					$review = Review::find($review);
					return [$review->totalVotes(), $review->id];
				} else {
					$entry = new Vote;
					$entry->user_id = $user;
					$entry->review_id = $review;
					$entry->vote = $vote;
					$entry->save();
					$review = Review::find($review);
					return [$review->totalVotes(), $review->id];
				}
			} else {
				Log::info("Not an AJAX request");
				abort(404);
			}
		} else {
			Log::info("User is not logged in");
			abort(404);
		}
	}
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
				//
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
				//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
				//
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
				//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
				//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		{
				//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
				//
		}
	}
