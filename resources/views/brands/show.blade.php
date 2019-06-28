@extends('layouts.admin')

@section('admin')
<div class="mt-4">
        <h5 class="text-center"></h5>
        <div class="card">
            <div class="card-header">
                <h6>{{$brand->admin_name}}</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                <li>
                    <strong><i class="fa fa-tag"></i> Brand: </strong> {{$brand->brand_name}}
                </li>
                <li>
                    <strong><i class="fa fa-id-card"></i> ID: </strong>  {{$brand->id}}
                </li>
                <li>
                    <strong><i class="fa fa-list-alt"></i> Description: </strong>  {{$brand->description}}
                </li>
                <li>
                    <strong><i class="fa fa-lock"></i> Status: </strong>
                        @if ($brand->active==1) <span class="badge badge-success">Active</span>
                        @else <span class="badge badge-danger">Pending</span>
                        @endif
                </li>
                <li>
                    <strong><i class="fa fa-user"></i> Creator: </strong> {{$brand->admin_name}}
                </li>
                <li>
                    <strong><i class="fa fa-calendar"></i> Date: </strong> {{$brand->created_at}}
                </li>
            </ul>
            </div>
        </div>
        <a href='/admin/brands' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Go Back
        </a>
    </div>
@endsection