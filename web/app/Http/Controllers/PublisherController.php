<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Publisher;

class PublisherController extends Controller
{
    public function getPublisher()
    {
        $publishers = Publisher::where('deleted', '=', 0)->orderBy('name')->get();

        return view('admin.pages.publisher')->with('publishers', $publishers);
    }
}
