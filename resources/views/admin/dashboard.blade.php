@extends("layouts.admin")

@section("title")
    Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="container">
            @if (session('status'))
                    <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                    </div>
                @endif
            <h1 class="display-2" style="color: cornsilk">>Logged in as 
                <span class="display-2" style="color: tomato">admin</span>
            </h1>
            <p class="lead" style="color: cornsilk">Single stop to perform all the actions as admin, use your privileges wisely.</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection