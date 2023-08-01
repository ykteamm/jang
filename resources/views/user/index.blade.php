<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>Jang Novatio</title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('promo/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('promo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('promo/dist/css/adminlte.min.css')}}">
  <style>
    @font-face {
        font-family: Supercell-Magic;
        src: url('/promo/dist/fonts/Supercell-magic-webfont.ttf');
    }
    * {
        font-family: Supercell-Magic;
    }
    .profile-img {
        width: 230px;
        height: 230px;
        border: 6px solid #d845fe;
        background: url(img/duck.png) no-repeat;
        -moz-box-shadow: 0px 6px 5px #ccc;
        -webkit-box-shadow: 0px 6px 5px #ccc;
        box-shadow: 
        0px 0px 15px #cc00ff;
        -moz-border-radius: 190px;
        -webkit-border-radius: 190px;
        border-radius: 190px;
    }
    body{
        background-image: url('/promo/dist/img/promo/bg2.png');
        background-repeat: no-repeat;
    }
    .bottom-footer{
        bottom: 0;
        left: 0;
        position: fixed;
        right: 0;
        z-index: 1032;
    }
    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .texter{
        text-shadow: 0px 0px 5px #040000;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-6 col-6">
                    <div class="row">
                        <div class="col-lg-8 col-8 mt-1" style="padding-right: 0px;">
                            <div class="progress mb-3" style="height: 33px;border:2px solid black;border-radius:5%;">
                                <div style="background-color: #f9d22e" class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                  <span style="-webkit-text-stroke:1px black;">40%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-4" style="padding-left: 0px;">
                            <img src="{{asset('promo/dist/img/promo/oltin3.png')}}" height="40px" alt="User Avatar">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="row">
                        <div class="col-lg-8 col-8 mt-1" style="padding-right: 0px;">
                            <div class="progress mb-3" style="height: 33px;border:2px solid black;border-radius:5%;">
                                <div style="background-color: #cc00ff" class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                  <span style="-webkit-text-stroke:1px black;">40%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-4" style="padding-left: 0px;">
                            <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" height="40px" alt="User Avatar">
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row" style="margin-top: 20%;">
                <div class="col-lg-12 col-12">
                    <div class="text-center mt-5">
                      <img class="profile-img" src="https://api.multiavatar.com/kathrin.svg" width="130px" alt="User Avatar">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20%;">
                <div class="col-lg-12 col-12">
                    {{-- <div class="card-footer"> --}}
                        <div class="row">
                            <div class="col-sm-4">
                            <div class="description-block">
                                <p class="description-header texter" style="font-size:33px;color:white;">Jalilova</p>
                                <p class="description-header texter" style="font-size:33px;color:white;">Shoira</p>
                            </div>
                            </div>
                            <div class="col-sm-4">
                            <div class="description-block">
                                {{-- <h5 class="description-header">Asr</h5> --}}
                                {{-- <span class="description-header" style="font-size:20px;color:white;">Asr</span> --}}
                                <img src="{{asset('promo/dist/img/promo/button.png')}}" height="40px" alt="User Avatar">
                                <div class="centered"><span class="description-header texter" style="font-size:23px;color:white;">Asr</span></div>

                            </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
            <footer class="bottom-footer">
                <div class="row">
                    <div class="col-lg-3 col-3">
                      {{-- <div class="small-box"> --}}
                        <div class="ml-2">
                            <a href="{{route('shopping')}}">
                                <img src="{{asset('promo/dist/img/promo/market2.png')}}" height="100px" alt="User Avatar">
                            </a>
                        </div>
                      {{-- </div> --}}
                    </div>
                    <div class="col-lg-3 col-3">
                        {{-- <div class="small-box"> --}}
                          <div class="ml-3">
                              <a href="javascript:void(0)">
                                  <img src="{{asset('promo/dist/img/promo/reyting2.png')}}" height="100px" alt="User Avatar">
                              </a>
                          </div>
                        {{-- </div> --}}
                    </div>
                    <div class="col-lg-6 col-6">
                        {{-- <div class="small-box"> --}}
                          <div class="ml-3">
                              <a href="javascript:void(0)">
                                  <img src="{{asset('promo/dist/img/promo/zakaz2.png')}}" height="100px" alt="User Avatar">
                              </a>
                          </div>
                        {{-- </div> --}}
                    </div>
                </div>    
            </footer>
        </div>
    {{-- </section> --}}
    
    </div>
    
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('promo/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('promo/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('promo/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('promo/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('promo/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('promo/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('promo/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('promo/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('promo/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('promo/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('promo/dist/js/pages/dashboard2.js')}}"></script>
</body>
</html>
