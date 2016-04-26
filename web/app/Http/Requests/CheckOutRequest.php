<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CheckOutRequest extends Request
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'ship_time' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên người nhận hàng',
            'address.required' => 'Vui lòng nhập địa chỉ nhận hàng',
            'phone.required' => 'Vui lòng nhập số điện thoại người nhận hàng',
            'ship_time.required' => 'Vui lòng nhập khoảng thời gian nhận hàng'
        ];
    }
}
