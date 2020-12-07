
@extends('layouts.app')
@section('content')

@if (session()->has('status') && 'status'!='Success')
    <div class="alert alert-success" role="alert">
        <h4>{{session('status')}}</h4>
    </div>
@endif

<html style="background-image: url({{url('images/bg.png')}})">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Kufam&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
    <style>
        .btgrp {
            margin-left: 85%;
            font-size: 18px;
        }
        .btgrp a {
            text-decoration: none;
            color: gray;
        }
        .btgrp a:hover {
            font-weight: bold;
        }
        #cont {
            background-color:white;
        }
        .title {
            font-family: 'Raleway', sans-serif;
            font-size: 40px;
        }
        .lead {
            font-family: 'Kufam', cursive;
            padding: 10px 10px 10px 20px;
        }
    </style>
</head>
<div class="container" id="cont">
<div class="row">
    <div class="col-md-12">
        <br>
        <div class="titlebg"><p class="title">{{$blog->title}}</p></div>
            <div class="container">
                <p class="lead">
                    {!! $blog->content !!}
                </p>

                @if (!is_null($blog->image))
                    <img src="{{asset('images/' . $blog->image)}}" style="display: block;
                    margin-left: 20px;">
                @endif
            </div><br>
        </div>
        <p class='lead'>
            <dl class='dl-horizontal'>
                <dt>Posted:</dt>
                <dd>{{date('M j, Y g:i a',strtotime($blog->created_at)) }}</dd>
                <dt>Last Modified:</dt>
                <dd>{{date('M j, Y g:i a',strtotime($blog->updated_at)) }}</dd>
                <dt>Created By:</dt>
                <dd><a href="{{route('profile',['id'=>$blog->user_id])}}">{{DB::table('users')->where('id',$blog->user_id)->value('name')}}</a></dd>
                @if($blog->category_id!=NULL)
                    <dt>Category:</dt>
                    <dd><a href="{{route('categories.search',['id'=>$blog->category_id])}}">{{$blog->category->name}}</a></dd>
                @endif
                <dt>Views:</dt>
                <dd>{{$blog->views}}</dd>
                <dt>
                @if(Auth::user()->type=='admin')
                <a class="btn btn-outline-primary" href="{{route('reset_views',['id'=>$blog->id])}}">Reset Views</a>
                @endif
                </dt>
            </dl>
            
        </p>
        <div class="btgrp" >
            <a href="{{route('blogs_path')}}">Back</a>&nbsp;
            <a href="{{route('edit_blog_path',['id'=>$blog->id])}}">Edit</a>&nbsp;
            <a href="{{route('delete_blog_path',['id'=>$blog->id])}}" style="color: red" >Delete</a>
        </div>
    </div>
    <hr><br>
    <div class="container">
        @comments(['model' => $blog])
    </div>
    <!-- <a href="/comments/{{$blog->id}}" class="btn btn-primary">Comments</a> -->


</div>
@endsection
</html>


