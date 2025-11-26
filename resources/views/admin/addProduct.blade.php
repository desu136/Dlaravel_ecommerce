@extends("admin.maindesign")

@section('add_product')
@if (session('product_message'))
<div role="alert" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
    {{ session('product_message') }}
</div>
@endif



<div class="container-fluid">
   <form method="POST" action="{{ route('admin.postAddProduct') }}" enctype="multipart/form-data"> 
       @csrf
       <input type="text" name="product_title" placeholder="Enter product title" required><br><br>
       
       <textarea name="product_discription" placeholder="Product description" required></textarea><br><br>
       
       <input type="number" name="product_quantity" placeholder="Enter product quantity" required><br><br>
       
       <input type="number" name="product_price" placeholder="Enter product price" required><br><br>
       
       <input type="file" name="product_image" accept="image/*"><br><br>  
       
       <select name="product_category" required> 
           @foreach ($categories as $category)
               <option value="{{ $category->category }}">{{ $category->category }}</option>  
           @endforeach
       </select><br><br>
       
       <input style="background:green;" type="submit" name="submit" value="Add product">
   </form>
</div>
@endsection
