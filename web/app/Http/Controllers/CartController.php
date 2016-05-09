<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Book;

class CartController extends Controller
{
    public function getCart(Request $request)
    {
        $cart = Cart::join('book', 'book.id', '=', 'cart.book_id')->select('cart.id', 'book.title', 'cart.quantity', 'book.price', 'sale')->where(function ($query) use ($request) {
            $query->where('user_id', '=', Auth::check() ? Auth::user()->id : 0)->orWhere('remember_token', '=', $request->_token);
        })->get();
        $data = array(
            'cart' => $cart
        );

        return $data;
    }

    public function addCart(Request $request)
    {
        $book = Book::find($request->id);
        if ($request->quantity <= $book->quantity) {
            $cart_old = Cart::where('book_id', '=', $request->id)->where(function ($query) use ($request) {
                $query->where('user_id', '=', Auth::check() ? Auth::user()->id : 0)->orWhere('remember_token', '=', $request->header('X-CSRF-TOKEN'));
            });
            if ($cart_old->count() > 0) {
                $check = $cart_old->firstOrFail()->update(['quantity' => $cart_old->firstOrFail()->quantity + $request->quantity]);
            } else {
                $cart = new Cart;
                $cart->user_id = Auth::check() ? Auth::user()->id : null;
                $cart->book_id = $request->id;
                $cart->quantity = $request->quantity;
                $cart->remember_token = $request->header('X-CSRF-TOKEN');
                $check = $cart->save();
            }

            if ($check) {
                return "true";
            } else {
                return "Lỗi thêm hàng vào giỏ. Vui lòng thử lại!";
            }
        } else
            return "Quá số hàng trong kho. Vui lòng thử lại!";
    }

    public function delete(Request $request)
    {
        $check = Cart::find($request->id)->delete();
        if ($check) {
            $carts = Cart::join('book', 'book.id', '=', 'book_id')->select('book.price', 'cart.quantity', 'sale')
                ->where('user_id', '=', Auth::check() ? Auth::user()->id : 0)
                ->orWhere('remember_token', '=', $request->header('X-CSRF-TOKEN'))
                ->get();
            $money = 0;
            foreach ($carts as $cart) {
                $price = $cart->price;
                if ($cart->sale > 0) {
                    $price = $cart->price - $cart->price * $cart->sale / 100;
                }
                $money += $price * $cart->quantity;
            }
            $data = array(
                'msg' => 'true',
                'money' => number_format($money, 0, ',', '.')
            );
            return $data;
        } else {
            $data = array(
                'msg' => "Lỗi xóa hàng trong giỏ. Vui lòng thử lại!",
            );
            return $data;
        }
    }
}
