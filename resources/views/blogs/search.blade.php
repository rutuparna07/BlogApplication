@extends('layouts.app')
@section('content')


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

<div class="container">
<br>
<div class="row">
<div class="col-md-8">
<div class="btgrp" >
    @if(count($blogs)==0)
    <div class="col"><h1 class="display-4 showblog">
        <svg id="bold" enable-background="new 0 0 24 24" height="50" viewBox="0 0 24 24" width="50" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 10px;">
        <g>
        <path d="m12 9h-7c-.552 0-1 .448-1 1v1.5c0 .552.448 1 1 1s1-.448 1-1v-.5h1.5v6h-.5c-.552 0-1 .448-1 1s.448 1 1 1h3c.552 0 1-.448 1-1s-.448-1-1-1h-.5v-6h1.5v.5c0 .552.448 1 1 1s1-.448 1-1v-1.5c0-.552-.448-1-1-1z"/>
        </g>
        <g>
        <path d="m19 11h-3c-.552 0-1-.448-1-1s.448-1 1-1h3c.552 0 1 .448 1 1s-.448 1-1 1z"/>
        </g>
        <g>
        <path d="m19 15h-3c-.552 0-1-.448-1-1s.448-1 1-1h3c.552 0 1 .448 1 1s-.448 1-1 1z"/></g><g>
        <path d="m19 19h-3c-.552 0-1-.448-1-1s.448-1 1-1h3c.552 0 1 .448 1 1s-.448 1-1 1z"/></g><g>
        <path d="m21 1h-18c-1.654 0-3 1.346-3 3v16c0 1.654 1.346 3 3 3h18c1.654 0 3-1.346 3-3v-16c0-1.654-1.346-3-3-3zm0 20h-18c-.551 0-1-.448-1-1v-14h20v14c0 .552-.449 1-1 1z"/></g>
        </svg>    
        No Blogs Found
                    
    </h1>
    </div>
    @else
    <div class="col"><h1 class="display-4 showblog">
        <svg id="bold" enable-background="new 0 0 24 24" height="50" viewBox="0 0 24 24" width="50" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 10px;">
        <g>
        <path d="m12 9h-7c-.552 0-1 .448-1 1v1.5c0 .552.448 1 1 1s1-.448 1-1v-.5h1.5v6h-.5c-.552 0-1 .448-1 1s.448 1 1 1h3c.552 0 1-.448 1-1s-.448-1-1-1h-.5v-6h1.5v.5c0 .552.448 1 1 1s1-.448 1-1v-1.5c0-.552-.448-1-1-1z"/>
        </g>
        <g>
        <path d="m19 11h-3c-.552 0-1-.448-1-1s.448-1 1-1h3c.552 0 1 .448 1 1s-.448 1-1 1z"/>
        </g>
        <g>
        <path d="m19 15h-3c-.552 0-1-.448-1-1s.448-1 1-1h3c.552 0 1 .448 1 1s-.448 1-1 1z"/></g><g>
        <path d="m19 19h-3c-.552 0-1-.448-1-1s.448-1 1-1h3c.552 0 1 .448 1 1s-.448 1-1 1z"/></g><g>
        <path d="m21 1h-18c-1.654 0-3 1.346-3 3v16c0 1.654 1.346 3 3 3h18c1.654 0 3-1.346 3-3v-16c0-1.654-1.346-3-3-3zm0 20h-18c-.551 0-1-.448-1-1v-14h20v14c0 .552-.449 1-1 1z"/></g>
        </svg>    
        Blogs Found:       
    </h1>
    </div>
    @endif
</div>
</div>
</div>
</div>

<div class="container">
<br>
<div class="row">
<div class="col-md-8">
<div class="btgrp" >
    <a href="{{route('blogs_path')}}" class="btn btn-outline-primary">Back</a>&nbsp;
</div>
</div>
</div>
</div>

<div class="container">
    <div class="row">
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
                {!! substr(strip_tags($blog->content),0,100) !!}
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
                      <dd><a href="{{route('categories.search',['id'=>$blog->category_id])}}">{{DB::table('categories')->where('id',$blog->category_id)->value('name')}}</a></dd>
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
@endsection