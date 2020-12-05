@extends('layouts.app')
@section("title")
    Find Users
@endsection

@section('content')
<head>
    <style>
    </style>
</head>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-8">
            <a href="/role-register" class='btn btn-info' style="margin-bottom:10px;">Back</a>
            <div class="card">
                <div class="card-header" >
                    <h4 class="card-title" style="font-size: 40px;">Find Users</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                        </div>
                    @endif
                    <form action="/search" method="put" style="float: right;">
                        <input type="text" name="data" placeholder="Search for members">
                        <input type="submit" value="Search" class="brn btn-info">
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead class="table">
                                <tr class="primary">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User type </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table">
                                @foreach($users as $row)
                                <tr class="primary">
                                    <td> {{$row->id}}</td>
                                    <td> {{ $row->name }}</td>
                                    <td> {{$row->email}}</td>
                                    <td> {{$row->type}}</td>
                                    <form action="{{ route('profile',['id'=>$row->id] )}}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <td><button type="submit" class="btn btn-outline-primary">View Profile</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
@endsection