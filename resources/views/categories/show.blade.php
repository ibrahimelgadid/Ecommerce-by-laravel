@extends('layouts.admin')

@section('admin')
<div class="mt-4">
        <h5 class="text-center"></h5>
        <div class="card">
            <div class="card-header">
                <h6>{{$cat->admin_name}}</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                <li>
                    <strong><i class="fa fa-tag"></i> Category: </strong> {{$cat->cat_name}}
                </li>
                <li>
                    <strong><i class="fa fa-id-card"></i> ID: </strong>  {{$cat->id}}
                </li>
                <li>
                    <strong><i class="fa fa-list-alt"></i> Description: </strong>  {{$cat->description}}
                </li>
                <li>
                    <strong><i class="fa fa-lock"></i> Status: </strong>
                        @if ($cat->active==1) <span class="badge badge-success">Active</span>
                        @else <span class="badge badge-danger">Pending</span>
                        @endif
                </li>
                <li>
                    <strong><i class="fa fa-user"></i> Creator: </strong> {{$cat->admin_name}}
                </li>
                <li>
                    <strong><i class="fa fa-calendar"></i> Date: </strong> {{$cat->created_at}}
                </li>
            </ul>
            </div>
        </div>
        <a href='/admin/categories' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Go Back
        </a>
    </div>
@endsection