@extends('layouts.admin')

@section('admin')
    <div class="  text-center mt-4">

        <h5>Orders Management</h5>
        <input type="text" id='search_order' class="form-control w-50 mx-auto my-4" placeholder="Search">
        @if(count($orders)>0) 
        <table class="table table-dark table-responsive-md searched">
            <thead class='text-truncate'>
                <tr>
                    <th>#ID</th>
                    <th>Customer Name</th>
                    <th>Order Total</th>
                    <th>Payment Method</th>
                    <th>Active?</th>
                    <th>Done?</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $orders as $order )                      
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->creator}}</td>
                    <td>{{$order->total}}$</td>
                    <td>{{$order->payment_method}}</td>
                    @if ($order->status==0)
                    <td>
                        @if ($order->active==1)
                            <a class="text-success" href="/admin/order/inActivate/{{$order->id}}">YES</a>
                        @else
                            <a class="text-warning" href="/admin/order/activate/{{$order->id}}">NO</a>
                        @endif
                    </td>
                    @else
                    <td class="text-success">DONE</td>
                    @endif
                    <td>
                        @if ($order->status==1)
                            <i class="fa fa-thumbs-up text-success fa"></i>
                        @else
                            <a href="/admin/order/done/{{$order->id}}" class="done"><i class="fa fa-thumbs-down text-danger"></i></a>
                        @endif
                    </td>
                    <td>
                        <form class='d-inline' action="/shipping/{{$order->shipping}}" method='POST'>
                            @csrf
                            @method('DELETE')
                            <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                        </form>
                        <a href="/admin/orders/{{$order->id}}" class="btn btn-info btn-sm text-white py-0"><i class="fa fa-info"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Orders</p>
        @endif 
    </div>
@endsection