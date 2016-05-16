<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePassRequest extends Request
{

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
            'cur_pass' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cur_pass.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.confirmed' => 'Mật khẩu chưa khớp',
            'password.min' => 'Mật khẩu phải từ 8 ký tự trở lên',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu mới'
        ];
    }

}
