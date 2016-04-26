<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
{
    public function getCustomer()
    {

        return view('admin.pages.customer');
    }
}
