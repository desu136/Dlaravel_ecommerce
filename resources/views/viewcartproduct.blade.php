@extends('maindesign')
<base href="/public">
@section('viewcart')
<style>
    /* Add custom styles for the table and images */
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        table-layout: auto;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    thead {
        background-color: #f2f2f2;
    }

    .product-image {
        max-width: 150px; /* Adjust the width as needed */
        height: auto; /* Maintain aspect ratio */
    }
</style>

<table>
    <thead> 
        <tr> 
            <th style="min-width: 100px;">Product Title</th>
            <th style="min-width: 100px;">Product Price</th>
            <th style="min-width: 150px;">Product Image</th>
            <th style="min-width: 150px;">Action</th>
        </tr> 
    </thead>
    <tbody>
        @php
            $price=0;

        @endphp
        @if($cart->isEmpty())
            <tr>
                <td colspan="3" style="text-align: center;">Your cart is empty.</td>
            </tr>
        @else
            @foreach ($cart as $cart_product)                          
                <tr> 
                    <td>{{ $cart_product->product->product_title ?? 'No title' }}</td>
                    <td>{{ $cart_product->product->product_price ?? 'No price' }}</td>
                    <td>
                        <img class="product-image" src="{{ asset('products/'.$cart_product->product->product_image ?? 'default.jpg') }}" alt="Product Image">
                    </td>
                    <td><a style="padding: 10px; background-color: red;" href="{{ route ('removeCartProducts',$cart_product->id) }}">Delete </a></td>
                </tr>
                @php
                    $price=$price+$cart_product->product->product_price;
                @endphp
            @endforeach 
            <tr> 
              <td>Total price </td> 
              <td> {{ $price }} </td> 
            </tr> 
        @endif
    </tbody>
</table>
<br><br>
@if (session('confirm_order'))
<div role="alert" style="background-color: #c6f6d5; border-color: #48bb78; color: #2f855a;" class="mb-4 border px-4 py-3 rounded relative">
    {{ session('confirm_order') }}
</div>

@endif
  <form action="{{ route ('confirm_orders') }}" method="post">
    @csrf
            <div>
              <input type="text" name="receiver_address" placeholder="Enter your Address" required />
            </div>
            <br><br>
              <input type="text" name="receiver_phone" placeholder="Enter Phone" required/>
            </div>
            <br><br>
            <div>
              <input class="btn btn-primary" type="submit"  name="submit" value="Confirm Orders" />
            </div>
            <br>
            <div>
             <a href="{{route('stripe',$price)}}"style="background:#72d8cfff; color:white; border:none; padding:12px 15px; font-size:16px; borde-radius: 4px; cursor:pointer;">pay_now</a>
            </div>
         </form>
@endsection
