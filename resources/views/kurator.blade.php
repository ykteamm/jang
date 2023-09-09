@extends('layouts.app')
@section('content')

<div class="container h-100 pl-0 pr-0">

    <div class="swiper-container introduction active2  text-white">
        <div class="swiper-wrapper">
            <div class="swiper-slide overflow-hidden text-center">
                        <div class="container-fluid text-center mb-1">
                            <div class="avatar avatar-140 rounded-circle mx-auto shadow">
                                <div class="background" style="background-image: url(&quot;img/user1.png&quot;);">
                                    <img src="{{Auth::user()->image_url}}"  style="display: none;">
                                </div>
                            </div>
                        </div>

                        <button type="button" class="mb-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#change-image">Rasmni ozgartirish <span class="material-icons">edit</span></button>

                        <div class="container mt-2 mb-2">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary" style="background: #0a12280f;border-radius: 15px;">
                                        <div style="background: #6dc6da5c;border-radius: 15px;">
                                            Familya
                                        </div>
                                        <span>{{Auth::user()->last_name}}</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary" style="background: #0a12280f;border-radius: 15px;">
                                        <div style="background: #6dc6da5c;border-radius: 15px;">
                                            Ism
                                        </div>
                                        <span>{{Auth::user()->first_name}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="container mt-2 mb-2">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary" style="background: #0a12280f;border-radius: 15px;">
                                        <div style="background: #6dc6da5c;border-radius: 15px;">
                                            Nickname
                                        </div>
                                        <span>{{Auth::user()->nickname}}</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary" style="background: #0a12280f;border-radius: 15px;">
                                        <div style="background: #6dc6da5c;border-radius: 15px;">
                                            Telefon
                                        </div>
                                        <span>{{Auth::user()->phone_number}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="mb-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#change-profil">Ma'lumotlarni o'zgartirish <span class="material-icons">edit</span></button>

            </div>
            @include('w-component.rm-pro')

            <div class="swiper-slide overflow-hidden text-center">
                <div class="container pl-0 pr-0 mt-5">
                    <div class="row">
                        <div class="col-12 pl-0 pr-0">

                            <button type="button" class="btn" data-toggle="modal" data-target="#reyting" onclick="livewire.emit('for_reyting')">
                                <img src="{{asset('mobile/reyting.webp')}}" class="for-media-img" width="230px" alt="">
                            </button>
                        </div>
                        <div class="col-12 pl-0 pr-0">

                            <button type="button" class="btn" data-toggle="modal" data-target="#region" onclick="livewire.emit('for_region')">
                                <img src="{{asset('mobile/viloyatim.webp')}}" class="for-media-img" width="230px" alt="">
                            </button>
                        </div>
                            @if (count(getRekrut()) > 0)
                                    <div class="col-12 pl-0 pr-0">

                                        {{-- <button type="button" style="background: #8bd137" class="btn live-rekrut"
                                            data-toggle="modal" data-target="#myrekrut">
                                            Rekrut
                                        </button> --}}
                                    </div>
                                    <div class="col-12 pl-0 pr-0 supercell">

                                        <button type="button" style="background: #329fff;
                                        color: white;
                                        -webkit-text-stroke: 1px black;
                                        font-size: 25px;
                                        border: 2px solid white;
                                        border-radius: 12px;" class="btn" data-toggle="modal" data-target="#myrekrut">
                                            REKRUT
                                        </button>
                                    </div>
                                @endif
                        {{-- <div class="col-12 pl-0 pr-0">

                            <button type="button" class="btn" data-toggle="modal" data-target="#kingsold">
                                <img src="{{asset('mobile/ksold.webp')}}" class="for-media-img" width="230px" alt="">
                            </button>
                        </div> --}}
                        <div class="col-12 pl-0 pr-0">
                            <livewire:turnir-button>
                    </div>
                        <div class="container pl-0 pr-0 mt-3">
                            <div class="row">
                                <div class="col-12 pl-0 pr-0 supercell">

                                    <button type="button" style="background: #329fff;
                                    color: white;
                                    -webkit-text-stroke: 1px black;
                                    font-size: 25px;
                                    border: 2px solid white;
                                    border-radius: 12px;" class="btn" data-toggle="modal" data-target="#addprovizor">
                                        Provizor +
                                    </button>
                                </div>
                            </div>
                        </div>
                            @if (Session::has('provizor'))
                                <div class="container pl-0 pr-0 mt-3">
                                    <p style="font-size:20px;">Parol: {{Session::get('provizor')}}</p>
                                </div>
                                @php
                                    Session::forget('provizor')
                                @endphp
                            @endif
                    </div>

                </div>
            </div>
            <div class="swiper-slide overflow-hidden text-center">
                <div class="container pl-0 pr-0 mt-5">
                    <div class="row">
                        @foreach (kuratorRegion() as $key => $item)
                            <div class="col-12 pl-0 pr-0">
                                <button type="button" class="btn mt-2 font-weight-bolder text-white" data-toggle="modal" data-target="#ktb{{$key}}" style="background:#329fff;width:230px">
                                    {{$item->name}}
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.turnir')
    @include('modals.teambattle')

    {{-- @include('modals.king-sold') --}}
    @include('modals.reyting')
    @include('modals.viloyatim')
    @include('modals.region')
    @include('modals.region-profil')
    @include('modals.user-profil')
    {{-- @include('modals.testtest') --}}
    @include('modals.change-image')
    @include('modals.change-profil')
    @include('modals.addprovizor')
    @if (count(getRekrut()) > 0)
    @include('modals.myrekrut')
@endif
    @include('modals.ktb')
@endsection
@section('scripts')
@include('partials.home-com')

<script src="{{asset('promo/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    
    function getRegionP()
        {
            var region = $("select[name=provizor_region]").val();
            $('.all-dist-p').addClass('d-none');
            $(`.pdist${region}`).removeClass('d-none');

            $('.all-pharm-p').addClass('d-none');
            $(`.pharm${region}`).removeClass('d-none');

            $('.selected').prop('selected', true)

        }
        function validPro()
    {
        var first = $('#profirst').val();
        var last = $('#prolast').val();
        var phone = $('#prophone').val();
        var region = $('#proregion').val();
        var district = $('#prodistrict').val();
        var pharm = $('#propharm').val();
        if(first.length > 0 && last.length > 0 && phone && region.length > 0 && district.length > 0 && pharm.length > 0)
        {
            $('#for-open-smena-user-none').addClass('d-none');
            $('#for-open-smena-user').removeClass('d-none');
        }
        // console.log(first,last,phone,region,district,pharm)
    }
    function addProP()
    {
        $('#for-pro-add-p2').removeClass('d-none');
        $('#for-pro-select-p2').remove();
        $('#for-pro-addit-p2').addClass('d-none');
    }
    function deleteAddP()
    {
        $('#for-pro-add-p2').remove();
    }
    function teachStar($i)
    {
        $('.allteachstar').css('color','white');
        $('#teachstarinput').val($i);
        for (let index = 1; index <= $i; index++) {
            $(`#teachstar${index}`).css('color','#d4ed3c');
        }
    }
    $(document).ready(function () {
        var first = <?php echo json_encode(Auth::user()->first_enter) ?>;
        if(first == 0)
        {
            $('#firstenter').click();
        }
        var shogird = <?php echo json_encode(count(getShogird())) ?>;


        if(shogird > 0)
        {
            $('#firstview').click();
        }
        // getShogird
    });
    function firstSuccess()
    {
            var _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/first-success",
                type:"POST",
                data:{
                    _token: "{{ csrf_token() }}",
                },
                success:function(response){
                    $('#first-close').click();
                }
            });
    }
    function firstViewSuccess()
    {
            var _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/first-view",
                type:"POST",
                data:{
                    _token: "{{ csrf_token() }}",
                },
                success:function(response){
                    $('#first-view-close22').click();
                }
            });
    }function teachStar($i)
    {
        $('.allteachstar').css('color','white');
        $('#teachstarinput').val($i);
        for (let index = 1; index <= $i; index++) {
            $(`#teachstar${index}`).css('color','#d4ed3c');
        }
    }


    function upModal(id)
    {
        $(`#userprofil${id}`).click();
    }
    function allRegion(id)
    {
        $(`#allregionlive${id}`).click();
    }
