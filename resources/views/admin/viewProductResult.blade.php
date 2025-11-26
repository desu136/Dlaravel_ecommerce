@extends('admin.maindesign')

@section('viewcategory')
@if (session('delete_message'))
<div style="margin-bottom: 10px; color: black; background-color:orangered">
{{ session('delete_message') }}    
</div>
    
@endif
 <div class="list-inline-item">
           <form  action="{{ route('admin.searchProduct') }}"method="post">
            @csrf
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; table-layout: auto;">
    <thead> 
        <tr style="background-color: #f2f2f2;"> 
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 100px;">product_title</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 200px;">product_description</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 100px;">product_quantity</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 100px;">product_price</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 150px;">product_image</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 150px;">product_category</th>
             <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 150px;">Action</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($products as $product)                          
            <tr style="border-bottom: 1px solid #ddd;"> 
                <td style="padding: 12px;">{{$product->product_title}}</td>
                <td style="padding: 12px;">{{Str::limit($product->product_discription,50)}}</td>
                <td style="padding: 12px;">{{$product->product_quantity}}</td>
                <td style="padding: 12px;">{{$product->product_price}}</td>
                <td style="padding: 12px;"><img style="max-width: 100%; height: auto;" src="{{ asset('products/'.$product->product_image) }}" alt="Product Image"></td>
                <td style="padding: 12px;">{{$product->product_category}}</td>
                  <td style="padding:12px"><a href="{{ route('admin.deleteProduct',$product->id) }}"onclick="return confirm('Are you sure to delete')" >Delete</a> 
                                      <a style="color:green"href="{{ route('admin.updateProduct',$product->id) }}"onclick="return confirm('Are you yo update')" >Update</a>
            </td>
            </tr>
        @endforeach  
        {{$products->links()  }}
    </tbody>
</table>


@endsection