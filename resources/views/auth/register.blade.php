@extends('layouts.login')
@section('login')
<div class="reg-fio">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="text-left col align-self-center">
                   
                </div>
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        Login
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Ismingiz va familiyangizni kiriting</h2>
                            <div class="form-group float-label @if(Session::get('first_name')) active @else position-relative @endif">
                                <input type="text" class="form-control text-white" name="first_name" value="@if(Session::get('first_name')) {{Session::get('first_name')}} @endif">
                                <label class="form-control-label text-white">Ismingiz</label>
                            </div>
                            <div class="form-group float-label @if(Session::get('last_name')) active @else position-relative @endif">
                                <input type="text" class="form-control text-white" name="last_name" value="@if(Session::get('last_name')) {{Session::get('last_name')}} @endif">
                                <label class="form-control-label text-white">Familiyangiz</label>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="nameEtap()" class="btn btn-default rounded btn-block">Keyingisi</button>
            </div>
        </div>
    </div>
</div>
<div class="reg-birth d-none">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Tug'ilgan sanangizni tanlang</h2>
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
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="dateEtap()" class="btn btn-default rounded btn-block">Keyingisi</button>
                <button type="submit" onclick="lastNameEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
</div>
<div class="reg-region d-none">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Yashash joyingiz</h2>
                            <div class="row">
                                <div class="col-lg-12 col-12 text-center">
                                    <div class="form-group">
                                    <label>Viloyat</label>
                                    <select class="form-control select2" style="width: 100%;" name="region" onchange="regionChange()">
                                        @if(!Session::get('region')) 
                                            <option disabled selected hidden></option>
                                        @endif
                                        @foreach ($regions as $region)
                                        @if(Session::get('region') == $region->id) 
                                            <option value="{{$region->id}}" selected>{{$region->name}}</option>
                                        @else
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 text-center">
                                    <div class="form-group">
                                    <label>Tuman</label>
                                    <select class="form-control select2" style="width: 100%;" name="district">
                                        @if(!Session::get('district')) 
                                            <option disabled selected hidden class="selected"></option>
                                        @endif
                                        @foreach ($regions as $region)
                                            @foreach ($region->district as $district)
                                            @if(Session::get('district') == $district->id) 
                                                <option class="region{{$region->id}} allregion d-none" value="{{$district->id}}" selected>{{$district->name}}</option>
                                            @else
                                                <option class="region{{$region->id}} allregion d-none" value="{{$district->id}}">{{$district->name}}</option>
                                            @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="regionEtap()" class="btn btn-default rounded btn-block">Keyingisi</button>
                <button type="submit" onclick="lastDateEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
</div>
<div class="reg-passport d-none">
    <form method="post" id="upload_form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Passportingiz rasmini yuboring</h2>
                            <div class="row">
                                <div class="col-lg-12 col-12 text-center">
                                    <div class="form-group">
                                        <label for="choose-file" class="custom-file-upload" id="choose-file-label">
                                            Tanlang
                                        </label>
                                    <input name="passport" type="file" id="choose-file" 
                                    accept=".jpg,.jpeg,.png" style="display: none;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="passportEtap()" class="btn btn-default rounded btn-block">Keyingisi</button>
                <button type="submit" onclick="lastRegionEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
    </form>
</div>
<div class="reg-photo d-none">
    <form method="post" id="upload_form_user" enctype="multipart/form-data">
    {{ csrf_field() }}
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Rasmingizni yuboring</h2>
                            <div class="row">
                                <div class="col-lg-12 col-12 text-center">
                                    <div class="form-group">
                                        <label for="choose-file-user" class="custom-file-upload" id="choose-file-label-user">
                                            Tanlang
                                        </label>
                                    <input name="image" type="file" id="choose-file-user" 
                                    accept=".jpg,.jpeg,.png" style="display: none;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="photoEtap()" class="btn btn-default rounded btn-block">Keyingisi</button>
                <button type="submit" onclick="lastPassportEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
    </form>