</script>
<script>

    $(function () {
            $('[data-mask]').inputmask()
        });
    var dday = <?php echo json_encode(date('d',strtotime(getKSDay()['this_end']))) ?>;
    var dname = <?php echo json_encode(date('F',strtotime(getKSDay()['this_end']))) ?>;
    var countDownDate = new Date(dname+" "+dday+", 2023 23:59:59").getTime();

    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      var distance = countDownDate - now;
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      document.getElementById("count-timer-day").innerHTML = days;
      document.getElementById("count-timer-hour").innerHTML = hours;
      document.getElementById("count-timer-minut").innerHTML = minutes;
    }, 1000);

    var countDownDate2 = new Date(dname+" "+dday+", 2023 23:59:59").getTime();

    var x2 = setInterval(function() {

      // Get today's date and time
      var now2 = new Date().getTime();

      var distance2 = countDownDate2 - now2;
      var days2 = Math.floor(distance2 / (1000 * 60 * 60 * 24));
      var hours2 = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes2 = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
      var seconds2 = Math.floor((distance2 % (1000 * 60)) / 1000);
      document.getElementById("count-timer-day2").innerHTML = days2;
      document.getElementById("count-timer-hour2").innerHTML = hours2;
      document.getElementById("count-timer-minut2").innerHTML = minutes2;
    }, 1000);

    </script>
