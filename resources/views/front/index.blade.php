
@extends('layouts.app')
@section('content')

<div class=" my-4 mx-auto">
    <form action="/search" method='POST' class='form-inline float-right'>
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="input-group-text"><i class="fa fa-search"></i></button>
            </div>
            <input type="text" name='search' class="form-control" placeholder='Search'>
        </div>
    </form>
        <h3 class='text-center my-4'>Our Prouducts</h3>
<hr>
        <div class="row">
            <div class="col-3">
                <h5>Categories</h5>
                <ul class="list-unstyled">
                @if(count($cats)>0)
                    @foreach ($cats as $cat)
                        <li><a href="/getProByCat/{{$cat->id}}">{{$cat->cat_name}}</a></li>
                    @endforeach
                @else
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no categories</p>
                @endif
                </ul>

                <h5>Brands</h5>
                <ul class="list-unstyled">
                @if(count($brands)>0)

                    @foreach ($brands as $brand)
                        <li><a href="/getProBybrand/{{$brand->id}}">{{$brand->brand_name}}</a></li>
                    @endforeach
                    @else
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Brands</p>
                    @endif
                </ul>
            </div>
            <div class="col-9">
                @if(count($products)>0)
                <div class="row">
                    @foreach ($products as $pro)
                        <div class="col-lg-3 col-md-4 col-sm-4 my-2">
                            <div class="card position-relative" >
                                <span class="badge badge-success position-absolute p-1 ">{{$pro->price}}$</span>
                                <img style='height:200px' class="img-fluid" src="{{Storage::url($pro->image)}}" alt="">
                                <div class="card-body">
                                    <h6 class="card-title">{{$pro->name}}</h6>
                                    <a href="/show/{{$pro->id}}" class="btn btn-info btn-sm py-1 text-white float-left" style="font-size:13px">Details</a>
                                    <form action="/add_cart" method="POST">
                                        @csrf
                                        <input type="hidden" name="qty" value="1">
                                        <input type="hidden" name="id" value="{{$pro->id}}">
                                        <input type="hidden" name="name" value="{{$pro->name}}">
                                        <input type="hidden" name="image" value="{{$pro->image}}">
                                        <input type="hidden" name="price" value="{{$pro->price}}">
                                        <button type="submit" class="btn btn-danger btn-sm py-1 float-right"><i class="fa fa-shopping-cart"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Products</p>
                @endif
            </div>
    
        </div>
    </div>
@endsection