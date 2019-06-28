@extends('layouts.admin')

@section('admin')
<div class="text-center mt-4">
       
    
        <h5>Sliders Management</h5>
        <span class="float-right m-3">
            <a href="/admin/sliders/create">Add new slider +</a>
        </span>
        @if (count($sliders) > 0)
        <table class="table table-dark table-responsive-sm searched">
            <thead>
                <tr>
                    <th>Series</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Creator</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliders as $slider)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$slider->name}}
                </td>
                <td><img style="height:30px;width:30px" src="{{Storage::url($slider->image)}}" alt=""></td>
                <td>{{$slider->admin_name}}</td>
                <td>
                @if ($slider->active==1)
                    <a href="/admin/sliders/inActivate/{{$slider->id}}"><i class="fa fa-thumbs-up text-success"></i></a>
                @else
                    <a href="/admin/sliders/activate/{{$slider->id}}"><i class="fa fa-thumbs-down text-danger"></i></a>
                @endif
        
                </td>
                <td>
                <form class='d-inline' action="{{route('sliders.destroy', $slider->id)}}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                </form>
                </td>
                </tr>
                @endforeach
               
            </tbody>
        </table>
        {{ $sliders->links() }}
        @else
        <p class="mt-4 text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Categoroes</p>
        @endif
    </div>

@endsection