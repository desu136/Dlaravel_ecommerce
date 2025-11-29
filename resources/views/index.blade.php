 @extends('maindesign')
 @section('index')
 
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      
      <div class="row">
@foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{ route('product_details',$product->id) }}">
              <div class="img-box">
                <img src="{{ asset('products/'.$product->product_image) }}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  {{ $product->product_title }}
                </h6>
                <h6>
                  price
                  <span>
                    {{ $product->product_price }}
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
            <a href="{{ route('addToCart',$product->id) }}"style="background:#2a5885; color:white; border:none; padding:12px 15px; font-size:16px; borde-radius: 4px; cursor:pointer;">Add to cart</a>
            <a href="{{route('stripe',$product->product_price)}}"style="background:#72d8cfff; color:white; border:none; padding:12px 15px; font-size:16px; borde-radius: 4px; cursor:pointer;">pay_now</a>
           </div>
          </div>
     <div>

        </div>
        @endforeach
      </div>
      <div class="btn-box">
        <a href="{{ route('viewAllProducts') }}">
          View All Products
        </a>
      </div>
    </div>
  
   @endsection