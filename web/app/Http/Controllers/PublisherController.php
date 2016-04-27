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

    public function publisherInfo(Request $request)
    {
        $publisher = Publisher::find($request->id);

        return $publisher;
    }

    public function delPublisher(Request $request)
    {
        $Publisher_IDs = json_decode(stripslashes($request->publisherIds));
        foreach ($Publisher_IDs as $id) {
            $publisher = Publisher::find($id);
            $publisher->deleted = 1;
            $check = $publisher->save();
        }
        if ($check) {
            return "true";
        } else {
            return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        }
    }

    public function savePublisher(Request $request)
    {
        if ($request->publisher_id != "") {
            $publisher = Publisher::find($request->publisher_id);
            $publisher->name = $request->name;
            $publisher->short_intro = $request->short_intro;
            $check = $publisher->save();
            if ($check)
                return "EDIT_SUCCEED";
            else
                return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        } else {
            $publisher = new Publisher;
            $publisher->name = $request->name;
            $publisher->country = $request->country;
            $publisher->short_intro = $request->short_intro;
            $check = $publisher->save();
            if ($check) {
                $data = array(
                    'msg' => 'ADD_SUCCEED',
                    'publisher_id' => $publisher->id
                );
                return $data;
            } else
                return "Có lỗi xảy ra. Vui lòng thử lại sau!";
        }
    }
}
