
@extends('layouts.admin')

@section('admin')
        <div class=" ">
            <div class="row">
                <div class="col-10 col-md-6  m-auto">

                <div class="card my-4">
                
                        <div class="card-header bg-dark text-light">
                            <h5 class='text-center'>Edit Order</h5>
                        </div>
                        <div class="card-body">
                            <form  action="/admin/orders/{{$order->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" value="{{$order->product_qty}}">
                                    @error('qty')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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