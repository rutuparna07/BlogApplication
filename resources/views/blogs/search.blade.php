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
                          <dd>{{DB::table('categories')->where('id',$blog->category_id)->value('name')}}</dd>
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

<div class="btgrp" >
        <a href="{{route('blogs_path')}}" class="btn btn-outline-primary">Back</a>&nbsp;
</div>
    

</div>
@endsection