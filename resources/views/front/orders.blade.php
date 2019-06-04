@extends('layouts.app')
@section('content')
    <div class="   mt-4">
        <h5 class="text-center">Your Orders</h5>
        <div class="card my-3">
            <div class="card-header">
                <i class="fa fa-shopping-basket"></i> Order Details
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm" >
                @if(count($orderDetails) > 0)
                    <thead class='text-truncate'>
                        <th>Series</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
                    </thead>
                        @foreach ($orderDetails as $order)
                            <tbody>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$order->product_name}}</td>
                                <td>{{number_format($order->product_price,2)}}$</td>
                                <td>{{$order->product_qty}}</td>
                                <td>{{number_format($order->product_price * $order->product_qty,2)}}$</td>
                            </tbody>
                        @endforeach
                    @else
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Orders</p>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection