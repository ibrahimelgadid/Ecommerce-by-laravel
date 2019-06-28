
@extends('layouts.admin')

@section('admin')
        <div class=" ">
            <div class="row">
                <div class="col-10 col-md-6  m-auto">

                <div class="card my-4">
                
                        <div class="card-header bg-dark text-light">
                            <h5 class='text-center'>Edit Shipping Details</h5>
                        </div>
                        <div class="card-body">
                            <form id="payment-form" action="/admin/shipping/{{$shipping->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Full Name" class="form-control @error('name') is-invalid @enderror" value="{{$shipping->name}}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{$shipping->email}}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mobile" placeholder="Enter mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{$shipping->mobile}}">
                                    @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" placeholder="Enter address" class="form-control @error('address') is-invalid @enderror" value="{{$shipping->address}}">
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" name="city" placeholder="Enter your city name" class="form-control @error('city') is-invalid @enderror" value="{{$shipping->city}}">
                                    @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="radio" class='d-none' name="payment_method" value='cash' id='cash' onclick='paymentCheck()'>
                                <label for="cash" class="mr-4"><i class="fa fa-2x text-success fa-money"></i></label>
                                <input type="radio" class='d-none' name="payment_method" value='paypal' id='paypal' onclick='paymentCheck()'>
                                <label for="paypal" class='mr-4'><i class="fa fa-2x text-info fa-cc-paypal"></i> </label>
                                <small>
                                    @error('payment_method')
                                        <div class="text-danger">{{$message }}</div>
                                    @enderror
                                </small>
                                <small class="text-muted  d-block my-2">if you want online payment click twice on stripe</small>
                                <div class="form-group">
                                    <input type="submit" value='Edit' class="btn btn-success btn-sm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection