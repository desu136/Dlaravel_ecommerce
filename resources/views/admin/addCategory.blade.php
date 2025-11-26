@extends("admin.maindesign")

@section('add_category')
@if (session('category_message'))
<div role="alert" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
    {{ session('category_message') }}
</div>


    
@endif
<div class="container-fluid">
   <form method='post' action='{{ route('admin.postAddCategory') }}'> 
    <input type='text' name='category' placeholder='Enter category'>
    <input type='submit' name='submit' value='Add Category'>
@csrf  
</form>
</div>

@endsection