<script>
          $(function () {
       var img = $('.imgvvv'),
           imgshow = $('#imgshowimg'),
           overly = $('#overimg'),
           close = $('#closeimg');
           img.on('click', function () {
           overly.show();
           imgshow.attr('src', $(this).attr('src'));
           close.click(function(){
           overly.hide()
         ;})
     ;})
;});
    function changeTextPlan()
    {
        $('.for-plan-text-active').addClass('d-none');
        $('.for-plan-text').removeClass('d-none');
    }
    function clickPlan()
    {
        $('.click-plan').click();
        changeReytingTab(2);
        changeReytingTab(2);
        changeReytingTab(2);
    }
    function openKassa()
    {
        $(".kassa-input").each(function(){
            $(this).val(0);
            $('.summa-zakaz').text(0);
       })

    }
    function changeReytingTab(number)
    {
        $('.reyting-tab-class').removeClass('reyting-tab-active');
        $('.reyting-tab-class').addClass('reyting-tab');

        $(`.reyting-tab${number}`).removeClass('reyting-tab');
        $(`.reyting-tab${number}`).addClass('reyting-tab-active');
    }

    function changeReytingTab23(number)
    {
        $('.reyting-tab-class23').removeClass('reyting-tab-active23');
        $('.reyting-tab-class23').addClass('reyting-tab23');

        $(`.reyting-tab${number}`).removeClass('reyting-tab23');
        $(`.reyting-tab${number}`).addClass('reyting-tab-active23');
    }

    function changeKingSoldTab(number)
    {
            $(`.king-sold-tab${number}`).removeClass('king-sold-tab');
            $(`.king-sold-tab${number}`).addClass('king-sold-tab-active');
        if(number == 2)
        {
            $('.king-sold-tab1').addClass('king-sold-tab');
            $('.king-sold-tab1').removeClass('king-sold-tab-active');

            $('.king-sold-tab3').addClass('king-sold-tab');
            $('.king-sold-tab3').removeClass('king-sold-tab-active');
        }
        if(number == 3){
            $('.king-sold-tab1').addClass('king-sold-tab');
            $('.king-sold-tab1').removeClass('king-sold-tab-active');

            $('.king-sold-tab2').addClass('king-sold-tab');
            $('.king-sold-tab2').removeClass('king-sold-tab-active');
        }
        if(number == 1){
            $('.king-sold-tab2').addClass('king-sold-tab');
            $('.king-sold-tab2').removeClass('king-sold-tab-active');

            $('.king-sold-tab3').addClass('king-sold-tab');
            $('.king-sold-tab3').removeClass('king-sold-tab-active');
        }
    }
    function changeColorReyting(d)
    {
        $('.delete-reyting-bg').css('background','white');
        $(`.${d}`).css('background','#6a74b570');
    }
