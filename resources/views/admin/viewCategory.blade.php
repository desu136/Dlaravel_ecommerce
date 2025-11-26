@extends('admin.maindesign')

@section('viewcategory')
@if (session('deletecategory_message'))
<div style="margin-bottom: 10px; color: black; background-color:orangered">
{{ session('deletecategory_message') }}    
</div>
    
@endif
<table style="width: 100%; border-collapse:collapse; font-family:arial,sans-serif;">
    <thead> 
        <tr style="background-color:#f2f2f2;"> 
     <th style="padding:12px; text-align:left; border-bottom: 1px solid #ddd;">Category ID </th>
    <th style="padding:12px; text-align:left; border-bottom: 1px solid #ddd;">Category name </th>
      <th style="padding:12px; text-align:left; border-bottom: 1px solid #ddd;">Action </th>
        </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category )                          
          <tr style="border-bottom: 1px solid #ddd;"> 
            <td style="padding:12px">{{$category->id }}</td>
             <td style="padding:12px">{{$category->category }}</td>
             <td style="padding:12px"><a href="{{ route('admin.deleteCategory',$category->id )}}"onclick="return confirm('Are you yo delete')" >Delete</a> 
                                      <a style="color:green"href="{{ route('admin.updateCategory',$category->id )}}"onclick="return confirm('Are you yo update')" >Update</a>
            </td>

          </tr>
      @endforeach  
    </tbody>
    </table>
@endsection