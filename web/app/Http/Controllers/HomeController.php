<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\Order;
use App\Customer;

class HomeController extends Controller
{
	//---------------------------Admin page-----------------------------------------//
	public function adminIndex()
	{
		if (Auth::check()) {
			if (Auth::user()->userable_type == 'customer') {
				return view('errors.404');
			} else {
				$countNewOrder = Order::where('shipped', '=', 0)->where('seen', '=', 0)->where('deleted', '=', 0)->count();
				$countNewCustomer = Customer::where('created_at', '>', date('Y-m-d'))->where('created_at', '<', date('Y-m-d H:i:s'))->count();
				$countSale = Book::where('sale', '>', 0)->count();
				return view('admin.pages.index', compact('countNewOrder', 'countNewCustomer', 'countSale'));
			}
		} else
			return view('errors.404');
	}

	public function getStatistic()
	{

		return view('admin.pages.statistic');
	}

//	public function getTrash(){
//
//		return view('admin.pages.trash');
//	}

	//---------------------------User and Guest page--------------------------------//
    public function index(){
		$newbooks = Book::orderBy('created_at', 'desc')->select('id', 'title', 'image', 'price', 'sale')->take(8)->get();

		$book_data = array(
			'newbook' => $newbooks,
		);

		return view('pages.index')->with('book_data', $book_data);
    }

}
