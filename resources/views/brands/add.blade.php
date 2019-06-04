@extends('layouts.admin')

@section('admin')
<div class="">
        <div class="row">
            <div class="col-10 col-md-6  m-auto">
            <div class="card my-4">
            
                    <div class="card-header">
                        <h5 class='text-muted text-center'>Add New Brand</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('brands.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="brand" placeholder="Enter brand name" class="form-control @error('brand') is-invalid @enderror">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="from-group mb-2">
                                <textarea 
                                    name="description" 
                                    placeholder="Enter brand description" 
                                    class="form-control @error('description') is-invalid @enderror"
                                ></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href='/brands' class="btn btn-sm btn-secondary">
                                    <i class="fa fa-arrow-left"></i>
                                    Go Back
                                </a>
                                <input type="submit" value='Add' class="btn btn-success btn-sm">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection