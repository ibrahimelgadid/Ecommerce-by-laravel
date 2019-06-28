@extends('layouts.admin')

@section('admin')
<div class="mt-4">
        <h5 class="text-center">{{$product->name}}</h5>
        <div class="card">
            <div class="card-header">
                <h6>{{$product->name}}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <img src="{{Storage::url($product->image)}}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul class="list-unstyled">
                            <li class='my-2'>
                                <strong><i class="fa fa-product-hunt"></i> Product: </strong> {{$product->name}}
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-money"></i> Price: </strong><span class="badge badge-info text-white"> {{$product->price}}
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-id-card"></i> ID: </strong> {{$product->id}}
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-heart"></i> Color: </strong> {{$product->color}}
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-black-tie"></i> Size: </strong> {{$product->size}}
                            </li>
                            <li class='my-2'>
                            <li class='my-2'>
                                <strong><i class="fa fa-suitcase"></i> Brand: </strong> {{$product->brand_name}}
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-tag"></i> Category: </strong> {{$product->cat_name}}
                            </li>
                                <strong><i class="fa fa-list-alt"></i> Description: </strong> {{$product->description}}
                            </li>
                            <li class='my-2'>
                            <strong><i class="fa fa-lock"></i> Status: </strong> 
                            @if ($product->active==1)
                                <span class="badge badge-success">Active</span> 
                            @else
                            <span class="badge badge-sdanger">InActive</span> 
                            @endif
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-user"></i> Creator: </strong> {{$product->admin_name}}
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-calendar"></i> Date: </strong> {{$product->created_at}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        
        <h5 class='text-center mt-4'>Product Gallary</h5>
        @if(count($gallary) > 0)
            <div>
                <a href="/admin/products/deleteGallary/{{$product->id}}" class=" delete btn btn-sm btn-danger">Delete Gallary</a>
            </div>
            <div class='row text-center'>
                @foreach ($gallary as $image) 
                <div class='col-sm-6 col-md-3 my-4'>
                    <a href="{{Storage::url($image->image)}}" data-fancybox="gallery" data-caption="{{$image->image}}">
                        <img class='img-fluid' style='height:200px' src="{{Storage::url($image->image)}}" alt="" />
                    </a>
                    <div>
                    <a href="/admin/products/deleteGallaryImage/{{$image->id}}" class="delete btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
        <form 
            action="/admin/products/upload_images/{{$product->id}}" 
            class="dropzone my-2" 
            method="POST"
            id="myAwesomeDropzone"
            
        >
        @csrf
        <div class="fallback">
            <input type="file" name="file" >
        </div>
        </form>
        <a href='/admin/products' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Go Back
        </a>
    </div>
@endsection