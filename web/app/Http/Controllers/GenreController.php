<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Book;

use App\Http\Requests;

class GenreController extends Controller
{
	//---------------------------Admin page------------------------------------//
	public function getGenre()
	{
		$genres = Genre::where('deleted', '=', 0)->orderBy('name')->get();

		return view('admin.pages.genre')->with('genres', $genres);
	}

	public function genreInfo(Request $request)
	{
		$genre = Genre::find($request->id);

		return $genre;
	}

	public function delGenre(Request $request)
	{
		$Genre_IDs = json_decode(stripslashes($request->genreIds));
		foreach ($Genre_IDs as $id) {
			$genre = Genre::find($id);
			$genre->deleted = 1;
			$check = $genre->save();
		}
		if ($check) {
			return "true";
		} else {
			return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		}
	}

	public function saveGenre(Request $request)
	{
		if ($request->genre_id != "") {
			$genre = Genre::find($request->genre_id);
			$genre->name = $request->name;
			$genre->description = $request->description;
			$check = $genre->save();
			if ($check)
				return "EDIT_SUCCEED";
			else
				return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		} else {
			$genre = new Genre;
			$genre->name = $request->name;
			$genre->description = $request->description;
			$check = $genre->save();
			if ($check) {
				$data = array(
					'msg' => 'ADD_SUCCEED',
					'genre_id' => $genre->id
				);
				return $data;
			} else
				return "Có lỗi xảy ra. Vui lòng thử lại sau!";
		}
	}

	//---------------------------User and Guest page---------------------------//
	public function show($id)
	{
		$genre = Genre::find($id);
		$books = Book::where('genre_id', '=', $id)->get();
		$data = array(
			'genre' => $genre,
			'books' => $books
		);
		return view('pages.genre')->with('data', $data);
	}

	public function sortBook(Request $request)
	{
		if ($request->sort_type == 'name')
			$books = Book::where('genre_id', '=', $request->id)->orderBy('title');
		else if ($request->sort_type == 'price_up')
			$books = Book::where('genre_id', '=', $request->id)->orderBy('price');
		else
			$books = Book::where('genre_id', '=', $request->id)->orderBy('price', 'desc');
		if ($books->count() > 0) {
			$data = array(
				'books' => $books->get()
			);

			return $data;
		} else
			return 'false';
	}
}
