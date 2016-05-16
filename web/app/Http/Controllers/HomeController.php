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
				$books_sale = Book::join('genre', 'genre.id', '=', 'book.genre_id')
					->join('author', 'author.id', '=', 'book.author_id')
					->join('publisher', 'publisher.id', '=', 'book.publisher_id')
					->select('book.id', 'title', 'genre_id', 'genre.name as genre_name', 'author_id', 'author.name as author_name',
						'publisher_id', 'publisher.name as publisher_name',
						'image', 'isbn', 'description_short', 'price', 'sale', 'quantity')
					->where('book.deleted', '=', 0)
					->where('book.sale', '>', 0)
					->get();

				$books_selling = Book::join('genre', 'genre.id', '=', 'book.genre_id')
					->join('author', 'author.id', '=', 'book.author_id')
					->join('publisher', 'publisher.id', '=', 'book.publisher_id')
					->join('order_detail', 'order_detail.book_id', '=', 'book.id')
					->selectRaw('book.id, title, genre_id, genre.name as genre_name,
					author_id, author.name as author_name, publisher_id, publisher.name as publisher_name,
					image, isbn, description_short, price, sale, book.quantity, SUM(order_detail.quantity) as sum_quantity')
					->where('book.deleted', '=', 0)
					->groupBy('book_id')
					->orderBy('sum_quantity', 'desc')
					->take(10)
					->get();

				$data = array(
					'books_sale' => $books_sale,
					'books_selling' => $books_selling
				);
				return view('admin.pages.index', compact('countNewOrder', 'countNewCustomer', 'countSale'))->with('data', $data);
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
		$slidebook = Book::join('genre', 'genre.id', '=', 'book.genre_id')
			->join('author', 'author.id', '=', 'book.author_id')
			->join('publisher', 'publisher.id', '=', 'book.publisher_id')
			->select('book.id', 'title', 'genre_id', 'genre.name as genre_name', 'author_id', 'author.name as author_name',
				'publisher_id', 'publisher.name as publisher_name',
				'image', 'isbn', 'price', 'sale')
			->where('book.deleted', '=', 0)->where('quantity', '>', 0)->orderBy('created_at', 'desc')->take(5)->get();

		$newbooks = Book::select('id', 'title', 'image', 'price', 'sale')
			->where('book.deleted', '=', 0)->where('quantity', '>', 0)
			->orderBy('created_at', 'desc')->take(8)->get();

		$salebooks = Book::select('id', 'title', 'image', 'price', 'sale')
			->where('book.deleted', '=', 0)->where('quantity', '>', 0)->where('sale', '>', 0)
			->take(8)->get();

		$book_data = array(
			'slidebook' => $slidebook,
			'newbook' => $newbooks,
			'salebook' => $salebooks,
		);

		return view('pages.index')->with('book_data', $book_data);
    }

	public function search(Request $request)
	{
		$key_word = $request->key_word;
		$key_word = explode(" - ", $key_word)[0];
		$books = Book::join('author', 'author.id', '=', 'book.author_id')
			->join('publisher', 'publisher.id', '=', 'book.publisher_id')
			->select('book.id', 'title', 'image', 'isbn', 'price', 'sale')
			->where('book.deleted', '=', 0)
			->where('quantity', '>', 0)
			->where(function ($query) use ($key_word) {
				$query->where('title', 'like', '%' . $key_word . '%')
					->orWhere('isbn', 'like', $key_word)
					->orWhere('author.name', 'like', '%' . $key_word . '%')
					->orWhere('publisher.name', 'like', '%' . $key_word . '%');
			})->get();
		if ($books->count() == 1) {
			return redirect('book/genre/' . $books[0]->id);
		}
		return view('pages.result-search', compact('key_word'))->with('books', $books);
	}
}
