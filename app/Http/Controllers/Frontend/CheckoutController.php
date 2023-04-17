<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CheckoutController extends Controller
{
    public function index()
    {
        // $old_cartItems = Cart::where('user_id', Auth::id())->get();
        // foreach ($old_cartItems as $item) {

        //     if (!Product::where('id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists()) {
        //         $removeItem = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
        //         $removeItem->delete();
        //     }
        // }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        // dd($old_cartItems);
        return view('frontend.checkout', compact('cartItems'));
    }
    public function placeorder(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');

        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');



        //totally empty
        $total = 0;
        $cartItems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems_total as $prod) {
            $total = $prod->products->selling_price;
            $qty = $prod->prod_qty;
            $order->total_price += $total * $qty;
        }
        $order->tracking_no = 'FIFA' . rand(1111, 9999);
        // dd($order);
        $order->save();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price,

            ]);
            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }
        if (Auth::user()->address1 == null) {

            $user = User::where('id', Auth::id())->first();
            $order->fname = $request->input('name');
            $user->lname = $request->input('lname');
            // $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);

        if ($request->input('payment_mode') == "paid by Razorpay" || $request->input('payment_mode') == "paid by Paypal") {
            return response()->json(['status' => "Order placed successfully"]);
        }
        return redirect('/')->with('status', "Order placed successfully");
    }






    public function razorpaycheck(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartItems as $item) {
            $total_price += $item->products->selling_price * $item->prod_qty;
        }

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $pincode = $request->input('pincode');

        return response()->json([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address1' => $address1,
            'address2' => $address2,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'pincode' => $pincode,

            'total_price' => $total_price

        ]);
    }
}
