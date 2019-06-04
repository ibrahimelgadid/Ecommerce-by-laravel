@extends('layouts.app')
@section('content')
    <div class="  my-4 mx-auto">
        <h3 class='text-center my-4'>Our Prouducts</h3>
        <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
                <h5>Categories</h5>
                <ul class="list-unstyled">

                @if(count($cats))

                    @foreach ($cats as $cat)
                        <li><a href="/getProByCat/{{$cat->id}}">{{$cat->cat_name}}</a></li>
                    @endforeach
                    @else
                        <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no categories</p>
                    @endif
                </ul>

                <h5>Brands</h5>
                <ul class="list-unstyled">
                @if(count($brands))

                    @foreach ($brands as $brand)
                        <li><a href="/getProByBrand/{{$brand->id}}">{{$brand->brand_name}}</a></li>
                    @endforeach
                    @else
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Brands</p>
                    @endif
                </ul>
                <hr class='bg-dark'>
            </div>
            
                @if(count($products))

                @foreach ($products as $pro)
                    <div class="col-lg-3 col-md-4 col-sm-4 my-2">
                        <div class="card position-relative" >
                            <span class="badge badge-success position-absolute p-1 ">{{$pro->price}}$</span>
                            <img style='height:200px' class="img-fluid" src="{{Storage::url($pro->image)}}" alt="Card image cap">
                            <div class="card-body">
                                <h6 class="card-title">{{$pro->name}}</h6>
                                <a href="/show/{{$pro->id}}" class="btn btn-info btn-sm py-1 float-left text-white" style="font-size:13px">Details</a>
                                <a href="/carts/add/{{$pro->id}}/{{$pro->price}}" class="btn btn-danger btn-sm py-1 float-right" style="font-size:13px"><i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no any products under this category</p>
                @endif
        </div>
    </div>
    @endsection