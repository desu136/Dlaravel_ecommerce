@extends('admin.maindesign')
@section('veiw_orders')
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; table-layout: auto;">
    <thead> 
        <tr style="background-color: #f2f2f2;"> 
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 100px;">Customer Name</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 200px;">Address</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 100px;">Phone</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 100px;">product</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 150px;">price</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 150px;">product Image</th>
             <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; min-width: 150px;">Action</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($orders as $order)                          
            <tr style="border-bottom: 1px solid #ddd;"> 
                 <td style="padding: 12px;">{{$order->user->name}}</td>
                <td style="padding: 12px;">{{$order->receiver_address}}</td>
                <td style="padding: 12px;">{{$order->receiver_phone}}</td>
                <td style="padding: 12px;">{{$order->product->product_title}}</td>
                <td style="padding: 12px;">{{$order->product->product_price}}</td>
                <td style="padding: 12px;"><img style="max-width: 100%; height: auto;" src="{{ asset('products/'.$order->product->product_image) }}" alt="Product Image"></td>
                
            <td style="padding:12px"></td>
            
            </tr>
        @endforeach  
        
    </tbody>
</table>
@endsection