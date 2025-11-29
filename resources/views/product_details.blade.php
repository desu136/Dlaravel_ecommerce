@extends('maindesign')
<base href="/public">
@section('product_detail')
@if (session('cart_message'))
<div role="alert" style="background-color: #c6f6d5; border-color: #48bb78; color: #2f855a;" class="mb-4 border px-4 py-3 rounded relative">
    {{ session('cart_message') }}
</div>

@endif
<a href="{{ route('index') }}" class="btn btn-secondary mb-3">Back to Products</a>

<div class="text-center">
    <img src="{{ asset('products/'.$product->product_image) }}" alt="{{ $product->product_title }}" class="img-fluid mb-3">      
</div>
<div class="text-center"> 
    <h1 class="mb-3">{{ $product->product_title }}</h1>
</div>

<div class="text-center"> 
    <p class="mb-3">{{ $product->product_discription }}</p>
</div>
<div class="text-center"> 
    <p class="h4 text-success mb-3">price birr{{ $product->product_price }} </p>
</div>
<div>
<a href="{{ route('addToCart',$product->id) }}"style="background:#2a5885; color:white; border:none; padding:12px 25px; font-size:16px; borde-radius: 4px; cursor:pointer;">Add to cart</a>

</div>
@endsection
