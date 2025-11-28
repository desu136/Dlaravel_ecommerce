<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Orders;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminController extends Controller
{
   public function addCategory(){
    return view('admin.addCategory');
   }

   public function postAddCategory(Request $request){
      $category=new Category();
      $category->category=$request->category;
      $category->save();
      return redirect()->back()->with('category_message','category added successfully!');
   }
 public function viewCategory(){

   $categories=Category::all();
   return view('admin.viewCategory',compact('categories'));
 }
 public function deleteCategory($id){
$category=Category::findOrFail($id);
$category->delete();
return redirect()->back()->with('deletecategory_message, delete successfully!');
 }

 public function updateCategory($id){
   $category=Category::findOrFail($id);
   return view('admin.updateCategory', compact('category'));

 }

  public function postUpdateCategory(Request $request,$id){
    $category=Category::findOrFail($id);   
   
      $category->category=$request->category;
      $category->save();
      return redirect()->back()->with('update_message','category update successfully!');
   }

   public function addProduct(){
    $categories=Category::all();
   return view('admin.addProduct',compact('categories'));
   
   }

 public function postAddProduct(Request $request) {
    try {
        // Validate the request
        $request->validate([
            'product_title' => 'required|string|max:255',
            'product_discription' => 'required|string',
            'product_quantity' => 'required|integer',
            'product_price' => 'required|numeric',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'product_category' => 'required|string|max:255'
        ]);

        $product = new Product();
        $product->product_title = $request->product_title;
        $product->product_discription = $request->product_discription;
        $product->product_quantity = $request->product_quantity; 
        $product->product_price = $request->product_price;

        $image = $request->file('product_image');
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('products', $imageName);
            $product->product_image = $imageName;
        }

        $product->product_category = $request->product_category;
        $product->save();

        return redirect()->back()->with('product_message', 'Product added successfully');
    } catch (\Exception $e) {
        \Log::error('Error adding product: ' . $e->getMessage());
        return redirect()->back()->with('product_message', 'Error adding product: ' . $e->getMessage());
    }
}
public function viewProduct(){
 $products=Product::paginate(3);
 return view('admin.viewProductResult',compact('products'));

}

public function delete_product($id){
  $product=Product::findOrFail($id);
  $product->delete();
  return redirect()->back()->with('delete_message','product is successful deleted');
}

public function updateProduct($id){
$product=Product::findOrFail($id);
return view("admin.updateProduct",compact('product'));
}

public function postUpdateProduct(Request $request, $id) {
    try {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Validate the request
        $request->validate([
            'product' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category' => 'required|string|max:255'
        ]);

        // Update product details
        $product->product_title = $request->product;
        $product->product_discription = $request->description; 
        $product->product_quantity = $request->quantity; 
        $product->product_price = $request->price;

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
            $product->product_image = $imageName; // Update with new image name
        }

        $product->product_category = $request->category;
        $product->save();

        return redirect()->back()->with('product_message', 'Product updated successfully');
    } catch (\Exception $e) {
        \Log::error('Error updating product: ' . $e->getMessage());
        return redirect()->back()->with('product_message', 'Error updating product: ' . $e->getMessage());
    }
}
public function searchProduct(Request $request){
  $products=Product::where('product_title','LIKE','%'.$request->search.'%')
                     ->orwhere('product_discription','LIKE','%'.$request->search.'%')
                     ->orwhere('product_category','LIKE','%'.$request->search.'%')->paginate(2);
  return view('admin.viewProductResult',compact('products'));
}
public function viewOrders(){
  $orders=Orders::all();
  return view('admin.veiwOrders',compact('orders'));
}
public function changeStatus(Request $request,$id){
$order=Orders::findOrFail($id);
$order->status=$request->status;
$order->save();
return redirect()->back();
}
public function downloadPdf($id){
  $data=Orders::findOrFail($id);
$pdf = Pdf::loadView('admin.invoice', compact('data'));
    return $pdf->download('invoice.pdf');
}
}
