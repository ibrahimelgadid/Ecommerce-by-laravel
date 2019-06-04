@extends('layouts.admin')

@section('admin')
<div class="text-center mt-4">
       
    
        <h5>products Management</h5>
        <input type="text" id='search_product' class="form-control w-50 mx-auto" placeholder="Search">
        <span class="float-right m-3">
            <a href="/products/create">Add new product +</a>
        </span>
        @if (count($products) > 0)
        <table class="table table-dark table-responsive-sm searched">
            <thead>
                <tr>
                    <th>Series</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Creator</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="/products/{{$product->id}}" class="text-danger">
                        {{$product->name}}
                    </a>
                </td>
                <th><img style="width:30px;height:30px" src="{{Storage::url($product->image)}}" alt=""></th>
                <td>{{$product->price}}$</td>
                <td>{{$product->admin_name}}</td>
                <td>
                @if ($product->active==1)
                    <a href="/products/inActivate/{{$product->id}}"><i class="fa fa-thumbs-up text-success"></i></a>
                @else
                    <a href="/products/activate/{{$product->id}}"><i class="fa fa-thumbs-down text-danger"></i></a>
                @endif
        
                </td>
                <td>
                <form class='d-inline' action="{{route('products.destroy', $product->id)}}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                </form>
                <a href="/products/{{$product->id}}/edit" class="btn text-white btn-info btn-sm py-0"><i class="fa fa-edit"></i></a>
                </td>
                </tr>
                @endforeach
               
            </tbody>
        </table>
        {{ $products->links() }}
        @else
        <p class="mt-4 text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Products</p>
        @endif
    </div>

@endsection