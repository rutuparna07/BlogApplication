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
          float: right;
          margin-left: 310px;
          margin-top: -37px;
        }
        
    </style>
</head>
<body>     
<html style="background-image: url({{url('images/bg.png')}})">
<br>
<div class="container">
    <div class="row">
        <div class="col-md-10">
        <table class='table'>
            <thead>
                
                <tr>
                    <th><h2>Username</h2></th>
                    <th><h2>User-Type</h2></th>    
                    <th><h2>Account Created</h2></th>
                    <th><h2>Account Updated</h2></th>
                </tr>   
                
            </thead>
            <tbody>
                <tr>
                    <td><h4>{{DB::table('users')->where('id',$id)->value('name')}}</h4></td>
                    @if(DB::table('users')->where('id',$id)->value('type')=='')
                        <td><h4>Non-Admin</h4></td>
                    @else
                        <td><h4>Admin</h4></td>
                    @endif
                    <td><h4>{{date('M j,Y g:i a',strtotime(DB::table('users')->where('id',$id)->value('created_at')))}}</h4></td>
                    <td><h4>{{date('M j,Y g:i a',strtotime(DB::table('users')->where('id',$id)->value('updated_at')))}}</h4></td>
            </tbody>
        </table>


        <form action="{{ route('profileupdate',['id'=>$id])}}" method="POST">
        <h2>Rename the Account:</h2>
        @csrf
        @method('PUT')
        <table>
            <tbody>
                <td><input type="text" name="name" class="form-control" required maxlength="30"></td>
                <td><button type="submit" class="btn btn-outline-primary" onclick="return confirm('Are you sure you want to Rename your Account?');">Rename</button></td>
            </tbody>
        </table>
        </form>
        <br>


        <form action="{{ route('profiledelete',['id'=>$id])}}" method="POST">
        <h2>Delete the Account:</h2>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to Delete your Account?');">Delete</button>
        </form>
    </div>
</div>
<br><br>


<h2>{{DB::table('users')->where('id',$id)->value('name')}}'s Blogs:</h2>
<div class="container">
    <div class="row">

    @foreach($blogs->reverse() as $blog)
        @if ($blog->user_id==$id)
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
                          <dd>{{DB::table('users')->where('id',$blog->user_id)->value('name')}}</dd>
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
        @endif
    @endforeach
    <div class="btgrp" >
        <a href="{{route('blogs_path')}}" class="btn btn-outline-primary">Back</a>&nbsp;
    </div>
</div>
</div>

</body>
<script src="/js/myscript.js"></script>
@endsection
