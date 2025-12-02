@extends('admin.maindesign')
@section('veiw_orders')
<table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; table-layout: auto;">
    <thead> 
        <tr style="background-color: #f2f2f2;"> 
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Customer Name</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; ">Address</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; ;">Phone</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; ">product</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; ">price</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; ">product Image</th>
             <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; ">Action</th>
            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; ">payment_status</th>
             <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd; ">Pdf</th>
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
                
            <td style="padding:12px">
      <form action="{{ route('admin.change_status',$order->id) }}" method="post">
        @csrf 
       <select name="status" id=""> 
        <option value="{{$order->status}}"> {{$order->status}}</option>
        <option value="Delivered">  Delivered</option>
        <option value="pending">  pending</option>
       </select>
       <input type="submit" name="submit" value="submit" onclick="return confirm('Are you to submit')">
      </form>
            </td>
            <td style="padding: 12px;">{{$order->payment_status}}</td>
            <td style="padding: 12px;">
                <a class="btn btn-primary" href={{ route('admin.downloadpdf',$order->id) }}> Download pdf</a>
            </td>
            </tr>
        @endforeach  
        
    </tbody>
</table>
@endsection