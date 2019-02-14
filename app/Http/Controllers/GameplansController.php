<?php

namespace App\Http\Controllers;

use App\Gameplan;
use App\GameplanBar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Bar;
use App\Hopper;

class GameplansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */


    public function index()
    {
        $gameplans = Gameplan::orderBy('date', 'asc')->paginate(5);
//        dd($gameplans);
        $data = [
            'gameplans' => $gameplans
        ];
//        dd($data);
        return view ('gameplans.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $bars = Bar::all();
//        $bars = $bars->pluck('name', 'id');
//        $bars = $bars->all();
//        dd($bars);
		if (!Auth::check()) {
			return view('auth.login');
		}
        $bars = Bar::barOptions();
        $data = [
            'bars' =>  $bars
        ];
        return view('gameplans.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->flash('fail', 'Your gameplan was NOT created. Please fix errors.');
//        dd($request);
//        $this->validate($request, Gameplan::$rules);
        // gameplan features //
        $gameplan = new Gameplan();
        $gameplan->author_id = Auth::id();
        $gameplan->date = $request->get('date');
        $gameplan->time = $request->get('time');
        $gameplan->title = $request->get('title');
        $gameplan->description = $request->get('description');
        $gameplan->save();
        $hopper = new Hopper();
        $hopper->hopper_id = Auth::id();
        $hopper->gameplan_id = $gameplan->id;
        $hopper->save();
        $bars = explode(',', $request->get('hidden-bar-input'));
        foreach($bars as $key => $bar){
            $gpbar = new GameplanBar();
            if($bar == ''){
                break;
            }
            $gpbar->gameplan_id = $gameplan->id;
            $gpbar->bar_id = $bar;
            $gpbar->save();
        }

        session()->flash('success', 'Your gameplan was created successfully!');
        return redirect()->action('GameplansController@show', $gameplan->id);
    }

    public function addHopper($gameplanid)
    {
        session()->flash('fail', 'You did NOT join the Gameplan. Please fix errors.');
        Model::unguard();
        $hopper = Hopper::firstOrCreate([
            'gameplan_id' => $gameplanid,
            'hopper_id' => Auth::id(),
        ]);
        $hopper->save();
        Model::reguard();
        return redirect()->action('GameplansController@show', $gameplanid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gameplan = Gameplan::find($id);
        if (!$gameplan) {
            abort(404);
        }
        $data = [
            'gameplan' => $gameplan
        ];
        return view('gameplans.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		if (!Auth::check()) {
			return view('auth.login');
		}
        $gameplan = Gameplan::find($id);
        $bars = Bar::barOptions();
        if (!$gameplan) {
            abort(404);
        }
        $data = [
            'gameplan' => $gameplan,
            'bars' => $bars
        ];
        return view('gameplans.edit', $data);
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
        session()->flash('fail', 'Gameplan ' . $id . ' was NOT updated. Please fix errors.');
//        $this->validate($request, Gameplan::$rules);
        $gameplan = Gameplan::find($id);
        if (!$gameplan) {
            abort(404);
        }
        $gameplan->date = $request->get('date');
		$gameplan->time = $request->get('time');
        $gameplan->title = $request->get('title');
        $gameplan->description = $request->get('description');
        $bars = explode(',', $request->get('hidden-bar-input'));
        $barsCollection = GameplanBar::where('gameplan_id', '=', $gameplan->id);
        $barsCollection->delete();
        foreach($bars as $key => $bar){
            $gpbar = new GameplanBar();
            if($bar == ''){
                break;
            }
            $gpbar->gameplan_id = $gameplan->id;
            $gpbar->bar_id = $bar;
            $gpbar->save();
        }
        $gameplan->save();
        session()->flash('success','Gameplan ' . $id . ' was updated successfully!');
        return redirect()->action('GameplansController@show', $gameplan->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gameplan = Gameplan::find($id);
        if(!$gameplan){
            Log::info("Post with ID $id cannot be found.");
            abort(404);
        }
        // must destroy all hoppers and bars if you want to delete a gameplan
        $hoppers = Hopper::where('gameplan_id', '=', $id);
        $gpbars = GameplanBar::where('gameplan_id', '=', $id);
        $hoppers->delete();
        $gpbars->delete();
        $gameplan->delete();
        session()->flash('message', 'Deletion Successful.');
        // figure out a good place to redirect
        return redirect()->action('HomeController@index');
    }
}
