@extends('layouts.admin')

@section('admin')
<div class="mt-4">
        <h5 class="text-center"></h5>
        <div class="card">
            <div class="card-header">
                <h6>{{$user->name}}</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                <li>
                    <strong><i class="fa fa-id-card"></i> ID: </strong>  {{$user->id}}
                </li>
                <li>
                    <strong><i class="fa fa-tag"></i> Name: </strong> {{$user->name}}
                </li>
                <li>
                    <strong><i class="fa fa-list-alt"></i> E-mail: </strong>  {{$user->email}}
                </li>
                <li>
                    <strong><i class="fa fa-lock"></i> Status: </strong>
                        @if ($user->active==1) <span class="badge badge-success">Active</span>
                        @else <span class="badge badge-danger">Pending</span>
                        @endif
                </li>
                <li>
                    <strong><i class="fa fa-user"></i> Register at: </strong> {{$user->created_at}}
                </li>
            </ul>
            </div>
        </div>
        <a href='/admin/members' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Go Back
        </a>
    </div>
@endsection