<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckOutRequest;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Order;
use App\Customer;
use App\OrderDetail;
use App\Enum\OrderStatus;

use App\Http\Requests;

class OrderController extends Controller
{
	//----------------------Admin page--------------------------------------//
	public function getOrder()
	{
		$orders = Order::join('customer', 'customer.id', '=', 'order.customer_id')
			->select('order.id', 'name', 'phone', 'address', 'ship_time', 'note', 'shipped', 'seen', 'order.created_at');
//		$newOrders = $orders->where('shipped', '=', 0)->get();
		$allOrders = $orders->where('order.deleted', '=', 0)->orderBy('created_at', 'desc')->get();

		return view('admin.pages.order')->with('orders', $allOrders);
	}

	public function search(Request $request)
	{
		$key_word = $request->key;
		$orders = Order::join('customer', 'customer.id', '=', 'order.customer_id')
			->select('order.id', 'name', 'phone', 'address', 'ship_time', 'note', 'shipped', 'seen', 'order.created_at')
			->where('order.deleted', '=', 0)
			->where(function ($query) use ($key_word) {
				$query->where('name', 'like', '%' . $key_word . '%')
					->orWhere('phone', 'like', $key_word);
			})
			->orderBy('created_at', 'desc')->get();
		return $orders;
	}

	public function getOrderByStatus(Request $request)
	{
		$orderStatus = $request->orderStatus;
		$allOrder = Order::where('deleted', '=', 0)->join('customer', 'customer.id', '=', 'order.customer_id')
			->select('order.id', 'name', 'phone', 'address', 'ship_time', 'note', 'shipped', 'seen', 'order.created_at')
			->orderBy('created_at', 'desc');
		if ($orderStatus == OrderStatus::CHUA_GUI_HANG) {
			$orders = $allOrder->where('shipped', '=', OrderStatus::CHUA_GUI_HANG)->get();
		} elseif ($orderStatus == OrderStatus::DANG_GUI_HANG) {
			$orders = $allOrder->where('shipped', '=', OrderStatus::DANG_GUI_HANG)->get();
		} elseif ($orderStatus == OrderStatus::DA_GUI_HANG) {
			$orders = $allOrder->where('shipped', '=', OrderStatus::DA_GUI_HANG)->get();
		} else {
			$orders = $allOrder->get();
		}
		return $orders;
	}

	public function orderInfo(Request $request)
	{
		$order = Order::find($request->id);
		$order_detail = OrderDetail::where('order_id', '=', $request->id)->join('book', 'book.id', '=', 'order_detail.book_id')
			->select('order_detail.id', 'title', 'price', 'order_detail.quantity')
			->get();
		$customer = Customer::find($order->customer_id);
		$data = array(
			'customer' => $customer,
			'order' => $order,
			'order_detail' => $order_detail
		);

		$order->seen = 1;
		$order->save();

		return $data;
	}

	public function delOrder(Request $request)
	{
		$Order_IDs = json_decode(stripslashes($request->orderIds));
		foreach ($Order_IDs as $id) {
			$order = Order::find($id);
			$order->deleted = 1;
			$check = $order->save();
		}
		if ($check) {
			return "true";
		} else {
			return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		}
	}

	public function saveOrder(Request $request)
	{
		if ($request->order_id != "") {
			$order = Order::find($request->order_id);
			$customer = Customer::find($order->customer_id);
			$customer->name = $request->name;
			$customer->phone = $request->phone;
			$customer->address = $request->address;
			$order->ship_time = $request->ship_time;
			$order->shipped = $request->order_status;
			$order->note = $request->note;
			$check1 = $customer->save();
			$check2 = $order->save();
			if ($check1 && $check2)
				return "true";
			else
				return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		} else {
			return "NOT_FOUND";
		}
	}

	//----------------------User and Guest page-----------------------------//
	public function getCheckOut()
	{
		$_token = csrf_token();
		$cart = Cart::join('book', 'book.id', '=', 'cart.book_id')
			->select('cart.id', 'book.title', 'cart.quantity', 'book.price', 'sale')
			->where(function ($query) use ($_token) {
				$query->where('user_id', '=', Auth::check() ? Auth::user()->id : 0)
					->orWhere('remember_token', '=', $_token);
			})->get();
		$data = array(
			'cart' => $cart
		);
		if (Auth::check()) {
			$customer = Customer::find(Auth::user()->userable_id);
			$data = array_add($data, 'customer', $customer);
		}

		return view('pages.checkout')->with('data', $data);
	}

	public function postCheckOut(CheckOutRequest $request)
	{
		try {

			if (Auth::check()) {
				$customer = Customer::find(Auth::user()->userable_id);
				if ($customer->name != $request->name) {
					$customer = new Customer;
					$customer->name = $request->name;
					$customer->address = $request->address;
					$customer->phone = $request->phone;
					$customer->save();
				}
			} else {
				$customer = Customer::where('phone', '=', $request->phone)->first();
				if ($customer->count() == 0) {
					$customer = new Customer;
					$customer->name = $request->name;
					$customer->address = $request->address;
					$customer->phone = $request->phone;
					$customer->save();
				}
			}

			$_token = csrf_token();
			$carts = Cart::where(function ($query) use ($_token) {
				$query->where('user_id', '=', Auth::check() ? Auth::user()->id : 0)
					->orWhere('remember_token', '=', $_token);
			});
			if ($carts->count() > 0) {
				$order = new Order;
				$order->customer_id = $customer->id;
				$order->note = $request->note;
				$order->ship_time = $request->ship_time;
				$order->save();

				foreach ($carts->get() as $cart) {
					$order_detail = new OrderDetail;
					$order_detail->order_id = $order->id;
					$order_detail->book_id = $cart->book_id;
					$order_detail->quantity = $cart->quantity;
					$order_detail->save();
				}
				$carts->delete();
				return redirect('/')
					->with('message', 'Đặt hàng thành công. Chúng tôi sẽ sớm liên lạc với bạn!')
					->with('alert-class', 'alert-success')
					->with('fa-class', 'fa-check');
			} else {
				return redirect('/checkout')
					->with('message', 'Không có hàng trong giỏ.')
					->with('alert-class', 'alert-warning')
					->with('fa-class', 'fa-warning');
			}
} catch (ValidationException $e) {
			return redirect('/checkout')
				->with('message', 'Xảy ra lỗi khi lưu đơn hàng, vui lòng thử lại!!!')
				->with('alert-class', 'alert-danger')
				->with('fa-class', 'fa-ban');

		}
	}
}