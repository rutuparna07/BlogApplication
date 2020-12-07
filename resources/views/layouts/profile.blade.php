@extends('layouts.app')
@section('content')
<html>
    @if(session()->has('status') && 'status'!='Success')
        <div class="alert alert-success" role="alert">
            <h4>{{session('status')}}</h4>
        </div>
    @endif
    <head>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            .main{
                background-color: #dedcde8c;
                height: 450px;
                box-shadow: 0 14px 15px rgba(0,0,0,0.25), 0 5px 10px rgba(0,0,0,0.22);
                margin-top: -5px;
            }
            .profile{
                margin-top: 100px;
                margin-left: 100px;
            }
            .name {
                margin-top: 50px;
                margin-left: -200px;
            }
            .more {
                margin-top: 200px;
                margin-left: 50px;
                border-left: 2px solid rgba(92, 90, 90, 0.068);
            }
            .renamebox{
                border: transparent;
                outline: none;
                background: transparent;
                border-bottom: 2px solid gray;
            }
            .renamebox:focus{
                border: transparent;
                outline: none;
                background: transparent;
                border-bottom: 2px solid rgba(0, 0, 53, 0.904);
            }
            .back{
                background: transparent;
                color: gray;
                font-size: 20px;
            }
            .back:hover{
                text-decoration: none;
                color: #070808
            }
            .showrename {
                background: transparent;
                color: gray;
                font-size: 20px;
            }
            .showrename:hover{
                text-decoration: none;
                color: #070808
            }
            .del{
                border: none;
                color:  rgb(255, 89, 89);
                font-size: 20px;
                background: transparent;
                margin-top: 5px;
                margin-left: -12px;
            }
            .del:hover{
                text-decoration: none;
                color: red;
                background: transparent;
            }
            .showblog{
                margin-top: 35px;
                margin-left: 35px;
            }
            .blogview{
                background-color: rgba(113, 118, 128, 0.226)
            }
        </style>
    </head>
    <body>
        <div class="container-fluid main" >
            <div class="container-fluid ">
                <div class="row">
                    <div class="col profile">
                        <?php 
                            $email = Auth::user()->email;
                        ?>
                       <img src="https://unavatar.now.sh/<?php echo $email; ?>" height="200px" width="200px" />
                                    
                    </div>
                    <div class="col name">
                        <h1 class="display-2" style="color: rgba(0, 0, 0, 0.705)">
                            {{DB::table('users')->where('id',$id)->value('name')}}
                        </h1>
                        <hr>

                        @if(DB::table('users')->where('id',$id)->value('type')=='')
                            <h6 class="lead" style="color: rgba(0, 0, 0, 0.705)"><b>Account Type :</b> Blogger</h6>
                        @else
                            <h6 class="lead" style="color: rgba(0, 0, 0, 0.705)"><b>Account Type :</b> Admin</h6>
                        @endif
                        
                        <h6 class="lead" style="color: rgba(0, 0, 0, 0.705)"><b>Account Created :</b> {{date('M j,Y',strtotime(DB::table('users')->where('id',$id)->value('created_at')))}}</h6>
                        <h6 class="lead" style="color: rgba(0, 0, 0, 0.705)"><b>Last Updated :</b> {{date('M j,Y',strtotime(DB::table('users')->where('id',$id)->value('updated_at')))}}</h6>
                    </div>
                    <div class="col more">
                        <a href="{{route('blogs_path')}}" class="back">Back</a><br>
                        <a href="#" class="showrename" onclick="show('rename')">Change Username</a>
                        <form action="{{ route('profileupdate',['id'=>$id])}}" method="POST" id="rename" style="display:none;">
                            @csrf
                            @method('PUT')
                                    <input type="text" name="name" class="form-control renamebox" required maxlength="30" placeholder="Enter new username"><br>
                                    <button type="submit" class="btn btn-outline-dark" onclick="return confirm('Are you sure you want to Rename your Account?');">Rename</button>
                        </form>
                        <form action="{{ route('profiledelete',['id'=>$id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger del" onclick="return confirm('Are you sure you want to Delete your Account?');">Delete Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid blogview">
            <div class="row">
                <div class="col"> </div>
                @if(count(array_filter(array(DB::table('blogs')->where('user_id', $id)->value('id'))))!=0)
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
                    Recent Blogs:

                </h1></div>
                <div class="col"></div>
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
                    {{DB::table('users')->where('id',$id)->value('name')}} Has Not Posted Anything Yet :(

                </h1></div>
                <div class="col"></div>
                @endif
            </div><br>
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
                                        <dd><a href="{{route('categories.search',['id'=>$blog->category_id])}}">{{$blog->category->name}}</a></dd>
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
                
            </div>
        </div>
        <br>
    </body>
    <script type="text/javascript">
        function show(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }
    </script>
</html>
@endsection 