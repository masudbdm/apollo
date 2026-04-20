<?php

namespace Cp\Product\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Cp\Product\Models\Cart;
use Cp\Product\Models\Order;
use Cp\Product\Models\Product;
use Cp\Product\Models\OrderItem;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function addToCart(Request $request)
    {

        $session_id = Session::get('cart_session_id');
        if (empty($session_id)) {
            $session_id = Session::getId();
            Session::put('cart_session_id', $session_id);
        }

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 0;
        }

        // dd($request->all());

        $cart = Cart::where('product_id', $request->product_id)->where('session_id', $session_id)->where('user_id', $user_id)->first();
        if ($cart) {
            $cart->quantity   = $cart->quantity + $request->quantity;
            $cart->save();
        } else {
            $cart             = new Cart();
            $cart->product_id = $request->product_id;
            $cart->session_id = $session_id;
            $cart->user_id    = $user_id;
            $cart->quantity   = $request->quantity;
            $cart->addedby_id =  $user_id;
            $cart->save();
        }


        toast('Product has been added to Cart.', 'success');
        return redirect()->back();
    }


    public function viewCart()
    {

        $data['collection'] = Cart::getCartItems();
        return view('frontend::welcome.cartView', $data);
    }


    public function cartUpdateQty(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        Cart::where('id', $request->cart_id)->update(['quantity' => $request->new_qty]);
        $collection = Cart::getCartItems();
        $totalCartAmount = totalCartAmount();
        $cartCount = totalCartItems();
        return response()->json([
            'status' => true,
            'totalCartAmount' => $totalCartAmount,
            'cartCount' => $cartCount,
            'view' => (string)View::make('frontend::welcome.includes.cart_item')->with(compact('collection'))
        ]);
    }


    public function cartRemoveItem(Request $request)
    {
        $cart  = Cart::find($request->cart_id);
        $cart->delete();
        $collection = Cart::getCartItems();
        $cartCount = totalCartItems();
        $totalCartAmount = totalCartAmount();
        return response()->json([
            'status' => true,
            'cartCount' => $cartCount,
            'totalCartAmount' => $totalCartAmount,
            'view' => (string)View::make('frontend::welcome.includes.cart_item')->with(compact('collection'))
        ]);
    }


    public function checkout()
    {
        $data['collection'] = Cart::getCartItems();
        return view('frontend::welcome.checkout', $data);
    }


    public function orderStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'post_code' => 'required',
            'city' => 'required',
        ]);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->name = $request->name;
        $order->company_name = $request->company_name;
        $order->mobile = $request->mobile;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->post_code = $request->post_code;
        $order->city = $request->city;
        $order->note = $request->note;
        $order->product_price = totalCartAmount();
        $order->total_amount = totalCartAmount() + $order->delivery_cost;
        $order->pending_at = Carbon::now();
        $order->addedby_id = Auth::user()->id;
        $order->save();

        $cardItems = Cart::where('user_id', Auth::user()->id)->get();

        if ($cardItems) {
            foreach ($cardItems as $cart) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->user_id = Auth::user()->id;
                $orderItem->product_id = $cart->id;
                $orderItem->product_name = $cart->product->name;
                $orderItem->product_price = $cart->product->price;
                $orderItem->quantity = $cart->quantity;
                $orderItem->total_cost = $cart->product->price * $cart->quantity;
                $orderItem->addedby_id = Auth::user()->id;
                $orderItem->save();
            }
        }

        Cart::where('user_id', Auth::user()->id)->delete();
        toast('Order Successfully.', 'success');
        return redirect()->back();
    }


    public function orderConfirmed()
    {
        $order = Order::where('user_id', Auth::user()->id)->first();
        $orderItems = OrderItem::where('user_id', Auth::user()->id)
            ->where('order_id', $order->id)->get();

        return view('frontend::welcome.orderConfirmed', compact('order', 'orderItems'));
    }

    public function productQuickView(Product $product)
    {
        $data['product'] = $product;
        return response()->json(view('frontend::welcome.includes.ajaxQuickView', $data)->render());
    }
}
