<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Orders;
use Session;

use Stripe;
class UserController extends Controller
{
  public function index(){
    if(Auth::check()&& (Auth::user()->User_type=='user')){
         return view('dashboard');
    }
    else if(Auth::check()&& Auth::user()->User_type=="admin"){
            return view('admin.admin_dashboard');
        }  
     return redirect('/');
  }  
public function home(){
 if(Auth::check()){
   $count=ProductCart::where("user_id" ,Auth::id())->count();
 }
 else{
  $count="";
 }
  $products=Product::latest()->take(4)->get();
  return view('index',compact('products','count'));
}
public function productDetails($id){
   if(Auth::check()){
   $count=ProductCart::where("user_id" ,Auth::id())->count();
 }
 else{
  $count="";
 }
  $product=Product::findOrFail($id);
  return view('product_details',compact('product','count'));
}
public function viewAllProducts(){
   if(Auth::check()){
   $count=ProductCart::where("user_id" ,Auth::id())->count();
 }
 else{
  $count="";
 }
  $products=Product::all();
  return view('allProduct',compact('products','count'));
}
public function addToCart($id){
  $product=Product::findOrFail($id);
$product_cart=new ProductCart();
$product_cart->user_id=Auth::id();
$product_cart->product_id=$product->id;

$product_cart->save();
return redirect()->back()->with('cart_message','added to the cart');
}

public function cartproduct() {
    if (Auth::check()) {
        // User is authenticated, count products in cart
        $count = ProductCart::where("user_id", Auth::id())->count();
        $cart = ProductCart::where('user_id', Auth::id())->get();
    } else {
        // User is not authenticated, set count to 0 and cart to an empty array
        $count = 0; // Initialize as 0
        $cart = []; // Initialize as an empty array
    }
    
    // Return the view with count and cart variables
    return view('viewcartproduct', compact('count', 'cart'));
}

 public function revome_cart_products($id){
$cart_product=ProductCart::findOrFail($id);
$cart_product->delete();
return redirect()->back();
 }
 public function confirmOrder(request $request){
  $cart_product_id=ProductCart::where('user_id',Auth::id())->get();
  $address=$request->receiver_address;
  $phone =$request->receiver_phone;
  foreach( $cart_product_id as  $cart_product){
 $order =new Orders();

   $order->receiver_address=$address;
   $order->receiver_phone=$phone;
   $order->user_id = Auth::id();
   $order->product_id=$cart_product->product_id;
   $order->save();
  } 
  $cart=ProductCart::where('user_id',Auth::id())->get();
  foreach($cart as $cart){
    $cart_product=ProductCart::findOrFail($cart->id);
     $cart_product->delete();
  }
 return redirect()->back()->with('confirm_order', "Order confirmed");
 }
 public function myOrder(){
  $orders=Orders::where('user_id',Auth::id())->get();
  return view('viewMyOrder', compact('orders'));
 }

  public function stripe($price)
 
    {
      
if(Auth::check()){
   $count=ProductCart::where("user_id" ,Auth::id())->count();
 }
 else{
  $count="";
 }
 
        return view('stripe', compact('count', 'price'));

    }


      public function stripePost(Request $request)


    {
      

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => 100 * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from itsolutionstuff.com." 

        ]);

       $cart_product_id=ProductCart::where('user_id',Auth::id())->get();
  $address=$request->receiver_address;
  $phone =$request->receiver_phone;
  foreach( $cart_product_id as  $cart_product){
 $order =new Orders();

   $order->receiver_address=$address;
   $order->receiver_phone=$phone;
   $order->user_id = Auth::id();
   $order->product_id=$cart_product->product_id;
   $order->payment_status="paid";
   $order->save();
  } 
  $cart=ProductCart::where('user_id',Auth::id())->get();
  foreach($cart as $cart){
    $cart_product=ProductCart::findOrFail($cart->id);
     $cart_product->delete();
  }

        Session::flash('success', 'Payment successful!');

              

        return back();

    }
}
