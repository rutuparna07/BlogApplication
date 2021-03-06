<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield("title")
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <style>
    #cont {
      margin-top: 10%;
    }
    .main-panel {
      background-image: linear-gradient( #03031e, #020024);
    }
  </style>
</head>

<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="blue">
    <div class="logo">
        <?php 
            $email = Auth::user()->email;
            $default = "https://assets.stickpng.com/images/5847fb42cef1014c0b5e48d8.png";
            $size = 40;
            $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
        ?>
        <a href="" class="simple-text logo-normal" >
          Admin Panel 
        </a><img src="<?php echo $grav_url; ?>" alt=""  height="50px" width="50px" />
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="/dashboard">
              <p>
                 {{ Auth::user()->name }}`s Dashboard</p>
            </a>
          </li>
          <li>
            <a href="/role-register">
              <p>Registered roles</p>
            </a>
          </li>
          <li>
            <a href="{{route('categories.index')}}" class="categ" >Categories</a>
          </li>
          <li>
            <a href="/blogs">
              <p>Posts</p>
            </a>
          </li>
          <li>
          
          </li>
      </div>
    </div>

    <div class="main-panel" id="main-panel">
      <div>
        <a  style= "color:cornsilk;font-size:15px;opacity: 0.8;float:right; margin: 15px 15px;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <img src="{{url('/images/exit.png')}}" alt="Image" height="50px" width="55px"/>
                                        {{ __('LOGOUT') }}
                                        
          </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                </form> 
      </div>
      <div class="content" id="cont">
        @yield("content")  
      </div>

  </div>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  @yield("scripts")
</body>

</html>