</div>
<div class="reg-lavozim d-none">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Ishlamoqchi bo'lgan lavozimingizni tanlang</h2>
                            <div class="row">
                                <div class="col-lg-12 col-12 text-center">
                                    @php
                                        $spec[1]= 'Elchi';
                                        $spec[2]= 'Provizor';
                                        $spec[3]= 'Admin';
                                    @endphp
                                    <div class="form-group">
                                    <select class="form-control select2" style="width: 100%;" name="lavozim" onchange="lavozimChange()">
                                        @if(!Session::get('lavozim')) 
                                            <option disabled selected hidden></option>
                                        @endif

                                        @foreach ($spec as $key => $s)
                                        @if(Session::get('lavozim') == $key) 
                                            <option value="{{$key}}" selected>{{$s}}</option>
                                        @else
                                            <option value="{{$key}}">{{$s}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 text-center admin_code d-none">
                                    <div class="form-group">
                                        <input type="number" name="admin_code" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="lavozimEtap()" class="btn btn-default rounded btn-block">Keyingisi</button>
                <button type="submit" onclick="lastPhotoEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
</div>
<div class="reg-phone d-none">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Telefon raqamingizni kiriting</h2>
                            <div class="form-group float-label position-relative">
                                <input type="text" class="form-control text-white" data-inputmask='"mask": "(99) 999-99-99"' data-mask name="phone" onfocus="this.removeAttribute('readonly');" readonly>
                                <label class="form-control-label text-white">Telefon raqam</label>
                            </div>
                            {{-- <div class="form-group float-label position-relative for-code d-none">
                                <input type="number" class="form-control text-white" onfocus="this.removeAttribute('readonly');" readonly name="code">
                                <label class="form-control-label text-white">Smsdan kelgan kodni kiriting</label>
                            </div>  --}}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="phoneEtap()" class="btn btn-default rounded btn-block for-send-code">Keyingisi</button>
                {{-- <button type="submit" onclick="phoneNextEtap()" class="btn btn-default rounded btn-block for-code d-none">Kodni tasdiqlash</button> --}}
                <button type="submit" onclick="lastBirthEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
</div>
<div class="reg-message d-none">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Ro'yhatdan o'tdingiz!</h2>
                            <h2 class="font-weight-normal mb-5 text-center">Login va parolingizni telefon orqali yetkazamiz.Iltimos bizga telefon iling !</h2>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
</div>
@endsection
@section('login-scripts')
<script src="{{asset('promo/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#choose-file').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file')[0].files[0].name;
                $(this).prev('label').text(file);
            }); 
            $('#choose-file-user').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
        $(function () {
            $('[data-mask]').inputmask()
        });
        function regionChange()
        {
            var region = $("select[name=region]").val();
            $('.allregion').addClass('d-none');
            $(`.region${region}`).removeClass('d-none');
            $('.selected').prop('selected', true)
        }
        function lavozimChange()
        {
            var region = $("select[name=lavozim]").val();
            if(region == 3)
            {
                $('.admin_code').removeClass('d-none');
            }else{
                $('.admin_code').addClass('d-none');
            }
        }
        function nameEtap()
        {
                var first_name = $("input[name=first_name]").val();
                var last_name = $("input[name=last_name]").val();
                if(first_name.length > 0 && last_name.length > 0)
                {
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
                                $('.reg-fio').addClass('d-none');
                                $('.reg-birth').removeClass('d-none');
                            }
                        }
                    });
                }
        }
        function lastNameEtap()
        {
            $('.reg-fio').removeClass('d-none');
            $('.reg-birth').addClass('d-none');
        }
        function lastBirthEtap()
        {
            $('.reg-phone').addClass('d-none');
            $('.reg-lavozim').removeClass('d-none');
            // $('.for-code').addClass('d-none');
            // $('.for-send-code').removeClass('d-none');
            // $("input[name=password]").val('');

        }
        function lastDateEtap()
        {
            $('.reg-birth').removeClass('d-none');
            $('.reg-region').addClass('d-none');
        }
        function lastRegionEtap()
        {
            $('.reg-passport').addClass('d-none');
            $('.reg-region').removeClass('d-none');
        }
        function lastPassportEtap()
        {
            $('.reg-passport').removeClass('d-none');
            $('.reg-photo').addClass('d-none');
        }
        function lastPhotoEtap()
        {
            $('.reg-photo').removeClass('d-none');
            $('.reg-lavozim').addClass('d-none');
        }
        function lastPhoneEtap()
        {
            $('.reg-phone').removeClass('d-none');
            $('.reg-loc').addClass('d-none');

            $('.for-code').addClass('d-none');
            $('.for-send-code').removeClass('d-none');
        }
        
        function regionEtap() 
        { 
            var region = $("select[name=region]").val();
            var district = $("select[name=district]").val();
            if(district.length > 0 && region.length > 0)
            {
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                        url: "/region-etap",
                        type:"POST",
                        data:{
                            region: region,
                            district: district,
                            _token: _token
                        },
                        success:function(response){
                            if(response.status == 200){
                                $('.reg-passport').removeClass('d-none');
                                $('.reg-region').addClass('d-none');
                            }
                        }
                });
            }
        }
        function passportEtap()
        {
            $('#upload_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
            url:"{{ route('passport-etap') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response){
                            if(response.status == 200){
                                $('.reg-photo').removeClass('d-none');
                                $('.reg-passport').addClass('d-none');
                            }
                        }
            })
            });
        }
        function photoEtap()
        {
            $('#upload_form_user').on('submit', function(event){
            event.preventDefault();
            $.ajax({
            url:"{{ route('photo-etap') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response){
                            if(response.status == 200){
                                $('.reg-lavozim').removeClass('d-none');
                                $('.reg-photo').addClass('d-none');
                            }
                        }
            })
            });
        }
        function lavozimEtap()
        {
            var lavozim = $("select[name=lavozim]").val();
            if(lavozim == 3)
            {
                var admin = $("input[name=admin_code]").val();
                if(lavozim.length > 0 && admin.length > 0)
                {
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                            url: "/lavozim-etap",
                            type:"POST",
                            data:{
                                lavozim: lavozim,
                                admin: admin,
                                _token: _token
                            },
                            success:function(response){
                                if(response.status == 200){
                                    $('.reg-phone').removeClass('d-none');
                                    $('.reg-lavozim').addClass('d-none');
                                }
                            }
                    });
                }
            }else{
                if(lavozim.length > 0)
                {
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                            url: "/lavozim-etap",
                            type:"POST",
                            data:{
                                lavozim: lavozim,
                                _token: _token
                            },
                            success:function(response){
                                if(response.status == 200){
                                    $('.reg-phone').removeClass('d-none');
                                    $('.reg-lavozim').addClass('d-none');
                                }
                            }
                    });
                }
            }
        }
        function dateEtap()
        {
            var year = $("select[name=year]").val();
            var month = $("select[name=month]").val();
            var day = $("select[name=day]").val();
            if(year.length > 0 && month.length > 0 && day.length > 0)
            {
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
                                $('.reg-region').removeClass('d-none');
                                $('.reg-birth').addClass('d-none');
                            }
                        }
                });
            }
        }
        function phoneEtap()
        {
            var phone = $("input[name=phone]").val();
            if(phone.length > 0)
            {
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                        url: "/phone-etap",
                        type:"POST",
                        data:{
                            phone: phone,
                            _token: _token
                        },
                        success:function(response){
                            if(response.status == 200){
                                $('.reg-phone').addClass('d-none');
                                $('.reg-message').removeClass('d-none');
                            }
                        }
                });
            }
        }
        function phoneNextEtap()
        {
            var code = $("input[name=code]").val();
            if(code.length > 0)
            {
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
                                $('.reg-phone').addClass('d-none');
                                $('.reg-message').removeClass('d-none');
                            }
                        }
                });
            }

        }
        function locEtap()
        {
            var lat = $("input[name=lat]").val();
            var long = $("input[name=long]").val();
            var pharmacy = $("input[name=pharmacy]").val();
            if(lat.length > 0 && long.length > 0 && pharmacy.length > 0)
            {
                var _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                        url: "/map-etap",
                        type:"POST",
                        data:{
                            lat: lat,
                            long: long,
                            pharmacy: pharmacy,
                            _token: _token
                        },
                        success:function(response){
                            if(response.status == 200)
                            {
                                window.location.href = "{{ route('login')}}";
                            }
                        }
                });
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhaf1dM31SC1MV8cdYpbY2WlhHEhAFg4s&libraries=places"></script>
    
    
    <script>
        var map;
        var myLatLng;
        function geoLocationInit() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, fail);
            } else {
                alert("Browser not supported");
            }
        }
        function success(position) {
            // console.log(position);
            // var coords = e.get('coords');
            
            var latval = position.coords.latitude;
            var lngval = position.coords.longitude;
            $("input[name=lat]").val(latval);
            $("input[name=long]").val(lngval);
            myLatLng = new google.maps.LatLng(latval, lngval);
            createMap(myLatLng);
        }
        function fail() {
            alert("it fails");
        }
        function createMap(myLatLng) {
            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 12
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });
        }
        function createMarker(latlng, icn, name) {
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: icn,
                title: name
            });
        }
    </script>
@endsection