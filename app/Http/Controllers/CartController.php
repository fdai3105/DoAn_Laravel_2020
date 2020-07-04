<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::content();
        return view('cart', ['cart' => $cart]);
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->id;
        $product = Product::find($product_id);
        $cartInfo = [
            'id' => $product_id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => '1',
            'weight' => '0',
            'options' => ['image' => $product->image]
        ];
        Cart::add($cartInfo);
    }

    public function removeCart(Request $request)
    {
        $cartID = $request->id;
        $item = Cart::search(function ($cart, $key) use ($cartID) {
            return $cart->id == $cartID;
        })->first();
        Cart::remove($item->rowId);
    }

    public function changeQty(Request $request)
    {
        $id = $request->id;
        $item = Cart::search(function ($key, $value) use ($id) {
            return $key->id == $id;
        })->first();
        Cart::update($item->rowId, $item->qty = $request->qty);
        return response()->json([
            'qty' => $item->qty,
            'totalItem' => $item->subtotal, 
            'total' => Cart::subtotal(0, ','),

        ]);
    }

    /**
     * -
     */
    public function decreaseQty(Request $request)
    {
        $id = $request->id;
        $item = Cart::search(function ($key, $value) use ($id) {
            return $key->id == $id;
        })->first();
        Cart::update($item->rowId, $item->qty - 1);
        return response()->json([
            'qty' => $item->qty,
            'totalItem' => $item->subtotal, 
            'total' => Cart::subtotal(0, ','),

        ]);
    }

    /**
     * +
     */
    public function incrementQty(Request $request)
    {
        $id = $request->id;
        $item = Cart::search(function ($key, $value) use ($id) {
            return $key->id == $id;
        })->first();
        Cart::update($item->rowId, $item->qty + 1);
        return response()->json([
            'qty' => $item->qty,
            'totalItem' => $item->subtotal,
            'total' => Cart::subtotal(0, ','),
        ]);
    }

    /**
     * todo --note
     */
    public function checkout(Request $request)
    {
        $cartInfor = Cart::content();
        $order = new Order();
        $order->users_id = Auth::user()->id;
        $order->total = str_replace(',', '', Cart::subtotal());
        $order->note = '';
        $order->save();

        if (count($cartInfor) > 0) {
            foreach ($cartInfor as $key => $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->orders_id = $order->id;
                $orderDetail->product_id = $item->id;
                $orderDetail->quality = $item->qty;
                $orderDetail->price = $item->price * $item->qty;
                $orderDetail->save();
            }
        }
        Cart::destroy();
    }
}
