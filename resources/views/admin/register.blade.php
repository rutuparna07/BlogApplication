@extends("layouts.admin")

@section("title")
    Registered roles
@endsection

@section('content')
<nav>  
        
</nav>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registered Roles</h4>
                <form action="/search" method="put">
                    <input type="text" name="data" placeholder="Search for members">
                    <input type="submit" value="Search" class="brn btn-info">
                </form>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table>
                    <tbody class="table">
                        <tr class="primary">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User type </th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </tbody>
                    <tbody>
                        @foreach($users as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{$row->email}}</td>
                            <td>-{{$row->type}}</td>
                            <td>
                                <a href="/role-edit/{{$row->id}}" class="btn btn-secondary">EDIT</a>
                            </td>
                            <td>
                                <a href="/role-delete/{{$row->id}}" class="btn btn-danger">DELETE</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection