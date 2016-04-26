<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;
use App\Genre;

class BookController extends Controller
{
	public function show($genre_id, $id)
	{
		$book = Book::findOrFail($id);
		if ($genre_id != 'genre') {
			$genre = Genre::find($genre_id);
			return view('pages.book')->with('book', $book)->with('genre', $genre);
		} else
			return view('pages.book')->with('book', $book);
	}
}
