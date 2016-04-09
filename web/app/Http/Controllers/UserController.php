<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class UserController extends Controller
{
	use AuthenticatesAndRegistersUsers;

	public function getLogin(){
		return view('login');
	}
    public function postLogin(Request $request) {

			// create our user data for the authentication
			$userdata = array(
				'username' => $request->input('username'),
				'password' => $request->input('password'),
			);
			// attempt to do the login
			if (Auth::attempt($userdata)) {

				// validation successful!
				// redirect them to the  section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				// $url_previous = Session::get("login_previous");
				// Session::forget("login_previous");
				// return Redirect::to($url_previous);
				echo "true";
				// return Redirect::back();
				// return Redirect::to(URL::previous()); //test

			} else {

				// validation not successful, send back to form
				// return Redirect::to('login');
				// $password = Hash::make(Input::get('password'));
				// echo json_encode($password);
				echo "false";
				// return view('login', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
				// Session::flash('error_login', 'Log In failed!!!');
				// return Redirect::back();
			}
	}

	public function logout() {
		Auth::logout();
    	return Redirect::away('login');
	}
}