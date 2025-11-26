@extends('maindesign')

@section('allproduct')
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
          </div>
     
        </div>
        @endforeach
      </div>
      <div class="btn-box">
        <a href="{{ route('index') }}">
          View latest Products
        </a>
      </div>
@endsection
