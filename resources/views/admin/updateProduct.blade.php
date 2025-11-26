@extends("admin.maindesign")
<base href="/public">
@section('updte_product')
@if (session('product_message'))
<div role="alert" style="background-color: #c6f6d5; border-color: #48bb78; color: #2f855a;" class="mb-4 border px-4 py-3 rounded relative">
    {{ session('product_message') }}
</div>

@endif

<div class="container-fluid">
    <form method="post" action="{{ route('admin.postUpdateProduct', $product->id) }}" enctype="multipart/form-data">
        @csrf <!-- CSRF token for security -->
        
        <div class="form-group">
            <label for="product">Product Title:</label>
            <input type="text" id="product" name="product" value="{{ old('product', $product->product_title) }}" required class="form-control"><br>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required class="form-control">{{ old('description', $product->product_discription) }}</textarea><br>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->product_quantity) }}" required class="form-control"><br>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->product_price) }}" step="0.01" required class="form-control"><br>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" class="form-control"><br>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="{{ old('category', $product->product_category) }}" required class="form-control"><br>
        </div>

        <input type="submit" name="submit" value="Update Product" class="btn btn-primary">
    </form>
</div>


@endsection