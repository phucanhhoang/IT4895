<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Global Variables

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/index', 'HomeController@index');

//Login
Route::get('auth/login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);

//Register
Route::get('auth/register', ['as' => 'getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister']);

//Genre
Route::get('genre/{id}', ['as' => 'showGenre', 'uses' => 'GenreController@show']);
Route::post('genre/sort-book', 'GenreController@sortBook');

//Book
Route::get('book/{genre_id}/{id}', ['as' => 'showBook', 'uses' => 'BookController@show']);

//Cart
Route::post('cart/get-cart', ['as' => 'getCart', 'uses' => 'CartController@getCart']);
Route::post('cart/add-cart', ['as' => 'addCart', 'uses' => 'CartController@addCart']);
Route::post('cart/delete', ['as' => 'delCart', 'uses' => 'CartController@delete']);

//Check out
Route::get('checkout', ['as' => 'getCheckOut', 'uses' => 'OrderController@getCheckOut']);
Route::post('checkout', ['as' => 'postCheckOut', 'uses' => 'OrderController@postCheckOut']);

//Change pass
Route::get('user/changepass', ['as' => 'getChangePass', 'uses' => 'UserController@getChangePass']);
Route::post('user/changepass', ['as' => 'postChangePass', 'uses' => 'UserController@postChangePass']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Search
Route::post('search', 'HomeController@search');

//----------------------- Admin zone -------------------------------//
Route::group(['prefix' => 'adpage'], function () {
	Route::get('/', 'HomeController@adminIndex');

	//Order
	Route::get('order', ['as' => 'getOrder', 'uses' => 'OrderController@getOrder']);
	Route::post('order/getOrderByStatus', 'OrderController@getOrderByStatus'); //get order by status
	Route::post('order/info', 'OrderController@orderInfo'); //get info order
	Route::post('order/delorder', 'OrderController@delOrder'); //delete order
	Route::post('order/saveOrder', 'OrderController@saveOrder'); //save info order
	Route::post('order/search', 'OrderController@search');

	//Author
	Route::get('author', ['as' => 'getAuthor', 'uses' => 'AuthorController@getAuthor']);
	Route::post('author/info', 'AuthorController@authorInfo'); //get info author
	Route::post('author/delAuthor', 'AuthorController@delAuthor'); //delete author
	Route::post('author/saveAuthor', 'AuthorController@saveAuthor'); //save info author

	//Genre
	Route::get('genre', ['as' => 'getGenre', 'uses' => 'GenreController@getGenre']);
	Route::post('genre/info', 'GenreController@genreInfo'); //get info genre
	Route::post('genre/delGenre', 'GenreController@delGenre'); //delete genre
	Route::post('genre/saveGenre', 'GenreController@saveGenre'); //save info genre

	//Publisher
	Route::get('publisher', ['as' => 'getPublisher', 'uses' => 'PublisherController@getPublisher']);
	Route::post('publisher/info', 'PublisherController@publisherInfo'); //get info publisher
	Route::post('publisher/delPublisher', 'PublisherController@delPublisher'); //delete publisher
	Route::post('publisher/savePublisher', 'PublisherController@savePublisher'); //save info publisher

	//Book
	Route::get('book', ['as' => 'getBook', 'uses' => 'BookController@getBook']);
	Route::post('book/info', 'BookController@bookInfo'); //get info Book
	Route::post('book/delBook', 'BookController@delBook'); //delete Book
	Route::post('book/saveBook', 'BookController@saveBook'); //save info Book

	//Customer
	Route::get('customer', ['as' => 'getCustomer', 'uses' => 'CustomerController@getCustomer']);
	Route::post('customer/info', 'CustomerController@customerInfo'); //get info customer
	Route::post('customer/delCustomer', 'CustomerController@delCustomer'); //delete customer
	Route::post('customer/saveCustomer', 'CustomerController@saveCustomer'); //save info customer

	//Account
	Route::get('account', ['as' => 'getAccount', 'uses' => 'UserController@getAccount']);
	Route::post('account/info', 'UserController@accountInfo'); //get info account
	Route::post('account/delAccount', 'UserController@delAccount'); //delete account
	Route::post('account/saveAccount', 'UserController@saveAccount'); //save info account

	//check exist
	Route::post('checkexist/email', 'UserController@checkEmail');
	Route::post('checkexist/username', 'UserController@checkUsername');

	//Statistic
	Route::get('statistic', ['as' => 'getStatistic', 'uses' => 'HomeController@getStatistic']);

	//Trash
//	Route::get('trash', ['as' => 'getTrash', 'uses' => 'HomeController@getTrash']);
});
