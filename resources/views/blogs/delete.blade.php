@extends('layouts.app')
@section('content')
<form action="{{ route('destroy_blog_path',['id'=>$blog->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{$blog->title}}" readonly>
    </div>


    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" rows="10" class="form-control" readonly>{{$blog->content}}</textarea>
    </div>

    <div class="form-group">
        <p class='lead'>
            <dl class='dl-horizontal'>
                @if($blog->category_id!=NULL)
                    <dt>Category:</dt>
                    <dd>{{$blog->category->name}}</dd>
                @endif
            </dl>
        </p>
    </div>

    <div class="form-group">
        @if (!is_null($blog->image))
            <label for="featured_image">Featured Image</label><br>
            <img src="{{asset('images/' . $blog->image)}}">
        @endif
    </div>

    <div class="form-group">
        <a href="{{route('blog_path',['id'=>$blog->id])}}" class="btn btn-outline-primary"> Back</a>
        <button type="submit" class="btn btn-outline-primary">Delete</button>
    </div>
</form>

@endsection
