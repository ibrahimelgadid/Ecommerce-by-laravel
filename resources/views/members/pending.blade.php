@extends('layouts.admin')

@section('admin')
<div class="text-center mt-4">
       
    
        <h5>Members Management</h5>
        <input type="text" id='search_member' class="form-control w-50 mx-auto" placeholder="Search">
        @if (count($members) > 0)
        <table class="table my-4 table-dark table-responsive-sm searched">
            <thead>
                <tr>
                    <th>Series</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="/admin/members/{{$member->id}}" class="text-danger">
                        {{$member->name}}
                    </a>
                </td>
                <td>{{$member->email}}</td>
                <td>
                    Pending
                </td>
                <td>
                    @if ( Auth::user()->super_admin === 1 )
                        <a href="/admin/members/activate/{{$member->id}}"><i class="fa fa-thumbs-down text-danger"></i></a>
                    @else
                        <small>for owner or super admin only</small>
                    @endif
                    @if ( Auth::user()->super_admin === 1 )
                        <form class='d-inline' action="{{route('members.destroy', $member->id)}}" method='POST'>
                            @csrf
                            @method('DELETE')
                            <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                        </form>
                    @else
                        <small>for owner or super admin only</small>
                    @endif
                </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $members->links() }}
        @else
        <p class="mt-4 text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Pending Members</p>
        @endif
    </div>

@endsection