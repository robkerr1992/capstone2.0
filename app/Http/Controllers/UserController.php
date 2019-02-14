<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function index()
    {
        return view ('users.index');
    }

    public function show($id)
    {
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}
		$reviews = Review::where('created_by', $id)->orderBy('created_at')->get();

		$data = [
			'user' => $user,
			'reviews' => $reviews
		];
		return view('users.show', $data);
    }

    public function edit($id)
    {
		if (!Auth::check() || Auth::user()->id != $id) {
			return redirect()->action('BarsController@index');
		}
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}

		$data = [
			'user' => $user
		];
		return view('users.edit', $data);
    }

    public function update(Request $request, $id)
    {
		if (!Auth::check()) {
			return view('auth.login');
		}
		session()->flash('fail', 'Your information was NOT updated. Please fix errors.');
		$v = Validator::make($request->all(), User::$updateRules);
		$v->sometimes('email', 'required|email|max:244|unique:users', function($input) use($id) {
			return User::find($id)->email !== $input->email;
		});
		if ($v->fails()) {
			return redirect()->back()->withInput()->withErrors($v);
		}
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}

		$user->first_name = $request->input('first_name');
		$user->last_name = $request->input('last_name');
		$user->email = $request->input('email');
		if ($request->file('image')) {
			$imagePath = 'img/';
			$imageExtension = $request->file('image')->getClientOriginalExtension();
			$imageName = uniqid() . '.' . $imageExtension;
			$request->file('image')->move($imagePath, $imageName);
			$user->avatar = '/img/' . $imageName;
		}
		$user->save();
		session()->flash('success', 'Your information was updated successfully!');
		return redirect()->action('UserController@show', $user->id);
    }

	public function editPassword($id)
	{
		$user = User::find($id);
		if (!$user) {
			abort(404);
		} elseif ($user->id != \Auth::user()->id) {
			return redirect()->action('BarsController@index');
		}

		$data = [
			'user' => $user
		];
		return view('users.password', $data);
	}

	public function updatePassword(Request $request, $id) {
		session()->flash('fail', 'Your password was NOT updated. Please fix errors.');
		$this->validate($request, User::$passwordRules);
		$user = User::find($id);
		if (!$user) {
			abort(404);
		}
		$user->password = Hash::make($request->input('password'));
		$user->save();
		session()->flash('success', 'Your password was updated successfully!');
		return redirect()->action('UserController@show', $user->id);
	}

    public function destroy($id)
    {
		$user = User::find($id);
		$user->delete();
		// Do we want to delete the user reviews if account is deleted?
		$reviews = Review::where('created_by', $id)->orderBy('created_at');
		$reviews->delete();
		//
		session()->flash('success', 'Your account was deleted successfully!');
		return redirect()->action('BarsController@index');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $data = User::searchBy($searchTerm);
        $data->orderBy('first_name', 'asc');
        return view('users.index')->with('data', $data);
//        need a users index plz and ty

    }
}
