@extends('maindesign')
<base href="/public">
@section('product_detail')
@if (session('cart_message'))
<div role="alert" class="alert alert-success mb-4" style="background-color: #c6f6d5; border-color: #48bb78; color: #2f855a;">
    {{ session('cart_message') }}
</div>
@endif



<div class="product-detail text-center">
    <img src="{{ asset('products/'.$product->product_image) }}" alt="{{ $product->product_title }}" class="img-fluid mb-3 product-image">      
    
    <h1 class="product-title mb-3">{{ $product->product_title }}</h1>
    
    <p class="product-description mb-3">{{ $product->product_discription }}</p>
    
    <p class="h4 text-success mb-3">Price: <span class="price">{{ $product->product_price }} Birr</span></p>
    
    <a href="{{ route('addToCart',$product->id) }}" class="btn btn-primary add-to-cart-btn">Add to Cart</a>
     <a href="{{route('stripe',$product->product_price )}}"style="background:#72d8cfff; color:white; border:none; padding:12px 15px; font-size:16px; borde-radius: 4px; cursor:pointer;">pay_now</a>
</div>

<style>
    .product-detail {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    .product-image {
        border-radius: 8px;
        transition: transform 0.3s;
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .product-title {
        font-size: 2rem;
        font-weight: bold;
        color: #2a5885;
    }

    .product-description {
        font-size: 1.1rem;
        color: #555;
    }

    .price {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .add-to-cart-btn {
        background-color: #2a5885;
        color: white;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .add-to-cart-btn:hover {
        background-color: #1e3a5f;
    }

    @media (max-width: 768px) {
        .product-detail {
            padding: 15px;
        }

        .product-title {
            font-size: 1.5rem;
        }

        .product-description {
            font-size: 1rem;
        }

        .add-to-cart-btn {
            width: 100%;
        }
    }
</style>
@endsection