</script>
<script>
        $(document).ready(function () {
            setTimeout(() => {
                $('.alert-danger').remove();
                $('.alert-success').remove();
            }, 4000);
            $('#choose-file-user').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-user-close').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user-close')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-king-sold').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-king-sold')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $("#submitSold").click(function(){
                $("#soldForm").submit();
                $("#submitSold").addClass('d-none');
                $("#close-zakaz").removeClass('d-none');
            });
            // $("#kas").click();

            var check = <?php echo json_encode( Session::get('checksold') ) ?>;
            if(check != null)
            {
                $("#check").click();
            }

            var kingsold = <?php echo json_encode( Session::get('kingSold') ) ?>;
            if(kingsold != null)
            {
                $(`#opencheck${kingsold}`).click();
            }

            var kingsoldcheck = <?php echo json_encode( Session::get('kingCheck') ) ?>;
            if(kingsoldcheck != null)
            {
                $('#openkingchecksold').click();
            }
        });
        function openCode()
        {
            var code = makeCode();
            $('input[name=open_code]').val(code);
            $('.open-code').text(code);

        }
        function closeCode()
        {
            var code = makeCode();
            $('input[name=close_code]').val(code);
            $('.close-code').text(code);
        }
        function makeCode() {

            var sdf = localStorage.getItem('codes');

            var time_storage = localStorage.getItem('time_storage');
            var time_now = $.now();

            if(time_storage)
            {
                if((time_now - time_storage) > 900000)
                {
                    var result           = '';
                    var characters       = 'ABCDEFGHKLMNPQRSTUVWXYZ';
                    var numbers       = '123456789';
                    var charactersLength = characters.length;
                    var numbersLength = numbers.length;
                    for ( var i = 0; i < 1; i++ ) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    for ( var i = 0; i < 2; i++ ) {
                        result += numbers.charAt(Math.floor(Math.random() * numbersLength));
                    }
                    var sdf = localStorage.setItem('codes', result);
                    localStorage.setItem('time_storage', $.now());
                }
            }
            var sdf = localStorage.getItem('codes');

            // console.log($.now());
            if(!sdf)
            {
                var result           = '';
                var characters       = 'ABCDEFGHKLMNPQRSTUVWXYZ';
                var numbers       = '123456789';
                var charactersLength = characters.length;
                var numbersLength = numbers.length;
                for ( var i = 0; i < 1; i++ ) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                for ( var i = 0; i < 2; i++ ) {
                    result += numbers.charAt(Math.floor(Math.random() * numbersLength));
                }
                var sdf = localStorage.setItem('codes', result);
                localStorage.setItem('time_storage', $.now());
            }

            return sdf;

        }

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = number.toFixed(decimals);

            var nstr = number.toString();
            nstr += '';
            x = nstr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? dec_point + x[1] : '';
            var rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

            return x1 + x2;
        }
        function minus($id)
        {
            var stock = parseInt($(`.product${$id}`).val());
            if(stock <= 1)
            {
                $(`.product-border${$id}`).removeClass('plus-border');
                 $(`.product-border${$id}`).addClass('product-border')
            }
            if(stock != 0)
            {
                 ;
                 $(`.product${$id}`).val(stock-1);
                var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g,''));

                var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g,''));

                var allprice = number_format(orderPrice-price, 0, ',', ' ');

                $('.summa-zakaz').text(allprice);
            }

        }
        function plus($id)
        {
            var stock = parseInt($(`.product${$id}`).val());
            $(`.product${$id}`).val(stock+1);
            var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g,''));
            var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g,''));

            console.log(orderPrice);

            var allprice = number_format(price+orderPrice, 0, ',', ' ');

            $('.summa-zakaz').text(allprice);
            $(`.product-border${$id}`).addClass('plus-border');
            $('.plus-border').removeClass('product-border');

        }
        function changeDay(number)
        {
            // console.log(number);
            if(number == 0)
            {
                $('.first_one').addClass('d-none');
                $('.first_two').removeClass('d-none');
            }else{
                $('.first_two').addClass('d-none');
                $('.first_one').removeClass('d-none');
            }

        }
</script>
<script>
    var oylik = <?php echo json_encode(chartOylik()); ?>;
    var plan = <?php echo json_encode(chartPlan()); ?>;
    var liga = <?php echo json_encode(chartLiga()); ?>;
    var options = {

          series: [{
          name: 'Plan',
          data: plan
        //   data: [0,12,34,24,26]
        }, {
          name: 'Liga',
          data: liga,
        }
        ],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: oylik,
        //   categories: [0,2,3,3,2],
        },
        tooltip: {
          x: {
            // format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart_plan"), options);
        chart.render();
</script>
@endsection
