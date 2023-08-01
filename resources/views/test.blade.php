<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('promo/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('promo/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('promo/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('promo/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('promo/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('promo/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('promo/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('promo/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('promo/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('promo/plugins/dropzone/min/dropzone.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('promo/dist/css/adminlte.min.css')}}">
  <style>
    .bottom-footer{
        bottom: 0;
        left: 0;
        position: fixed;
        right: 0;
        z-index: 1032;
    }
  </style>
</head>
<body class="hold-transition">
<div class="container-fluid">
  <!-- /.login-logo -->
        <div class="row">
            <div class="col-lg-6 col-6">
            
            </div>
            <div class="col-lg-6 col-6">
                <div class="social-auth-links text-center mt-2 mb-3">
                    <a onclick="userLogin()" class="btn btn-block btn-primary user-login">
                    Kirish
                    </a>
                    <a onclick="userRegister()" class="btn btn-block btn-primary d-none user-register">
                    Registratsiya
                    </a>
                </div>
            </div>
        </div> 
    
    <div class="register-user">
    <div class="mb-3 mt-5">
        <div class="text-center">
        <a href="../../index2.html" class="h1"><b>Ro'yhatdan otish</b></a>
        </div>
    </div>

    <div class="card card-primary mt-5">
        <form>
        <div class="card-body name-etap">
            <div class="form-group text-center">
            <label for="exampleInputEmail1">Ismingiz</label>
            <input type="text" name="first_name" class="form-control" value="@if(Session::get('first_name')) {{Session::get('first_name')}} @endif" id="exampleInputEmail1" placeholder="Ismingizni kiriting..">
            </div>
            <div class="form-group text-center mt-5">
            <label for="exampleInputPassword1">Familiyangiz</label>
            <input type="text" name="last_name" class="form-control" value="@if(Session::get('last_name')) {{Session::get('last_name')}} @endif" id="exampleInputPassword1" placeholder="Familiyangizni kiriting..">
            </div>
        </div>
        <div class="card-body date-etap d-none">
            <div class="row">
                <div class="col-lg-4 col-4 text-center">
                    <div class="form-group">
                      <label>Yil</label>
                      <select class="form-control select2" style="width: 100%;" name="year">
                        @if(!Session::get('year')) 
                            <option disabled selected hidden></option>
                        @endif
                        @for ($i = 2004; $i > 1950; $i--)
                        @if(Session::get('year') == $i) 
                            <option selected>{{$i}}</option>
                        @else
                            <option>{{$i}}</option>
                        @endif
                        @endfor
                      </select>
                    </div>
                </div>
                <div class="col-lg-4 col-4 text-center">
                    <div class="form-group">
                      <label>Oy</label>
                      <select class="form-control select2" style="width: 100%;" name="month">
                        <option disabled selected hidden></option>
                        @for ($i = 1; $i <= 12; $i++)
                            @if(strlen($i) == 1)
                            {
                                @if(Session::get('month') == '0'.$i) 
                                    <option selected>0{{$i}}</option>
                                @else
                                    <option>0{{$i}}</option>
                                @endif
                            }
                            @else
                                @if(Session::get('month') == $i) 
                                    <option selected>{{$i}}</option>
                                @else
                                    <option>{{$i}}</option>
                                @endif
                            @endif
                        @endfor
                      </select>
                    </div>
                </div>
                <div class="col-lg-4 col-4 text-center">
                    <div class="form-group">
                      <label>Kun</label>
                      <select class="form-control select2" style="width: 100%;" name="day">
                        <option disabled selected hidden></option>
                        @for ($i = 1; $i <= 31; $i++)
                            @if(strlen($i) == 1)
                            {
                                @if(Session::get('day') == '0'.$i) 
                                    <option selected>0{{$i}}</option>
                                @else
                                    <option>0{{$i}}</option>
                                @endif
                            }
                            @else
                                @if(Session::get('day') == $i) 
                                    <option selected>{{$i}}</option>
                                @else
                                    <option>{{$i}}</option>
                                @endif
                            @endif
                        @endfor
                      </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body map-etap d-none">
            <div class="form-group text-center">
                <label for="exampleInputPassword1">Joylashuv joyingizni belgilang</label>
               <div id="map" style="height: 300px"></div>    
            </div>
            <div class="form-group text-center mt-5">
            <label for="exampleInputPassword1">Dorixonangiz nomini kiriting</label>
            <input type="text" name="last_name" class="form-control" value="@if(Session::get('last_name')) {{Session::get('last_name')}} @endif" id="exampleInputPassword1" placeholder="Familiyangizni kiriting..">
            </div>
        </div>
        <div class="card-body phone-etap d-none ">
            @if(!Session::get('code_etap'))
            <div class="form-group text-center">
                <label class="first-phone-text">Telefon raqamingizni kiriting</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask='"mask": "(99) 999-99-99"' data-mask name="phone">
                </div>

                <div class="form-group text-center mt-3 d-none done-code-etap">
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <button type="submit" class="btn btn-block btn-outline-success phone-number"></button>
                    </div>
                </div> 

                <div class="form-group text-center mt-5 d-none kod-etap">
                    <label for="exampleInputEmail1">Kodni tasdiqlang</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="code">
                </div>
                <div class="form-group text-center mt-3 d-none retry-etap">
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <button type="submit" onclick="phoneEtap()" class="btn btn-block btn-danger">Tog'ri kelmadi qayta yuboring</button>
                    </div>
                </div>
            </div>
            @else
              <div class="form-group text-center">
                <label class="first-phone-text">Telefon raqamingiz tasqidlangan</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask='"mask": "(99) 999-99-99"' data-mask name="phone" value="{{Session::get('phone')}}">
                </div>
              </div>
            @endif
        </div>
        <div class="card-body parol-etap d-none">
            <div class="form-group text-center">
                <label>Parol kiriting</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                  </div>
                  <input type="password" class="form-control" min="4" name="password">
                </div> 
              </div>
        </div>
        </form>
        
    </div> 
    <div class="card-body bottom-footer">

        <div class="social-auth-links text-center mt-2 mb-3 name-etap">
            <button type="submit" onclick="nameEtap()" class="btn btn-block btn-primary">Keyingisi</button>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3 d-none date-etap">
            <button type="submit" onclick="dateEtap()" class="btn btn-block btn-primary">Keyingisi</button>
        </div>
        
        <div class="social-auth-links text-center mt-2 mb-3 d-none phone-etap for-kod-etap">
            <button type="submit" onclick="phoneEtap()" class="btn btn-block btn-primary">Kodni yuborish</button>
        </div>

        <div class="social-auth-links text-center mt-2 mb-3 d-none next-etap">
            <button type="submit" onclick="nextEtap()" class="btn btn-block btn-primary">Keyingisi</button>
        </div>

        <div class="social-auth-links text-center mt-2 mb-3 d-none kod-etap">
            <button type="submit" onclick="kodEtap()" class="btn btn-block btn-primary">Kodni tasdiqlash</button>
        </div>

        <div class="social-auth-links text-center mt-2 mb-3 d-none parol-etap">
            <button type="submit" onclick="parolEtap()" class="btn btn-block btn-primary">Tugatish</button>
        </div>

        <div class="social-auth-links text-center mt-2 mb-3 d-none name-etap-last">
            <button type="submit" onclick="nameEtapLast()" class="btn btn-block btn-primary">Orqaga</button>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3 d-none date-etap-last">
            <button type="submit" onclick="dateEtapLast()" class="btn btn-block btn-primary">Orqaga</button>
        </div>

        <div class="social-auth-links text-center mt-2 mb-3 d-none phone-etap-last">
            <button type="submit" onclick="phoneEtapLast()" class="btn btn-block btn-primary">Orqaga</button>
        </div>
    </div>
    </div>
    <div class="login-user d-none" style="margin-top:40%;">
        <div class="card card-primary mt-5">
            <form>
            <div class="card-body ">
                <div class="form-group text-center">
                    <label>Parol kiriting</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                      </div>
                      <input type="password" class="form-control" min="4" name="password">
                    </div> 
                  </div>
            </div>
            </form>
            
        </div> 
        <div class="card-body bottom-footer">
            <div class="social-auth-links text-center mt-2 mb-3">
                <button type="submit" class="btn btn-block btn-primary">Kirish</button>
            </div>
        </div>
    </div>
    
</div>



<script src="https://api-maps.yandex.ru/2.1/?apikey=7a4a276f-4b19-448d-877b-1c87a0b350c3&lang=ru_RU" type="text/javascript"></script>
      <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            ymaps.ready(init);

            function init() {
                var myPlacemark,
                    myMap = new ymaps.Map('map', {
                        center: [40, 67],
                        zoom: 6
                    }, {
                        searchControlProvider: 'yandex#search'
                    });

                // Listening for a click on the map
                myMap.events.add('click', function (e) {
                    var coords = e.get('coords');

                    // Moving the placemark if it was already created
                    if (myPlacemark) {
                        myPlacemark.geometry.setCoordinates(coords);
                    }
                    // Otherwise, creating it.
                    else {
                        myPlacemark = createPlacemark(coords);
                        myMap.geoObjects.add(myPlacemark);
                        // Listening for the dragging end event on the placemark.
                        myPlacemark.events.add('dragend', function () {
                            getAddress(myPlacemark.geometry.getCoordinates());
                        });
                    }
                    getAddress(coords);
                });

                // Creating a placemark
                function createPlacemark(coords) {
                    return new ymaps.Placemark(coords, {
                        iconCaption: 'searching...'
                    }, {
                        preset: 'islands#violetDotIconWithCaption',
                        draggable: true
                    });
                }

                // Determining the address by coordinates (reverse geocoding).
                function getAddress(coords) {
                    myPlacemark.properties.set('iconCaption', 'searching...');
                    ymaps.geocode(coords).then(function (res) {
                        var firstGeoObject = res.geoObjects.get(0);
                        console.log(firstGeoObject.geometry._coordinates);
                        myPlacemark.properties
                            .set({
                                // Forming a string with the object's data.
                                iconCaption: [
                                    // The name of the municipality or the higher territorial-administrative formation.
                                    firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                    // Getting the path to the toponym; if the method returns null, then requesting the name of the building.
                                    firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                                ].filter(Boolean).join(', '),
                                // Specifying a string with the address of the object as the balloon content.
                                balloonContent: firstGeoObject.getAddressLine()
                            });
                    });
                }
            }

        }
      </script>
<script>
    function userLogin()
    {
        $('.register-user').addClass('d-none');
        $('.user-login').addClass('d-none');
        $('.login-user').removeClass('d-none');
        $('.user-register').removeClass('d-none');
    }
    function userRegister()
    {
        $('.register-user').removeClass('d-none');
        $('.user-login').removeClass('d-none');
        $('.login-user').addClass('d-none');
        $('.user-register').addClass('d-none');
    }
    function nameEtap()
      {
         var first_name = $("input[name=first_name]").val();
         var last_name = $("input[name=last_name]").val();

         var _token = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
                url: "/name-etap",
                type:"POST",
                data:{
                    first_name: first_name,
                    last_name: last_name,
                    _token: _token
                },
                success:function(response){
                    if(response.status == 200){
                        $('.name-etap').addClass('d-none');
                        
                        $('.date-etap').removeClass('d-none');
                        $('.name-etap-last').removeClass('d-none');
                    }
                }
            });
        }
        function dateEtap()
        {
            var year = $("select[name=year]").val();
            var month = $("select[name=month]").val();
            var day = $("select[name=day]").val();

            var _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                    url: "/date-etap",
                    type:"POST",
                    data:{
                        year: year,
                        month: month,
                        day: day,
                        _token: _token
                    },
                    success:function(response){
                        if(response.status == 200){

                            $('.date-etap').addClass('d-none');
                            $('.phone-etap').removeClass('d-none');
                            $('.name-etap-last').addClass('d-none');
                            $('.date-etap-last').removeClass('d-none');
                        }
                        if(response.code == 200 && response.phone == 200){
                            $('.for-kod-etap').addClass('d-none');
                            $('.next-etap').removeClass('d-none');
                        }
                        if(response.code != 200 && response.phone == 200){
                            $('.for-kod-etap').addClass('d-none');
                            $('.kod-etap').removeClass('d-none');
                        }
                        if(response.code == 200 && response.phone != 200){
                            $('.for-kod-etap').addClass('d-none');
                            $('.kod-etap').removeClass('d-none');
                        }
                    }
                });
            }
            function phoneEtap()
        {
            var phone = $("input[name=phone]").val();

            var _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                    url: "/phone-etap",
                    type:"POST",
                    data:{
                        phone: phone,
                        _token: _token
                    },
                    success:function(response){
                        if(response.status == 200){

                            $('.for-kod-etap').addClass('d-none');
                            $('.kod-etap').removeClass('d-none');
                        }
                    }
                });
            }
        function kodEtap()
        {
            var code = $("input[name=code]").val();

            var _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                    url: "/code-etap",
                    type:"POST",
                    data:{
                        code: code,
                        _token: _token
                    },
                    success:function(response){
                        if(response.status == 200){
                            $('.retry-etap').addClass('d-none');
                            $('.done-code-etap').removeClass('d-none');
                            $('.phone-number').text(response.status.number);

                            $('.kod-etap').addClass('d-none');
                            $('.phone-etap').addClass('d-none');
                            $('.parol-etap').removeClass('d-none');
                            $('.phone-etap-last').removeClass('d-none');
                            $('.code-etap-last').addClass('d-none');
                            $('.date-etap-last').addClass('d-none');

                            $('.first-phone-text').text('Telefon raqamingiz tasdiqlangan');


                        }else{
                            $('.retry-etap').removeClass('d-none');
                        }
                    }
                });
        }
        function parolEtap()
        {
            var password = $("input[name=password]").val();

            var _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                    url: "/parol-etap",
                    type:"POST",
                    data:{
                        password: password,
                        _token: _token
                    },
                    success:function(response){
                        if(response.status == 200)
                        {
                            window.location.href = "{{ route('user')}}";
                        }
                    }
                });
        }
        function nameEtapLast()
        {
            $('.name-etap').removeClass('d-none');
            $('.date-etap').addClass('d-none');
            $('.name-etap-last').addClass('d-none');
        }
        function dateEtapLast()
        {
            $('.date-etap').removeClass('d-none');
            $('.phone-etap').addClass('d-none');
            $('.name-etap-last').removeClass('d-none');
            $('.date-etap-last').addClass('d-none');
            $('.next-etap').addClass('d-none');
            $('.kod-etap').addClass('d-none');
        }
        function phoneEtapLast()
        {
            $('.date-etap-last').removeClass('d-none');
            $('.phone-etap').removeClass('d-none');

            $('.parol-etap').addClass('d-none');
            $('.phone-etap-last').addClass('d-none');
            $('.done-code-etap').addClass('d-none');
            $('.for-kod-etap').addClass('d-none');
            $('.next-etap').removeClass('d-none');



        }
        function nextEtap()
        {
            $('.parol-etap').removeClass('d-none');
            $('.phone-etap-last').removeClass('d-none');
            $('.next-etap').addClass('d-none');
            $('.phone-etap').addClass('d-none');
            $('.date-etap-last').addClass('d-none');
        }
</script>

<script src="{{asset('promo/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('promo/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('promo/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('promo/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('promo/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('promo/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('promo/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('promo/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('promo/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{asset('promo/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{asset('promo/plugins/dropzone/min/dropzone.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('promo/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('promo/dist/js/demo.js')}}"></script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });
    $('[data-mask]').inputmask()

  });
</script>

</body>
</html>
