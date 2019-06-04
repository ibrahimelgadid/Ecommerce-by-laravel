@if (count($orders) > 0)
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
                        <a class="text-success" href="/order/inActivate/{{$order->id}}">YES</a>
                    @else
                        <a class="text-warning" href="/order/activate/{{$order->id}}">NO</a>
                    @endif
                </td>
                @else
                <td>DONE</td>
                @endif
                <td>
                    @if ($order->status==1)
                        <i class="fa fa-thumbs-up text-success fa"></i>
                    @else
                        <a href="/order/done/{{$order->id}}"><i class="fa fa-thumbs-down text-danger"></i></a>
                    @endif
                </td>
                <td>
                    <form class='d-inline' action="/order/{{$order->shipping}}" method='POST'>
                        @csrf
                        @method('DELETE')
                        <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                    </form>
                    <a href="/orders/show/{{$order->id}}" class="btn btn-info btn-sm text-white py-0"><i class="fa fa-info"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        {{$orders->links()}}
    @else
    <p class="mt-4 text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no orders</p>
    @endif