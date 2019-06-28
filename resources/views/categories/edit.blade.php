@extends('layouts.admin')

@section('admin')
<div class="">
        <div class="row">
            <div class="col-10 col-md-6  m-auto">
            <div class="card my-4">
            
                    <div class="card-header">
                        <h5 class='text-muted text-center'>Edit Category</h5>
                    </div>
                    <div class="card-body">
                    <form action="{{route('categories.update',$cat->id)}}" method="POST">
                        @csrf()
                        @method('PUT')
                            <div class="form-group">
                                <input type="text" name="category" placeholder="Enter category name" class="form-control @error('category') is-invalid @enderror" value="{{$cat->cat_name}}">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="from-group mb-2">
                                <textarea 
                                    name="description" 
                                    placeholder="Enter category description" 
                                    class="form-control @error('description') is-invalid @enderror"
                                >{{$cat->description}}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href='/admin/categories' class="btn btn-sm btn-secondary">
                                    <i class="fa fa-arrow-left"></i>
                                    Go Back
                                </a>
                                <input type="submit" name='addCategory' value='Edit' class="btn btn-success btn-sm">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection