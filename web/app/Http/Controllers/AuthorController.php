<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Author;

class AuthorController extends Controller
{
    public function getAuthor()
    {
        $authors = Author::where('deleted', '=', 0)->orderBy('name')->get();

        return view('admin.pages.author')->with('authors', $authors);
    }

    public function authorInfo(Request $request)
    {
        $author = Author::find($request->id);

        return $author;
    }

    public function delAuthor(Request $request)
    {
        $Author_IDs = json_decode(stripslashes($request->authorIds));
        foreach ($Author_IDs as $id) {
            $author = Author::find($id);
            $author->deleted = 1;
            $check = $author->save();
        }
        if ($check) {
            return "true";
        } else {
            return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        }
    }

    public function saveAuthor(Request $request)
    {
        if ($request->author_id != "") {
            $author = Author::find($request->author_id);
            $author->name = $request->name;
            $author->profile = $request->profile;
            $check = $author->save();
            if ($check)
                return "EDIT_SUCCEED";
            else
                return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        } else {
            $author = new Author;
            $author->name = $request->name;
            $author->country = $request->country;
            $author->profile = $request->profile;
            $check = $author->save();
            if ($check) {
                $data = array(
                    'msg' => 'ADD_SUCCEED',
                    'author_id' => $author->id
                );
                return $data;
            } else
                return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        }
    }
}
