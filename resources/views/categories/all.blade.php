@extends('layouts.admin')

@section('admin')
<div class="text-center mt-4">
       
    
        <h5>Categories Management</h5>
        <input type="text" id='search_cat' class="form-control w-50 mx-auto" placeholder="Search">
        <span class="float-right m-3">
            <a href="/admin/categories/create">Add new cat +</a>
        </span>
        @if (count($cats) > 0)
        <table class="table table-dark table-responsive-sm searched">
            <thead>
                <tr>
                    <th>Series</th>
                    <th>Name</th>
                    <th>Creator</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cats as $cat)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="/admin/categories/{{$cat->id}}" class="text-danger">
                        {{$cat->cat_name}}
                    </a>
                </td>
                <td>{{$cat->admin_name}}</td>
                <td>
                @if ($cat->active==1)
                    <a href="/admin/categories/inActivate/{{$cat->id}}"><i class="fa fa-thumbs-up text-success"></i></a>
                @else
                    <a href="/admin/categories/activate/{{$cat->id}}"><i class="fa fa-thumbs-down text-danger"></i></a>
                @endif
        
                </td>
                <td>
                <form class='d-inline' action="{{route('categories.destroy', $cat->id)}}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                </form>
                <a href="/admin/categories/{{$cat->id}}/edit" class="btn text-white btn-info btn-sm py-0"><i class="fa fa-edit"></i></a>
                </td>
                </tr>
                @endforeach
               
            </tbody>
        </table>
        {{ $cats->links() }}
        @else
        <p class="mt-4 text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Categoroes</p>
        @endif
    </div>

@endsection