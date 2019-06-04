
@extends('layouts.app')
@section('content')
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
                    <div class="col-md-6 col-sm-6 mt-2">
                        <ul class="list-unstyled">
                            <li class='my-2'>
                                <strong><i class="fa fa-product-hunt"></i> Product: </strong> {{$product->name}}
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-money"></i> Price: </strong><span class="badge badge-info text-white"> {{$product->price}}$</span>
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
                                <strong><i class="fa fa-user"></i> Creator: </strong> {{$product->admin_name}}
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-calendar"></i> Date: </strong> {{$product->created_at}}
                            </li>
                        </ul>
                        <strong><i class="fa fa-picture-o"></i> Gallary</strong>
                        @if(count($gallary) > 0)
                        
                            @foreach ($gallary as $image) 
                            <span>
                                <a href="{{Storage::url($image->image)}}" data-fancybox="gallery" data-caption="{{$image->image}}">
                                    <img class='img-fluid' style='width:50px;height:50px' src="{{Storage::url($image->image)}}" alt="" />
                                </a>
                            </span>
                            @endforeach
                        @else
                            <span class="text-danger">No gallary for this product</span>
                        @endif
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/" class="btn btn-secondary btn-sm" style="font-size:13px"><i class="fa fa-arrow-left"></i> Go Back</a>
                <a href="/carts/add/{{$product->id}}/{{$product->price }}" class="btn btn-danger btn-sm" style="font-size:13px">Add To Cart <i class="fa fa-shopping-cart"></i></a>
            </div>
        </div>
    </div>

@endsection