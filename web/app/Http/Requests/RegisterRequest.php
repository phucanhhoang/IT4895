<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required',
			'username' => 'required|unique:users,username',
			'password' => 'required',
			'address' => 'required',
			'phone' => 'required',
			'email' => 'required|email|unique:users,email',
			'chkterms' => 'required'
		];
	}

	public function messages()
	{
		return[
			'name.required' => 'Vui lòng nhập họ tên',
			'username.required' => 'Vui lòng nhập tên đăng nhập',
			'username.unique' => 'Tên đăng nhập đã tồn tại',
			'password.required' => 'Vui lòng nhập password',
			'address.required' => 'Vui lòng nhập địa chỉ',
			'phone.required' => 'Vui lòng nhập số điện thoại',
			'email.required' => 'Vui lòng nhập email',
			'email.email' => 'Email sai định dạng',
			'email.unique' => 'Email đã tồn tại',
			'chkterms.required' => 'Vui lòng đồng ý điều khoản thành viên'
		];
	}
}
