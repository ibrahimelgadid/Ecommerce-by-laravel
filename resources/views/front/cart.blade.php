
@extends('layouts.app')
@section('content')
    <div class="my-4 mx-auto">
    {{-- @php
        echo '<pre>';
        print_r(Cart::content());
        echo '<pre>';
    @endphp --}}
     @if(count($cart)>0)
        <table style='background:#ffffff' class="table">
            <thead class='thead-dark'>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Update Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $qty = 0
                @endphp
                @foreach ($cart as $cart)
                    <tr>
                        <td>{{$cart->name}}</td>
                        <td>{{$cart->price}}</td>
                        <td>
                            {{$cart->qty}}
                        </td>
                        <td>
                            <form class='d-inline' action="/update_cart/{{$cart->rowId}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input style='width:35px;height:20px' type="number" name="qty">
                                <input  class='d-inline btn btn-info btn-sm py-0 text-white'  type="submit" value='Up'>
                            </form>
                            <form class='d-inline' action="/delete_cart/{{$cart->rowId}}" method='POST'>
                                @csrf
                                @method('DELETE')
                                <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td>
                            {{number_format($cart->total)}}
                        </td>
                    </tr>
                    @php
                        $qty = $qty + $cart->qty
                    @endphp
                    @endforeach
            </tbody>
        </table>
        <ul class="list-group my-3 ">
            <li class="list-group-item bg-dark text-light"><h5 class='text-center'>Cart Details</h5></li>
            <li class="list-group-item"><strong><i class="fa fa-calculator"></i> Total Price: </strong>{{Cart::total()}}
            
            </li>

            <li class="list-group-item"><strong><i class="fa fa-calculator"></i> Total Qty : </strong> {{$qty}}
            </li>
            <li class="list-group-item">
                <form class='d-inline' action="/clear_cart" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class='btn btn-danger delete  btn-sm py-0' type="submit" >Clear Cart <i class="fa fa-trash"></i></button>
                </form>
            </li>
        
        </ul>
        </div>
        <a href="/paypal/payment"> Buy by paypal <i class="fa fa-cc-paypal"></i></a>
        <div class="card my-4 checkout ">
            <div class="card-header bg-dark text-light">
                <h5 class='text-center'>Details for buying</h5>
            </div>
            <div class="card-body">
                <form id="payment-form" action="/checkout" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Full Name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile" placeholder="Enter mobile" class="form-control @error('mobile') is-invalid @enderror">
                        @error('mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" placeholder="Enter address" class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="city" placeholder="Enter your city name" class="form-control 
                        stripeElement stripeElement--empty @error('city') is-invalid @enderror">
                        @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input  type="radio" class='d-none' name="payment_method" value='cash'
                    @if (Session::get('method') != 'paypal') checked @endif id='cash' onclick='paymentCheck()'>
                    {{-- <label for="cash" class="mr-4"><i class="fa fa-2x text-success fa-money"></i></label> --}}
                    <input type="radio" class='d-none' name="payment_method" value='paypal'
                    @if (Session::get('method') == 'paypal') checked @endif id='paypal' onclick='paymentCheck()'>
                    {{-- <label for="paypal" class='mr-4'><i class="fa fa-2x text-info fa-cc-paypal"></i> </label> --}}
                    <small>
                        @error('payment_method')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </small>
                    <small class="text-muted  d-block my-2">if you want online payment click twice on stripe</small>


                    <div class="form-group">
                        <input type="hidden" name="qty" value='{{$qty}}'>
                        <input type="hidden" name="total" value='{{Cart::total()}}'>
                        <input type="submit"  name='billTo' value='Buy Now' class="btn btn-success btn-sm buying">
                    </div>
                </form>
            </div>

        @else
        <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no items in cart</p>
        @endif
        <a href="/" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Go Back</a>
        
    
@endsection