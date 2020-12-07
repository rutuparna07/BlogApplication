@extends('layouts.app')
@section('content')
    <html>
        &nbsp;
        <head>
            <link rel="stylesheet" href="{{('\css\about.css')}}">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>
        <body>
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
            <div class="container-fluid main">
                <div class="desc">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{url('images/logo.png')}}" height="150px;" style="margin-top: 20px;"/>
                        </div>
                        <div class="col-md-4 one">
                            <p>Ikigai:What  is  your  reason  for  being?
                            According  to  the  Japanese, everyone  has  an  ikigai—what  a  
                            French philosopher  might  call  a  raison  d’être. Some  people  have  found  their  ikigai,
                                while  others  are  still  looking, though  they  carry  it  within  them. Our  ikigai  is  
                                hidden  deep inside  each  of  us, and  finding  it  requires  a  patient search. According  
                                to  those  born  on  Okinawa, the  island  with  the  most centenarians  in  the  world, our  
                                ikigai  is  the  reason  we  get  up in  the  morning.</p>      
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4 two">
                            <p>Why we named it as ikigai?
                                Because we believe we are providing people , a platform, a place where you can do what you love,
                                where you can do what you're good at, where the blogs you create provides knowledge to the people
                                which the world needs and can get paid.
                                A place where you can find your own destiny.</p>
                        </div>
                        <div class="col-md-4">
                            <a href="https://forms.gle/dFy2d2qJ6PE4mR866" class="review">Rate & Review</a>
                        </div>
                    </div>
                </div><br>
                <h1 class="display-4" style="text-align: center; margin-top:100px;">Developers on-board</h1>
                <div class="row contrib">
                    <div class="col-md-4">
                        <div class="card card-1">
                          <h3>Rutuparna Kudtarkar</h3>
                          <p> Handled entire UI/UX of the website. Also contributed
                              in User Authentication and Verification.
                          </p>
                          <p> Connect at : <a href="https://github.com/rutuparna07">GitHub</a> | <a href="https://www.linkedin.com/in/rutuparna-kudtarkar/">LinkedIn</a></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card card-2">
                          <h3>Keyur Modh</h3>
                          <p>Handled the entire Blogs and Categories Model.In other words creation,updation,manipulation and deletion of Blogs and Categories is securely possible because of me.No need to thank me.
                          </p>
                          <p> Connect at : <a href="https://github.com/rutuparna07">GitHub</a> | <a href="https://www.linkedin.com/in/keyur-modh-bb948a185/">LinkedIn</a></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card card-3">
                          <h3>Bishal Nakoda</h3>
                          <p>Learn how to easily customize and modify your app’s design to fit your
                            brand across all mobile platform styles.</p>
                          <p> Connect at : <a href="https://github.com/keyurmodh00">GitHub</a> | <a href="https://www.linkedin.com/in/rutuparna-kudtarkar/">LinkedIn</a></p>
                        </div>
                      </div>
                </div>
                <div class="row">
                </div>
            </div>
        </body>
    </html>
@endsection