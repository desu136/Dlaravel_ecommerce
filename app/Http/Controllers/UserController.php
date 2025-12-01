<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Orders;
use Illuminate\Support\Facades\Mail;
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
return redirect()->route('viewcartproduct')->with('cart_message','added to the cart');
}

public function cartproduct() {
    if (Auth::check()) {
        // User is authenticated, count products in cart
        $count = ProductCart::where("user_id", Auth::id())->count();
        $cart = ProductCart::where('user_id', Auth::id())->get();
    } else {
        
        $count = 0;
        $cart = []; 
    }
    
    // Return the view with count and cart variables
    return view('viewcartproduct', compact('count', 'cart'));
}

 public function revome_cart_products($id){
$cart_product=ProductCart::findOrFail($id);
$cart_product->delete();
return redirect()->back();
 }
public function confirmOrder(Request $request)
{
    $cart_product_id = ProductCart::where('user_id', Auth::id())->get();
    $address = $request->receiver_address;
    $phone = $request->receiver_phone;

    // Create orders with pending payment status
    foreach ($cart_product_id as $cart_product) {
        $order = new Orders();

        $order->receiver_address = $address;
        $order->receiver_phone = $phone;
        $order->user_id = Auth::id();
        $order->product_id = $cart_product->product_id;
        $order->status="pending";
        $order->payment_status = "pending"; // Set initial payment status to pending

        $order->save();
    }

    // Optionally delete products from the cart after confirming the order
    ProductCart::where('user_id', Auth::id())->delete();

    return redirect()->route('myOrders')->with('confirm_order', "Order confirmed. Please proceed to payment.");
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

 $orders = Orders::where('user_id', Auth::id())->where('payment_status', 'pending')->get();

        foreach ($orders as $order) {
            // Only update if the order is still pending
            if ($order->payment_status === 'pending') {
                $order->payment_status = "paid"; // Update payment status to paid
                $order->save();
            }
            
        }

        Session::flash('success', 'Payment successful!');

              

        return back();

    }
public function sendEmail(Request $request)
{
    if (Auth::check()) {
        // User is authenticated, count products in cart
        $count = ProductCart::where("user_id", Auth::id())->count();
        $cart = ProductCart::where('user_id', Auth::id())->get();
    } else {
        // User is not authenticated, set count to 0 and cart to an empty array
        $count = 0; 
        $cart = []; 
    }

    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'message' => 'required|string|max:1000',
    ]);

    // Send the email
    Mail::send('emails.contact', [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'user_message' => $request->message,
    ], function($message) use ($request) {
        $message->to('kasayedesu19@gmail.com')
                 ->subject('Contact Form Submission from ' . $request->name);
    });

    return back()->with('success', 'Message sent successfully!');
}



public function showContactForm()
{
    if (Auth::check()) {
        // User is authenticated, count products in cart
        $count = ProductCart::where("user_id", Auth::id())->count();
        $cart = ProductCart::where('user_id', Auth::id())->get();
    } else {
        // User is not authenticated, set count to 0 and cart to an empty array
        $count = 0; // Initialize as 0
        $cart = []; // Initialize as an empty array
    }
    return view('emailreciever', compact('count'));
}

}
