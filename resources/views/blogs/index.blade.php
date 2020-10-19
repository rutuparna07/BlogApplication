@extends('layouts.app')
@section('content')


@if(session()->has('status') && 'status'!='Success')
    <div class="alert alert-success" role="alert">
        <h4>{{session('status')}}</h4>
    </div>
@endif
<head>
    <style>
        .create {
            text-decoration: none;
            background-color :#000010;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
        }
        #mybutton {
            position: fixed;
            bottom: 8px;
            right: 20px;
        }
        .create:hover {
            color: white;
            text-decoration: none;
        }
        #card {
          padding: 1% 1%;
        }
        #card-blur{
          filter: blur(50px);
        }
    </style>
</head>
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{url('/images/one.png')}}" class="d-block w-100" alt="..." height="550px">
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{url('/images/two.jpg')}}" class="d-block w-100" alt="..." height="550px">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide label</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{url('/images/three.jpg')}}" class="d-block w-100" alt="..." height="550px">
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide label</h5>
          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div> <br> <br>

<div class="form-group">
      <form action="{{ route('category.search')}}" method='POST'>
      @csrf
        <label for="category">Select a Category To Display Blogs</label><br>
        <select class='form-control' name='category_id'>
            <option value='EMPTY' selected>Select a Category (Blogs Belonging To No Category Will Be Displayed)</option>
            @foreach($categories  as $category)
                <option value='{{ $category->id }}'>{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-outline-primary">Search</button>
      </form>
</div>

<div class="form-group">
    <form action="{{ route('title.search') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Enter Title to Search</label>
        <input type="text" name="title" class="form-control" required maxlength="200">
        <button type="submit" class="btn btn-outline-primary">Search</button>
    </div>
    </form>
</div>


<div class="container">
<div class="row">
    <!--"btn btn-outline-info"-->
    <div id="mybutton">
        <a href="{{route('categories.index')}}" class="create" >Categories</a><br><br>
        <a href="{{route('create_blog_path')}}" class="create" >Create New Blog</a>
    </div>
    @if(($blogs->count()) == 0)
        <h1>No Blogs Available</h1>
    @endif
    @foreach($blogs as $blog)
        <div class="col-md-4" id="card">
            <div class="card" >
                <div class="card-header">
                    <a href="{{route('blog_path',['id'=>$blog->id])}}">{{ $blog->title}}</a>
                </div>
                <div class="card" >
                 <svg class="bd-placeholder-img card-img" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Card image" preserveAspectRatio="xMidYMid slice" role="img">
                 <title>Placeholder</title>
                 <?php 
                    $color = '#0F0'. substr(str_shuffle('AB0123456789'), 0, 3);
                 ?>
                 <rect width="100%" height="100%" fill="<?= $color ?>" id="card-blur"/>
                 <text x="5%" y="50%" fill="#dee2e6" dy=".3em" style="font-size: 30vw;">{{ $blog->title}}</text></svg>
                </div>
                  <div class="card-body">
                    {{ substr($blog->content,0,50)}}
                    <br>
                    <br>
                    <br>
                    

                    <p class='lead'>
                    <dl class='dl-horizontal'>
                        <dt>Posted:</dt>
                        <dd>{{date('M j, Y g:i a',strtotime($blog->created_at)) }}</dd>
                        <dt>last Updated:</dt>
                        <dd>{{date('M j, Y g:i a',strtotime($blog->updated_at)) }}</dd>
                        <dt>Created By:</dt>
                        <dd>{{DB::table('users')->where('id',$blog->user_id)->value('name')}}</dd>
                        @if($blog->category_id!=NULL)
                          <dt>Category:</dt>
                          <dd>{{$blog->category->name}}</dd>
                        @endif
                    </dl>
                    </p>

                    <a href="{{route('blog_path',['id'=>$blog->id])}}" class="btn btn-outline-primary">
                        View Post
                    </a>
                  </div>
            </div>
        </div>
    @endforeach
</div>

</div>
@endsection
