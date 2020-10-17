@extends('layouts.app')
@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Kufam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
    <style>
        #cont {
            background-color:white;

        }
    </style>
</head>
<br>

<div class="container" id="cont">
    <form action="{{ route('update_blog_path',['id'=>$blog->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title" style=" font-family: 'Raleway', sans-serif; font-size:20px;">Title</label>

            @if(old('title')==Null)
                <input type="text" name="title" class="form-control" required maxlength="200" value="{{$blog->title}}" style="font-size:15px;">
            @else
                <input type="text" name="title" class="form-control" required maxlength="200" value="{{old('title')}}" style="font-size:15px;">
            @endif

        </div>


        <div class="form-group">
            <label for="content" style=" font-family: 'Raleway', sans-serif; font-size:20px;">Content</label>
            @if(old('content')==Null)
                <textarea name="content" rows="10" class="form-control" style="font-size:15px;" required>{{$blog->content}}</textarea>
            @else
                <textarea name="content" rows="10" class="form-control" style="font-size:15px;" required>{{old('content')}}</textarea>
            @endif
            
        </div>
-
        <div class="form-group">
            <label for="category">Select a Category</label><br>
            <select class='form-control' name='category_id'>
                @if($blog->category_id!=NULL)
                    <option value='{{$blog->category_id}}' selected disabled hidden>{{$blog->category->name}}</option> 
                @else
                    <option value='' selected disabled hidden>None</option> 
                @endif
                <option value=''>None</option> 
                @foreach($categories  as $category)
                    <option value='{{ $category->id }}'>{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            @if (!is_null($blog->image))
                <label for="title" style=" font-family: 'Raleway', sans-serif; font-size:20px;">Current Image</label><br>
                <img src="{{asset('images/' . $blog->image)}}">
            @endif
        </div>

        <div class="form-group">
            <label for="title" style=" font-family: 'Raleway', sans-serif; font-size:20px;">Update Image</label><br>
            <input type="file" name="featured_image" class="@error('featured_image') is-invalid @enderror">
            @error('featured_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <a href="{{route('blog_path',['id'=>$blog->id])}}" class="btn btn-outline-primary"> Back</a>
            <button type="submit" class="btn btn-outline-primary">Edit Blog Post</button>
        </div>
    </form>
</div>
@endsection

