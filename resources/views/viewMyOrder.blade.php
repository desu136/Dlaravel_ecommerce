
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
          <table style="margin-left: 80px; width: 80%; border-collapse: collapse; font-family: Arial, sans-serif; table-layout: auto;">
    <thead> 
        <tr style="background-color: #968d8dff;"> 
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
            <tr style="border-bottom: 1px solid #ddd; background-color: #f2f2f2; "> 
                 <td style="padding: 12px;">{{$order->user->name}}</td>
                <td style="padding: 12px;">{{$order->receiver_address}}</td>
                <td style="padding: 12px;">{{$order->receiver_phone}}</td>
                <td style="padding: 12px;">{{$order->product->product_title}}</td>
                <td style="padding: 12px;">{{$order->product->product_price}}</td>
                <td style="padding: 12px;"><img style="max-width: 100%; height: auto;" src="{{ asset('products/'.$order->product->product_image) }}" alt="Product Image"></td>
                
            <td style="padding:12px">
             {{$order->status}}

            </td>
            
            </tr>
        @endforeach  
        
    </tbody>
</table>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
