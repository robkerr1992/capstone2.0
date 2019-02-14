<?php

namespace App\Http\Controllers;

use App\Gameplan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bar;
use App\Event;
use App\Feature;
use App\Picture;
use App\Review;
use App\Special;
use App\User;
use App\Vote;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['bar'] = Bar::with('pictures', 'reviews', 'specials', 'features', 'events')->get();
        $data['review'] = Review::with('votes', 'user', 'bar')->get();
        $data['event'] = Event::with('bar')->get();
        $data['upcomingEvents'] = Event::upcomingEvents()->get();
        $data['highestRated'] = Bar::highestRated()->get();
        return view('index', $data);

    }

    public function recent()
    {
        $bars = Bar::with('pictures')->limit(10)->orderBy('created_at', 'desc')->get();
        $events = Event::limit(10)->orderBy('created_at', 'desc')->get();
        $specials = Special::limit(10)->orderBy('created_at', 'desc')->get();
        $gameplans = Gameplan::limit(10)->orderBy('created_at', 'desc')->get();
        $recent['bars'] = $bars;
        $recent['events'] = $events;
        $recent['specials'] = $specials;
        $recent['gameplans'] = $gameplans;
//        $recent = Bar::recentBarsSpecialsEvents();
        $data = [
            'recent' => $recent
        ];
        return view('recent', $data);
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
