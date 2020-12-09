@extends('layouts.app')
@section('title','| All Categories')
@section('content')



@if (session()->has('status') && 'status'!='Success')
    <div class="alert alert-success" role="alert">
        <h4>{{session('status')}}</h4>
    </div>
@endif
<html style="background-image: url({{url('images/bg.png')}})">
<head>
    <style>
        .rename_box{
            background: transparent;  
            border: none;
            border-bottom: 3px solid rgba(141, 141, 141, 0.521);
        }
    </style>
</head>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8">
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
                    Categories
        </div>
        
            <table class='table'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th></th>
                        <th>Rename</th>
                        <th>Delete</th>
                        <th>View</th>
                    </tr>  
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$count++}}</td>
                        <td><a href="{{route('categories.search',['id'=>$category->id])}}">{{$category->name}}</a></td>
                        <form action="{{ route('categories.update',['id'=>$category->id] )}}" method="POST">
                            @csrf
                            @method('PUT')
                            <td><input type="text" name="name" class="form-control rename_box" required maxlength="30" placeholder="Enter new name"></td>
                            <td><button type="submit" class="btn btn-outline-primary">Rename</button></td>
                        </form>
                        <form action="{{ route('categories.delete',['id'=>$category->id] )}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <td><button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button></td>
                        </form>
                        <td><a href="{{route('categories.search',['id'=>$category->id])}}"><button type='button' class="btn btn-outline-secondary">View Blogs</button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-3">
            <div class='well'>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="newcategory">Create New Category</label>
                        <input type="text" name="name" class="form-control" required maxlength="30"><br>
                        <button type="submit" class="btn btn-outline-primary">Add New Category</button>
                    </div>   
                </form>
            </div>
            <div class='container'>
        <div class='row'>
        <div class="btgrp" >
            <a href="{{route('blogs_path')}}" class="btn btn-outline-primary">Back</a>&nbsp;
        </div>
        </div>
        </div>
        </div>
    </div>
</div>  


@endsection
</html>