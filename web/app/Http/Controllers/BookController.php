<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;
use App\Genre;
use App\Author;
use App\Publisher;

class BookController extends Controller
{
	//-------------------------Admin page-----------------------------//
	public function getBook()
	{
		$books = Book::join('genre', 'genre.id', '=', 'book.genre_id')
			->join('author', 'author.id', '=', 'book.author_id')
			->join('publisher', 'publisher.id', '=', 'book.publisher_id')
			->select('book.id', 'title', 'genre_id', 'genre.name as genre_name', 'author_id', 'author.name as author_name',
				'publisher_id', 'publisher.name as publisher_name',
				'image', 'isbn', 'description_short', 'price', 'sale', 'quantity')
			->where('book.deleted', '=', 0)
			->get();
		$genres = Genre::where('deleted', '=', 0)->orderBy('name')->get();
		$authors = Author::where('deleted', '=', 0)->orderBy('name')->get();
		$publishers = Publisher::where('deleted', '=', 0)->orderBy('name')->get();
		$data = array(
			'books' => $books,
			'authors' => $authors,
			'genres' => $genres,
			'publishers' => $publishers
		);

		return view('admin.pages.book')->with('data', $data);
	}

	public function bookInfo(Request $request)
	{
		$book = Book::find($request->id);

		return $book;
	}

	public function delBook(Request $request)
	{
		$Book_IDs = json_decode(stripslashes($request->bookIds));
		foreach ($Book_IDs as $id) {
			$book = Book::find($id);
			$book->deleted = 1;
			$check = $book->save();
		}
		if ($check) {
			return "true";
		} else {
			return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		}
	}

	public function saveBook(Request $request)
	{
		if ($request->book_id != "") {
			$book = Book::find($request->book_id);
			$book->title = $request->title;
			$book->genre_id = $request->genre_id;
			$book->author_id = $request->author_id;
			$book->publisher_id = $request->publisher_id;
			$book->image = $request->image;
			$book->isbn = $request->isbn;
			$book->description_short = $request->description_short;
			$book->description = $request->description;
			$book->price = $request->price;
			$book->sale = $request->sale;
			$book->quantity = $request->quantity;
			$check = $book->save();
			if ($check)
				return "EDIT_SUCCEED";
			else
				return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		} else {
			$book = new Book;
			$book->title = $request->title;
			$book->genre_id = $request->genre_id;
			$book->author_id = $request->author_id;
			$book->publisher_id = $request->publisher_id;
			$book->image = $request->image;
			$book->isbn = $request->isbn;
			$book->description_short = $request->description_short;
			$book->description = $request->description;
			$book->price = $request->price;
			$book->sale = $request->sale;
			$book->quantity = $request->quantity;
			$check = $book->save();
			if ($check) {
				$genre_name = Genre::find($request->genre_id)->name;
				$author_name = Author::find($request->author_id)->name;
				$data = array(
					'msg' => 'ADD_SUCCEED',
					'book_id' => $book->id,
					'genre_name' => $genre_name,
					'author_name' => $author_name
				);
				return $data;
			} else
				return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		}
	}

	//-------------------------User and Guest page--------------------//
	public function show($genre_id, $id)
	{
		$book = Book::findOrFail($id);
		if ($genre_id != 'genre') {
			$genre = Genre::find($genre_id);
			if ($genre->count() > 0)
				return view('pages.book')->with('book', $book)->with('genre', $genre);
			else
				return view('errors.404');
		} else
			return view('pages.book')->with('book', $book);
	}
}
