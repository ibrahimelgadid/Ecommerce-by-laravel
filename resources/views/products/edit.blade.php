@extends('layouts.admin')

@section('admin')
<div class=" ">
    <div class="row">
        <div class="col-10 col-md-6  m-auto">
        
        <div class="card my-4">
        
                <div class="card-header">
                    <h5 class='text-muted text-center'>Edit Product</h5>
                </div>
                <div class="card-body">
                    <form  enctype="multipart/form-data" action="{{route('products.update', $product->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" name="product" 
                            placeholder="Enter product name" value="{{$product->name}}"
                            class="form-control @error('product') is-invalid @enderror">
                            @error('product')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="color" placeholder="Enter color name" class="form-control @error('color') is-invalid @enderror" value="{{$product->color}}">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="size" placeholder="Enter size name" class="form-control @error('size') is-invalid @enderror" value="{{$product->size}}">
                            @error('size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="number" name="price" placeholder="Enter product price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="input-group mb-3">
                            <div class="custom-file"> --}}
                                <input type="hidden" name="oldImg" value="{{$product->image}}">
                                <input name='image' type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile01" >
                                <label class="custom-file-label" for="inputGroupFile01">Choose image</label>
                            {{-- </div>
                        </div> --}}
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            
                            <select class="custom-select @error('category') is-invalid @enderror" id="inputGroupSelect01" name='category'>
                                <option value="" >Choose...</option>
                                    @foreach ($cats as $cat)
                                        <option  value="{{$cat->id}}"
                                        @if($product->cat_id == $cat->id) selected @endif >
                                        {{$cat->cat_name}}
                                        </option>
                                    @endforeach
                            </select>
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Category</label>
                            </div>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            
                            <select class="custom-select @error('brand') is-invalid @enderror" id="inputGroupSelect01" id="inputGroupSelect01" name='brand'>
                                <option value="" >Choose...</option>
                                    @foreach ($brands as $brand) 
                                        <option  value="{{$brand->id}}"
                                                @if($product->brand_id == $brand->id) selected @endif>
                                            {{$brand->brand_name}}
                                        </option>
                                    @endforeach
                            </select>
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Brand</label>
                            </div>
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="from-group mb-2">
                            <textarea 
                                name="description"
                                placeholder="Enter product description" 
                                class="form-control @error('description') is-invalid @enderror"
                            >{{$product->description}}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                        <a href='/admin/products' class="btn btn-sm btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            Go Back
                        </a>
                            <input type="submit" value='Edit' class="btn btn-success btn-sm">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection