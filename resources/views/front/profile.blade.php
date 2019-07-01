@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card text-center">
            <div class="card-header">
                My Profile <a href='/profile/{{Auth::user()->id}}/edit' class='float-right btn btn-sm btn-primary'><i class='fa fa-gear text-white'></i></a>
            </div>
            <div class="card-body">
                <img style='height:200px; width:200px; border-radius:100px' class="img-fluid" src="{{(Auth::user()->userAvatar=='noimage.png') ? '/images/noimage.png' : Storage::url(Auth::user()->userAvatar)}}" alt="">
                <ul class='list-unstyled'>
                    <li>
                        <strong>ID: </strong>{{ Auth::user()->id }}
                    </li>
                    <li>
                            <strong>Name: </strong>{{ Auth::user()->name }}
                    </li>
                    <li>
                        <strong>Email: </strong>{{ Auth::user()->email }}
                    </li>
                    @if (Auth::user()->bio)
                        <li>
                            <strong>Bio: </strong>{{ Auth::user()->bio }}
                        </li>
                    @endif

                    @if (Auth::user()->facebook || Auth::user()->twitter || Auth::user()->youtube)
                        <li>
                            <strong>Social links: </strong>
                        </li>
                    @endif
                    @if (Auth::user()->facebook)
                        <a href='https://{{Auth::user()->facebook}}' class='btn btn-sm btn-primary'><i class='fa fa-lg fa-facebook'></i></a>
                    @endif

                    @if (Auth::user()->twitter)
                        <a href='{{Auth::user()->twitter}}' class='btn btn-sm btn-info'><i class='fa fa-lg fa-twitter text-white'></i></a>
                    @endif

                    @if (Auth::user()->youtube)
                        <a href='{{Auth::user()->youtube}}' class='btn btn-sm btn-danger'><i class='fa fa-lg fa-youtube text-white'></i></a>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
