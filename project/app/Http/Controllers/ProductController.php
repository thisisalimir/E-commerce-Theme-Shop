<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Cart;
use Auth;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function getIndex()
    {
      $products = Product::all();
      return view('shop.index',[
        'products' => $products
      ]);
    }

     //method to get product to user cart
    public function getAddToCart(Request $request, $id)
    {
          //first we find product
         $product = Product::find($id);
         //if user already add value we show it
         $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
         //if not we make new cart
         $cart = new Cart($oldCart);
         //and add product woth its id
         $cart->add($product,$product->id);
         //and then put that on $cart
         $request->session()->put('cart',$cart);
         return redirect()->route('product.index');
    }

    public function getReduceByOne($id)
    {
      //if user already add value we show it
      $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
      //if not we make new cart
      $cart = new Cart($oldCart);
      //using our Method from Cart
      $cart->reduceByOne($id);
      if (count($cart->items) > 0) {
        Session::put('cart',$cart);
      }else {
        Session::forget('cart');
      }
      return redirect()->route('product.shoppingCart');
    }

    public function getRemove($id)
    {
      //if user already add value we show it
      $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
      //if not we make new cart
      $cart = new Cart($oldCart);
      $cart->removeItem($id);
      if (count($cart->items) > 0) {
        Session::put('cart',$cart);
      }else {
        Session::forget('cart');
      }
      return redirect()->route('product.shoppingCart');
    }

    //method to go to cart page and see purchase
    public function getCart()
    {
      //if user has no purchase we return
       if (!Session::has('cart')) {
           return view('shop.shopping-cart');
       }

       //else we get session of cart
       $oldCart = Session::get('cart');
       //and again create new cart
       $cart = new Cart($oldCart);
       //and get resutl of purchase to our page [Items & Price]
       return view('shop.shopping-cart',[
         'products' => $cart->items,
         'totalPrice' => $cart->totalPrice
       ]);
    }

    public function getCheckOut()
    {
      //if user has no purchase we return
       if (!Session::has('cart')) {
           return view('shop.shopping-cart');
       }
       $oldCart = Session::get('cart');
       $cart = new Cart($oldCart);
       $total = $cart->totalPrice;
       return view('shop.checkout',[
         'total' => $total
       ]);

    }

    public function postCheckOut(Request $request)
    {
      if (!Session::has('cart')) {
        return redirect()->route('shop.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);

      Stripe::setApiKey('xxxxx');
      try {
        $charge = Charge::create(array(
          "amount" => $cart->totalPrice * 100,
          "currency" => "usd",
          "source" => $request->input('stripeToken'), // obtained with Stripe.js
          "description" => "Test Charge"
        ));
        $order = new Order();
        //its convert onject to string also we have unserialize
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->payement_id = $charge->id;

        Auth::user()->orders()->save($order);
      } catch (\Exception $e) {
        return redirect()->route('checkout')
                        ->with('error',$e->getMessage());
      }

      Session::forget('cart');
      return redirect()->route('product.index')
                      ->with('success','Successfully Purchased');
    }


}
