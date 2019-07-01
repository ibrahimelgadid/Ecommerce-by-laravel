@extends('layouts.admin')

@section('admin')
<div class="container">

    <div class="card">
        <div class="card-header">My Info</div>
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

    <div class="row justify-content-center">
        <div class="col-md-4 col-6 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-light">Members Info</div>

                <div class="card-body">
                    <ul>
                        <li>
                            <strong>Total Members: </strong>
                            <a href='/admin/members' class='text-danger'>{{count($members)}} @if(count($members) > 1) members @else member @endif </a>
                        </li>
                        <li>
                            <strong>Active Members: </strong>
                            <a href='/admin/amembers' class='text-danger'>{{count($Amembers)}} @if(count($Pmembers) > 1) members @else member @endif </a>
                        </li>
                        <li>
                            <strong>Pending Members: </strong>
                            <a href='/admin/pmembers' class='text-danger'>{{count($Pmembers)}} @if(count($Pmembers) > 1) members @else member @endif </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-light">Categories Info</div>
                <div class="card-body">
                    <ul>
                        <li>
                            <strong>Total Categories: </strong>
                            <a href='/admin/categories' class='text-danger'>{{count($categories)}} @if(count($categories) > 1) categories @else category @endif </a>
                        </li>
                        <li>
                            <strong>Active Categories: </strong>
                            <a href='/admin/acategories' class='text-danger'>{{count($Acategories)}} @if(count($Pcategories) > 1) categories @else category @endif </a>
                        </li>
                        <li>
                            <strong>Pending Categories: </strong>
                            <a href='/admin/pcategories' class='text-danger'>{{count($Pcategories)}} @if(count($Pcategories) > 1) categories @else category @endif </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    
        <div class="col-md-4 col-6 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-light">Brands Info</div>
                <div class="card-body">
                    <ul>
                        <li>
                            <strong>Total Brands: </strong>
                            <a href='/admin/brands' class='text-danger'>{{count($brands)}} @if(count($brands) > 1) brands @else brand @endif </a>
                        </li>
                        <li>
                            <strong>Active Brands: </strong>
                            <a href='/admin/abrands' class='text-danger'>{{count($Abrands)}} @if(count($Pbrands) > 1) brands @else brand @endif </a>
                        </li>
                        <li>
                            <strong>Pending Brands: </strong>
                            <a href='/admin/pbrands' class='text-danger'>{{count($Pbrands)}} @if(count($Pbrands) > 1) brands @else brand @endif </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    
</div>
@endsection
