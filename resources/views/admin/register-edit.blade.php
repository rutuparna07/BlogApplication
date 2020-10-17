@extends("layouts.admin")

@section("title")
    EDIT
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit role for registered User</h4><hr>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                            <form action="" method="PUT">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$users->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Give roles</label>
                                    <select name="type" class="form-control">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <button formaction="/role-update/{{ $users->id }}" type="submit" class="btn btn-success" value="Goto URL">Update</button>
                                <a href="/role-register" class="btn btn-danger">Cancel</a>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection