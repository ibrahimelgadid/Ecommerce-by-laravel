@extends('layouts.admin')

@section('admin')
<div class="">
        <div class="row">
            <div class="col-10 col-md-6  m-auto">
            <div class="card my-4">
            
                    <div class="card-header">
                        <h5 class='text-muted text-center'>Add New slider</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="slider" placeholder="Enter slider name" class="form-control @error('slider') is-invalid @enderror">
                                @error('slider')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input name='image' type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose image</label>
                                </div>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="from-group mb-2">
                                <textarea 
                                    name="description" 
                                    placeholder="Enter slider description" 
                                    class="form-control @error('description') is-invalid @enderror"
                                ></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href='/admin/sliders' class="btn btn-sm btn-secondary">
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