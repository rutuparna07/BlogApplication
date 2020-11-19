@extends('layouts.app')
@section('title','| All Categories')
@section('content')



@if (session()->has('status') && 'status'!='Success')
    <div class="alert alert-success" role="alert">
        <h4>{{session('status')}}</h4>
    </div>
@endif

<br>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class='table'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        
                </thead>

                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <form action="{{ route('categories.update',['id'=>$category->id] )}}" method="POST">
                            @csrf
                            @method('PUT')
                            <td><input type="text" name="name" class="form-control" required maxlength="30"></td>
                            <td><button type="submit" class="btn btn-outline-primary">Rename</button></td>
                        </form>
                        <form action="{{ route('categories.delete',['id'=>$category->id] )}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <td><button type="submit" class="btn btn-outline-danger">Delete</button></td>
                        </form>
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
        </div>
    </div>

    <div class="btgrp" >
        <a href="{{route('blogs_path')}}" class="btn btn-outline-primary">Back</a>&nbsp;
    </div>
</div>  


@endsection
