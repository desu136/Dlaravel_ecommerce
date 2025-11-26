@extends("admin.maindesign")
<base href="/public">
@section('updte_category')
@if (session('update_message'))
<div role="alert" style="background-color: #c6f6d5; border-color: #48bb78; color: #2f855a;" class="mb-4 border px-4 py-3 rounded relative">
    {{ session('update_message') }}
</div>

@endif

<div class="container-fluid">
   <form method='post' action='{{ route('admin.postUpdateCategory', $category->id) }}'> 
        <input type='text' name='category' value="{{ $category->category }}">
        <input type='submit' name='submit' value='Update Category'>
        @csrf  
    </form>
</div>
@endsection
