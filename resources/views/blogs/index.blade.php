@extends('layouts.app')
@section('content')


@if(session()->has('status') && 'status'!='Success')
    <div class="alert alert-success" role="alert">
        <h4>{{session('status')}}</h4>
    </div>
@endif
<head>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        *,
        *::before,
        *::after {
          box-sizing: border-box;
        }
        #carouselExampleCaptions{
          position: relative;
        }
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
            z-index: 9999;
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
        .search {
            display: none;
        }
        .categ{
            padding: 10px 38px;
            border: 1px black;
            background-color: white;
            color: black;
            border: 2px solid #000000;
            border-radius: 4px;
        }
        .categ:hover{
            background-color: black;
            color: white;
            text-decoration: none;
        }
        #options{
            margin-left: 50px;
        }
        #searchbar{
            margin-left: 50px;
        }
        .search_box{
            background: transparent;  
            border: none;
            border-bottom: 3px solid rgba(141, 141, 141, 0.521);
        }
        #searchbtn{
          margin-left: 310px;
          margin-top: -60px;
        }
        .checkout{
          color: whitesmoke;
        }
        .checkout:hover{
          text-decoration: none;
          color: pink;
        }
        .secondbg{
          z-index: 0;
        }
        #overlay{
          width: 100%;
          height: 100%;
          background: rgb(0,0,0);
          background: linear-gradient(90deg, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 62%, rgba(0,0,0,1) 100%);
          z-index: 1;
        }
        #trend{
          margin-top: 250px;
        }
    </style>
</head>
<body>
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            </ol>
              <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{url('/images/one.jpg')}}" class="d-block w-100" alt="..." height="820px" style="overflow: hidden;">
              <div class="carousel-caption d-none d-md-block">
                <h1 style="color: rgba(255, 255, 255, 0.418)">Get Started Today</h1>
                <a href="#searchmodel" class="checkout">Checkout Recent Blogs </a>
              </div>
            </div>
            
            @foreach ($blogs as $blog)
            @if ($blog->views===$top)
            <div class="carousel-item" >
              
                <div class="secondbg">
                  <img src="{{asset('images/' . $blog->image)}}" class="d-block w-100" alt="..." height="820px" style="overflow: hidden;">
                </div>
                <div class="carousel-caption d-none d-md-block" id="overlay" >
                  <p class="display-4" id="trend"><span class="display-4" id="trend" style="color: plum;">TRENDING</span> TODAY</p>
                  
                    <a href="{{route('blog_path',['id'=>$blog->id])}}" style="text-decoration: none; color:whitesmoke;">
                        <h1>{{$blog->title}}</h1>
                    </a>
                </div>
                  
            </div>
            </div>
            @endif
            @endforeach
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
      </div> 
    
  <br> <br>
<div id="searchmodel">
  <div id="searchbar">
    <div class="member search" style="display: inline-block">  
      <form action="/search" method="put">
          <input type="text" class="search_box" name="data" placeholder="Search for members" style="width: 300px">&nbsp;
          <input type="submit" value="Search" class="btn btn-outline-dark" >
      </form>
    </div>
    <div class="category search" >
      <form action="{{route('category.search')}}" method='GET' >
      @csrf
        <br>
        <select class='form-control' name='category_id' class="search_box" style="width: 300px; border: transparent;">
            <option value='EMPTY' selected >Select a Category</option>
            @foreach($categories  as $category)
                <option value='{{ $category->id }}'>{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-outline-dark" id="searchbtn" >Search</button>
      </form>
    </div>
    <div class="title search">
      <form action="{{ route('title.search') }}" method="POST">
      @csrf
      @method('PUT')
          <input type="text" name="title" class="search_box" required maxlength="200" placeholder="Search for titles" style="width: 300px">&nbsp;
          <button type="submit" class="btn btn-outline-dark" >Search</button>
      
      </form>
    </div>
  </div>
  <br>
  <div id="options" style="display: inline-block">
    <label> 
        <input type="radio" name="searchby" 
               value="member"> By Member</label> &nbsp;
    <label> 
        <input type="radio" name="searchby" 
               value="title"> By Title</label> &nbsp;
    <label> 
        <input type="radio" name="searchby" 
               value="category"> By Category</label> &nbsp;
  </div> 
</div>
  <div class="container">
  <div class="row">
     
      <!--"btn btn-outline-info"-->
      <div id="mybutton">
        @if(Auth::user()->type=='admin')
          <a href="{{route('categories.index')}}" class="categ" >Categories</a><br><br>
        @endif
          <a href="{{route('create_blog_path')}}" class="create" >Create New Blog</a>
      </div>
      @if(($blogs->count()) == 0)
          <h1>No Blogs Available</h1>
      @endif

          
      @foreach($blogs->reverse() as $blog)
          <div class="col-md-4" id="card">
              <div class="card" >
                  <div class="card-header">
                      <a href="{{route('blog_path',['id'=>$blog->id])}}">{{ $blog->title}}</a>
                  </div>
                  <div class="card" >
                  @if (!is_null($blog->image))
                  <img src="{{asset('images/' . $blog->image)}}" style="height:300px";>
                  @else
                  <svg class="bd-placeholder-img card-img" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Card image" preserveAspectRatio="xMidYMid slice" role="img">
                  <title>Placeholder</title>
                  <?php 
                      $color = '#0F0'. substr(str_shuffle('AB0123456789'), 0, 3);
                  ?>
                  <rect width="100%" height="100%" fill="<?= $color ?>" id="card-blur"/>
                  <text x="5%" y="50%" fill="#dee2e6" dy=".3em" style="font-size: 30vw;">{{ $blog->title}}</text></svg>
                  @endif
                  </div>

                    <div class="card-body">
                      {{ substr(strip_tags($blog->content),0,100) }}
                      <br>
                      <p class='lead'>
                      <dl class='dl-horizontal'>
                          <dt>Posted:</dt>
                          <dd>{{date('M j, Y g:i a',strtotime($blog->created_at)) }}</dd>
                          <dt>last Updated:</dt>
                          <dd>{{date('M j, Y g:i a',strtotime($blog->updated_at)) }}</dd>
                          <dt>Created By:</dt>
                          <dd><a href="{{route('profile',['id'=>$blog->user_id])}}">{{DB::table('users')->where('id',$blog->user_id)->value('name')}}</a></dd>
                          @if($blog->category_id!=NULL)
                            <dt>Category:</dt>
                            <dd>{{$blog->category->name}}</dd>
                          @endif
                          <dt>Views:</dt>
                          <dd>{{$blog->views}}</dd>
                      </dl>
                      </p>

                      <a href="{{route('blog_path',['id'=>$blog->id])}}" class="btn btn-outline-primary" style="float: right;">
                          View Post
                      </a>
                    </div>
              </div>
          </div>
      @endforeach
  </div>
  </div>
</body>
<script src="/js/myscript.js"></script>
@endsection
