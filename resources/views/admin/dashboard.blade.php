@extends('layouts.admin')

@section('admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <ul>
                        <li>
                            <strong>ID: </strong>{{ Auth::user()->id }}
                        </li>
                        <li>
                                <strong>Name: </strong>{{ Auth::user()->name }}
                        </li>
                        <li>
                            <strong>Email: </strong>{{ Auth::user()->email }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
