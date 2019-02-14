<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bar;
use Illuminate\Support\Facades\Auth;
use App\Event;

class EventsController extends Controller
{

    public function index()
    {
		$data['events'] = Event::orderDesc(10);
		$data['upcomingEvents'] = Event::upcomingEvents()->get();
		return view ('events.index', $data);
    }

    public function create(Request $request)
    {
    	if (!Auth::check()) {
    		return view('auth.login');
		}
		return view('events.create', ['id' => $request->get('bar_id')]);
    }

    public function store(Request $request)
    {
		session()->flash('fail', 'Your event was NOT created. Please fix errors.');
		$this->validate($request, Event::$rules);

		$event = new Event();
		$event->bar_id = $request->get('bar_id');
		$event->title = $request->get('title');
		$event->date = $request->get('date');
		$event->content = $request->get('content');
		//Alan Likes this upload image if statement!! good job
		if ($request->file('image')) {
			$imagePath = 'img/';
			$imageExtension = $request->file('image')->getClientOriginalExtension();
			$imageName = uniqid() . '.' . $imageExtension;
			$request->file('image')->move($imagePath, $imageName);
			$event->event_pic = '/img/' . $imageName;
		}
		$event->created_by = Auth::user()->id;
		$event->save();
		session()->flash('success', 'Your event was created successfully!');
		return redirect()->action('EventsController@show', $event->id);
    }

    public function show($id)
    {
		$event = Event::find($id);
		if (!$event) {
			abort(404);
		}
		$data = [
			'event' => $event
		];
		return view('events.show', $data);
    }

    public function edit($id)
    {
		if (!Auth::check()) {
			return view('auth.login');
		}
		$event = Event::find($id);
		if (!$event) {
			abort(404);
		}
		$data = [
			'event' => $event
		];
		return view('events.edit', $data);
    }

    public function update(Request $request, $id)
    {
		session()->flash('fail', 'Your event was NOT updated. Please fix errors.');
		$this->validate($request, Event::$rules);

		$event = Event::find($id);
		if (!$event) {
			abort(404);
		}
		$event->title = $request->get('title');
		$event->date = $request->get('date');
		$event->content = $request->get('content');
		if ($request->file('image')) {
			$imagePath = 'img/';
			$imageExtension = $request->file('image')->getClientOriginalExtension();
			$imageName = uniqid() . '.' . $imageExtension;
			$request->file('image')->move($imagePath, $imageName);
			$event->event_pic = '/img/' . $imageName;
		}
		$event->save();
		session()->flash('success', 'Your was updated successfully!');
		return redirect()->action('EventsController@show', $event->id);
    }

    public function destroy(Request $request, $id)
    {
		$event = Event::find($id);
		if (!$event) {
			abort(404);
		}
		$event->delete();
		$request->session()->flash('success', 'Your event was deleted successfully!');
		return redirect()->action('EventsController@index');
    }
}
