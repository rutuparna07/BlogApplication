@extends('layouts.app')
@section('content')
<br>

<head>
    <style>
        #cont {
            background-color:white;
        }
    </style>
    <script src="https://cdn.tiny.cloud/1/o2iga9k4nfuuydk1ttwpnj5ierzx03dxjw4iu9dv69t0q5yd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            plugins: 'link code',
            menubar: 'edit insert format table tools'
        });
    </script>
</head>
<div class="container">
    
<form action="{{ route('store_blog_path') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title" >Title</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required maxlength="40" placeholder="Enter title here">
    </div>


    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" rows="10" class="@error('content') is-invalid @enderror" placeholder="Tip: First 100 words of the blog are used as preview. Make it stand out. "> {{ old('content') }} </textarea>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
    </div>

    <div class="form-group">
        <label for="category">Select a Category</label><br>
        <select class='form-control' name='category_id'>
            <option value=''>Select a Category</option> 
            @foreach($categories  as $category)
                <option value='{{ $category->id }}'>{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="featured_image">Upload Image</label><br>
        <input type="file" name="featured_image" class="@error('featured_image') is-invalid @enderror" >
        @error('featured_image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>

    <div class="form-group">
        <a href="{{route('blogs_path')}}" class="btn btn-outline-primary"> Back</a>
        <button type="submit" class="btn btn-outline-primary">Add Blog Post</button>
    </div>

</form>
</div>
@endsection
