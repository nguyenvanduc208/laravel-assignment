{{-- Home sẽ kế thừ viiew master --}}
@extends('layout.master')
{{-- section sẽ thay đổi phần yeild trong master --}}
@section('title', 'Product page')
@section('content-title', 'Product page')
@section('content')
<div>
    <a href="{{route('products.add')}}">
        <button class="btn btn-primary">Create</button>
    </a>
</div>

<table class="table table-hover">
    
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Image</th>
        <th>Status</th>
        <th>Acction</th>
        
        
    </thead>
    <tbody>
     @foreach ($products as $product) 
              
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price ?: 'N/A'}}</td>
            <td>{{$product->category->name}}</td>
            <td><img src="{{$product->image_url}}" width="90" height="90" alt=""></td>
            <td>{{ $product->status == 1 ? 'Active' : 'Disabled' }}</td>
            <td>
                <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning">
                    Edit
                </a>
                    <form
                    action="{{route('products.delete', $product->id)}}"
                    method="POST">
                    @method('DELETE')
                    {{-- <input type="text" name="_method" value="DELETE"> --}}
                    @csrf
                    {{-- <input type="text" name="csrf_token" value="asdadasd"> --}}
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>
                </td>       
        </tr>             
     @endforeach          
    </tbody>
</table>
 {{ $products->links() }}

@endsection
