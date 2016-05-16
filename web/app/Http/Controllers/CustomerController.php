<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Customer;

class CustomerController extends Controller
{
    public function getCustomer()
    {
        $customers = User::rightJoin('customer', 'customer.id', '=', 'users.userable_id')
            ->select('customer.id', 'username', 'email', 'banned',
                'name', 'address', 'phone')
            ->where('customer.deleted', '=', 0)->get();
        return view('admin.pages.customer')->with('customers', $customers);
    }

    public function customerInfo(Request $request)
    {
        $customer = Customer::leftJoin('users', 'users.userable_id', '=', 'customer.id')
            ->select('customer.id', 'username', 'email', 'banned',
                'name', 'address', 'phone')
            ->findOrFail($request->id);

        return $customer;
    }

    public function delCustomer(Request $request)
    {
        $Customer_IDs = json_decode(stripslashes($request->customerIds));
        foreach ($Customer_IDs as $id) {
            $customer = Customer::find($id);
            $customer->deleted = 1;
            $check = $customer->save();
            User::where('userable_id', '=', $id)->update(['deleted' => 1]);
        }
        if ($check) {
            return "true";
        } else {
            return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        }
    }

    public function saveCustomer(Request $request)
    {
        if ($request->customer_id != "") {
            $customer = Customer::find($request->customer_id);
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            User::where('userable_id', '=', $request->customer_id)->update(['email' => $request->email, 'banned' => $request->banned]);
            $check = $customer->save();
            if ($check)
                return "EDIT_SUCCEED";
            else
                return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        } else {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $check = $customer->save();
            if ($check) {
                $data = array(
                    'msg' => 'ADD_SUCCEED',
                    'customer_id' => $customer->id
                );
                return $data;
            } else
                return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        }
    }
}
