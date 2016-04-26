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
}
