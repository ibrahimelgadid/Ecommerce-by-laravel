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
                    <a href="/members/{{$member->id}}" class="text-danger">
                        {{$member->name}}
                    </a>
                </td>
                <td>{{$member->email}}</td>
                <td>
                @if ($member->active==1)
                    Active
                @else
                    Pending
                @endif
                </td>
                <td>
                    @if ($member->active==1)
                        <a class="btn btn-sm btn-success py-0" href="/members/inActivate/{{$member->id}}"><i class="fa fa-thumbs-up"></i></a>
                    @else
                        <a  class="btn btn-sm btn-secondary py-0" href="/members/activate/{{$member->id}}"><i class="fa fa-thumbs-down"></i></a>
                    @endif
                <form class='d-inline' action="{{route('members.destroy', $member->id)}}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                </form>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $members->links() }}
        @else
        <p class="mt-4 text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Members</p>
        @endif