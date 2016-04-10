<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Session\Store as SessionStore;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use App\Customer;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Hash;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function getLogin(){
		return view('auth.login');
	}

	public function postLogin(LoginRequest $request){
		// create our user data for the authentication
		$userdata = array(
			'username' => $request->username,
			'password' => $request->password,
		);
		$chkRemember = $request->chkRemember;
		if($chkRemember == 'on')
			$r = true;
		else
			$r = false;
		// attempt to do the login
		if ($this->auth->attempt($userdata, $remember = $r)) {
//			return view('pages.index');
			return redirect()->intended('/');
		}
		else{
			return redirect('auth/login')->with('message', 'Đăng nhập không thành công, vui lòng thử lại!!!')->with('alert-class', 'alert-danger');
		}
	}

	public function logout() {
		$this->auth->logout();
		return redirect('/');
	}

	public function getRegister(){
		return view('auth.register');
	}

	public function postRegister(RegisterRequest $request){
		$customer = new Customer;
		$customer->name = $request->name;
		$customer->address = $request->address;
		$customer->phone = $request->phone;
		$check = $customer->save();

		if($check) {
			$user = new User;
			$user->username = $request->username;
			$user->password = Hash::make($request->password);
			$user->email = $request->email;
			$user->remember_token = $request->_token;
			$user->userable_id = $customer->id;
			$user->userable_type = 'customer';
			$check = $user->save();
		}

		if($check){
			$userdata = array(
				'username' => $request->username,
				'password' => $request->password,
			);
			if ($this->auth->attempt($userdata)) {
				return redirect()->intended('/');
			}
			else{
				return redirect('auth/login')->with('message', 'Đăng nhập không thành công, vui lòng thử lại!!!')->with('alert-class', 'alert-danger');;
			}
		}
		else{
			return redirect('auth/register')->with('alert-class', 'alert-danger')->with('message', 'Đăng ký không thành công, vui lòng thử lại!!!');
		}
	}
}
