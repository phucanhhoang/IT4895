<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\User;
use App\Customer;
use App\Http\Requests\ChangePassRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function getAccount()
	{
		$accounts = User::where('userable_type', '!=', 'customer')->where('deleted', '=', 0)->orderBy('userable_type')->orderBy('username')->get();
		return view('admin.pages.account')->with('accounts', $accounts);
	}

	public function accountInfo(Request $request)
	{
		$account = User::findOrFail($request->id);

		return $account;
	}

	public function delAccount(Request $request)
	{
		$Account_IDs = json_decode(stripslashes($request->accountIds));
		$check = false;
		foreach ($Account_IDs as $id) {
			$user = User::find($id);
			if ($user->username == Auth::user()->username)
				return "Không thể xóa account \"" . $user->username . "\"";
			$user->deleted = 1;
			$check = $user->save();
			if ($check) {
				$customer = Customer::findOrFail($user->userable_id);
				$customer->deleted = 1;
				$check = $customer->save();
			} else break;
		}
		if ($check) {
			return "true";
		} else {
			return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		}
	}

	public function saveAccount(Request $request)
	{
		if ($request->account_id != "") {
			$user = User::find($request->account_id);
			if ($request->password != "") {
				$user->password = Hash::make($request->password);
			}
			$user->email = $request->email;
			$user->userable_type = $request->userable_type;
			$user->banned = $request->banned;
			$check = $user->save();
			if ($check)
				return "EDIT_SUCCEED";
			else
				return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		} else {
			$user = new User;
			$user->username = $request->username;
			$user->password = Hash::make($request->password);
			$user->email = $request->email;
			$user->userable_type = $request->userable_type;
			$check = $user->save();
			if ($check) {
				$data = array(
					'msg' => 'ADD_SUCCEED',
					'account_id' => $user->id
				);
				return $data;
			} else
				return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		}
	}

	public function checkUsername(Request $request)
	{
		$username = $request->username;
		$count = User::where('username', '=', $username)->count();
		if ($count > 0) {
			echo 'false';
		} else
			echo 'true';
	}

	public function checkEmail(Request $request)
	{
		$email = $request->email;
		$count = User::where('email', '=', $email)->count();
		if ($count > 0) {
			echo 'false';
		} else
			echo 'true';
	}

	public function getChangePass()
	{
		return view('auth.changepass');
	}

	public function postChangePass(ChangePassRequest $request)
	{
		if (Auth::check()) {
			if (Hash::check($request->cur_pass, Auth::user()->password)) {
				$user = Auth::user();
				$user->password = Hash::make($request->password);
				$check = $user->save();
				if ($check)
					return redirect()->away($request->rtn_url)
						->with('message', 'Đổi mật khẩu thành công.')
						->with('alert-class', 'alert-success')
						->with('fa-class', 'fa-check');
				else
					return redirect()->away($request->rtn_url)
						->with('message', 'Có lỗi xảy ra. Vui lòng thử lại sau!')
						->with('alert-class', 'alert-danger')
						->with('fa-class', 'fa-ban');
			} else
				return redirect('user/changepass')
					->with('message', 'Mật khẩu không đúng. Vui lòng thử lại!')
					->with('alert-class', 'alert-danger')
					->with('fa-class', 'fa-ban');
		} else
			return redirect('auth/login')
				->with('message', 'Bạn chưa đăng nhập. Vui lòng đăng nhập!')
				->with('alert-class', 'alert-warning')
				->with('fa-class', 'fa-warning');
	}
}