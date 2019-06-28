@extends('layouts.admin')

@section('admin')
    <div class="   mt-4">
        <h4 class="text-center">Order Details</h4>
        <div class="row">

            <div class="col-md-5">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-list"></i> Customer Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" >
                            <thead class='text-truncate'>
                                <th><i class="fa fa-user"></i> Accountant</th>
                                <th><i class="fa fa-mobile"></i> Mobile</th>
                            </thead>
                            <tbody>
                                <td>{{$order->creator }}</td>
                                <td>{{$shipping->mobile }}</td>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-list"></i> Shipping Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive" >
                            <thead class='text-truncate'>
                                <th><i class="fa fa-user"></i> Customer</th>
                                <th><i class="fa fa-user"></i> Address</th>
                                <th><i class="fa fa-mobile"></i> Mobile</th>
                                <th><i class="fa fa-envelope"></i> Email</th>
                            </thead>
                            <tbody>
                                <td>{{$shipping->name}}</td>
                                <td>
                                {{$shipping->address}}, 
                                    {{$shipping->city}}
                                </td>
                                <td>{{$shipping->mobile}}</td>
                                <td>{{$shipping->email}}</td>
                            </tbody>
                        </table>
                        <a href="/admin/shipping/{{$shipping->id}}/edit" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fa fa-shopping-basket"></i> Order Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive" >
                            <thead class='text-truncate'>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>SubTotal</th>
                                <td>Action</td>
                            </thead>
                            @php
                                $total = 0;
                            @endphp
                                @foreach ($orderDetails as $order)
                                    <tbody>
                                        <td>{{$order->product}}</td>
                                        <td>{{$order->product_name}}</td>
                                        <td>{{number_format($order->product_price,2)}}$</td>
                                        <td>{{$order->product_qty}}</td>
                                        <td>{{number_format($order->product_price * $order->product_qty,2)}}$</td>
                                        <td>
                                            <a href="/order/{{$order->id}}/edit" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                            <form class='d-inline' action="/order/{{$order->id}}" method='POST'>
                                                @csrf
                                                @method('DELETE')
                                                <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tbody>
                                    @php
                                        $total = $total + ($order->product_price * $order->product_qty)
                                    @endphp
                                @endforeach
                        </table>
                        <strong>Total:</strong> {{number_format($total,2)}}$
                    </div>
                </div>
            </div>

        </div>
    
        <a href='/orders' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Go Back
        </a>
    </div>
@endsection