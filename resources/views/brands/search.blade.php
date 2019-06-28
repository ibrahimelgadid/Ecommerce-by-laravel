@if (count($brands) > 0)
        <table class="table table-dark table-responsive-sm searched">
            <thead>
                <tr>
                    <th>Series</th>
                    <th>Name</th>
                    <th>Creator</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="/admin/brands/{{$brand->id}}" class="text-danger">
                        {{$brand->brand_name}}
                    </a>
                </td>
                <td>{{$brand->admin_name}}</td>
                <td>
                @if ($brand->active==1)
                    <a href="/admin/brands/inActivate/{{$brand->id}}"><i class="fa fa-thumbs-up text-success"></i></a>
                @else
                    <a href="/admin/brands/activate/{{$brand->id}}"><i class="fa fa-thumbs-down text-danger"></i></a>
                @endif
        
                </td>
                <td>
                <form class='d-inline' action="{{route('brands.destroy', $brand->id)}}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class='btn btn-danger delete  btn-sm py-0' type="submit" ><i class="fa fa-trash"></i></button>
                </form>
                <a href="/admin/brands/{{$brand->id}}/edit" class="btn text-white btn-info btn-sm py-0"><i class="fa fa-edit"></i></a>
                </td>
                </tr>
                @endforeach
            
            </tbody>
        </table>
        @else
        <p class="mt-4 text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Brands</p>
        @endif