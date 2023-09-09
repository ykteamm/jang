@extends('layouts.app')
@section('content')

<div class="container h-100 pl-0 pr-0">

    <div class="swiper-container introduction active3  text-white">
        <div class="swiper-wrapper">
            @include('w-component.profil')
            @include('w-component.rm-pro')
            @include('w-component.rm-pro-order')

            <div class="swiper-slide overflow-hidden text-center">
                <div class="container pl-0 pr-0 mt-5">
                    <div class="row">
                        <div class="col-12 pl-0 pr-0">
                            <div class="text-center">
                                @if (Session::has('msg_pro'))
                                    <h4>{{Session::get('msg_pro')}}</h4>
                                @endif
                            </div>
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

                                        <button type="button" style="background: #8bd137" class="btn live-rekrut"
                                            data-toggle="modal" data-target="#myrekrut">
                                            Rekrut
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
                    </div>
                    @if (count(getShogirdUser()) > 0)
                            <div class="container pl-0 pr-0 mt-2">
                                <div class="row">
                                    <div class="col-12 pl-0 pr-0 supercell">

                                        <button type="button" style="background: #329fff;
                                        color: white;
                                        -webkit-text-stroke: 1px black;
                                        font-size: 26px;
                                        padding:5px 37px;
                                        border: 2px solid white;
                                        border-radius: 12px;" class="btn" data-toggle="modal" data-target="#myshogird">
                                            Shogird
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
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

                            @if (Session::has('rsp'))
                                <div class="container pl-0 pr-0 mt-3">
                                    <span style="font-size:30px;">
                                        @if (Session::get('rsp')['sts'] == 300)
                                            <span class="badge badge-danger" style="white-space: normal;">
                                                {{Session::get('rsp')['msg']}}
                                            </span>
                                        @else
                                            <span class="badge badge-primary" style="white-space: normal;">
                                                {{Session::get('rsp')['msg']}}
                                            </span>
                                        @endif

                                        </span>
                                </div>
                            @endif


                </div>
            </div>

            @include('w-component.team-battle')

        </div>
    </div>
</div>
@include('modals.turnir')
@include('modals.teambattle')
  
    @include('modals.king-sold')
    @include('modals.reyting')
    @include('modals.viloyatim')
    @include('modals.region')
    @include('modals.region-profil')
    @include('modals.user-profil')
    {{-- @include('modals.testtest') --}}
    @include('modals.change-image')
    @include('modals.change-profil')
    @include('modals.addprovizorforrm')

    @if (count(getShogirdUser()) > 0)
        @include('modals.myshogird')

        @include('modals.myshogirdin')
        @include('modals.onemonthin')
    @endif
    @if (count(getRekrut()) > 0)
    @include('modals.myrekrut')
@endif
    @foreach (getOrderUser() as $key => $item)
    <div class="modal fade" id="userorder{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body p-0">
                    <div class="container p-0">
                        <div class="container mb-5">
                            @foreach ($item['order'] as $ord)

                            <div class="media mb-1 p-2 w-100 product-border" style="background: #bdf0ff;color:black;"
                                data-toggle="modal" data-target="#userorderin{{$ord['id']}}"
                                >
                                    <div class="col-md-6">
                                            <p class="mb-1">Buyurtma #{{$ord['number']}}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @foreach ($item['order'] as $ord)
            <div class="modal fade" id="userorderin{{$ord['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="container p-0">

                                <table class="table">
                                    <tbody>
                                            <tr class="text-center badge-success">
                                                <td>Buyurtma summasi</td>
                                                <td>{{number_format($ord['order_price'],0,',',' ')}}</td>
                                            </tr>
                                            <tr class="text-center badge-success">
                                                <td>Pul kelishi</td>
                                                <td>{{number_format($ord['money_arrival'],0,',',' ')}}</td>

                                            </tr>
                                    </tbody>
                                </table>
                                <form action="{{route('pro-product.save',['user_id' => $item['id'], 'order_id' => $ord['id']])}}" method="POST">
                                    @csrf
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Dori</th>
                                        <th scope="col">Soni</th>
                                        <th scope="col">Sotildi</th>
                                        <th scope="col">Kiritish</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ord['order_product'] as $p)
                                            @php
                                            $sum = 0;
                                                foreach ($item['stock'] as $s)
                                                    {
                                                        if($p['product_id'] == $s['product_id'] && $p['order_id'] == $s['order_id'] )
                                                        {
                                                            $sum += $s['quantity'];
                                                        }
                                                    }
                                            @endphp
                                            <tr>
                                                <td>{{$p['product']['name']}}</td>
                                                <td>{{$p['quantity']}}</td>
                                                <td>{{$sum}}</td>
                                                @if ($ord['money_arrival'] > 0)
                                                    <td>
                                                        <input type="number" style="width:50%;" name="product[{{$p['product']['id']}}][]">
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($ord['money_arrival'] > 0)
                                    <div>
                                        <button type="submit" class="btn btn-block btn-primary propropro"
                                        onclick="$('.propropro').addClass('d-none');$('.propropro2').removeClass('d-none')">Saqlash</button>
                                        <button type="button" class="btn btn-block btn-primary propropro2 d-none">Biroz kuting</button>
                                    </div>
                                @endif
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection
@section('scripts')
@include('partials.home-com')

<script src="{{asset('promo/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

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

    function getRegionP()
        {
            var region = $("select[name=provizor_region]").val();
            $('.all-dist-p').addClass('d-none');
            $(`.pdist${region}`).removeClass('d-none');

            $('.all-pharm-p').addClass('d-none');
            $(`.pharm${region}`).removeClass('d-none');

            $('.selected').prop('selected', true)

        }
    function teachStar($i)
    {
        $('.allteachstar').css('color','white');
        $('#teachstarinput').val($i);
        for (let index = 1; index <= $i; index++) {
            $(`#teachstar${index}`).css('color','#d4ed3c');
        }
    }
    function addProP()
    {
        $('#for-pro-add-p').removeClass('d-none');
        $('#for-pro-select-p').remove();
        $('#for-pro-addit-p').addClass('d-none');
    }
    function deleteAddP()
    {
        $('#for-pro-add-p').remove();
    }
    $(document).ready(function () {


        $('#getRegionP').change(function(){
            var value = $(this).val();
            console.log(value);
        });

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

    var countDownDate2 = new Date("April 20, 2023 23:59:59").getTime();

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

            $("#submitSoldPro").click(function(){
                $("#soldFormPro").submit();
                $("#submitSoldPro").addClass('d-none');
                $("#close-zakazPro").removeClass('d-none');
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
                 $(`.product${$id}`).val(stock-1);
                var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g,''));

                var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g,''));

                var allprice = number_format(orderPrice-price, 0, ',', ' ');

                $('.summa-zakaz').text(allprice);
            }

        }
        function minusPromo($id)
        {
            var proId = [36,37,38,39,29,47,61,62,63,64,65];

            var stock = parseInt($(`.productPro${$id}`).val());
            if(stock <= 1)
            {
                $(`.product-borderPro${$id}`).removeClass('plus-borderPro');
                 $(`.product-borderPro${$id}`).addClass('product-borderPro')
            }
            if(stock != 0)
            {
                 $(`.productPro${$id}`).val(stock-1);
                var price = parseInt($(`.product-pricePro${$id}`).text().replace(/[^0-9]/g,''));

                var orderPrice = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));

                var allprice = number_format(orderPrice-price, 0, ',', ' ');

                $('.summa-zakazPro').text(allprice);

                if(proId.includes($id))
                {

                    var orderPricePro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
                    var allpricePro = number_format(orderPricePro-price, 0, ',', ' ');
                    $('.summa-promoPro').text(allpricePro);


                }

                var allP = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));
                var allPro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
                if(allP == 0)
                    {
                        var p = 0;

                    }else{
                        var p = (allPro*100)/(allP);

                    }

                var pfor = p.toFixed(1);
                $('#promop').text(pfor);

                if(parseInt(p) >= 60)
                {
                    $('.propropro').removeClass('d-none');
                    $('#def-zakazPro').addClass('d-none');
                }else{
                    $('.propropro').addClass('d-none');
                    $('#def-zakazPro').removeClass('d-none');
                }

            }



        }
        function minusPlus()
        {
            var proId = [36,37,38,39,29,47,61,62,63,64,65];

            var allprice = 0;
            var allpricePro = 0;

            $( '.allmp' ).each(function(index) {
                var n = $(this).val();
                if(!n)
                {
                    n = 0;
                }
                allprice += parseInt($(this).attr('narxi'))*parseInt(n)
                if(proId.includes(parseInt($(this).attr('proid'))))
                    {
                        allpricePro += parseInt($(this).attr('narxi'))*parseInt(n)
                    }
            });
            $('.summa-zakazPro').text(allprice);
            $('.summa-promoPro').text(allpricePro);

            var allP = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));
            var allPro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
            if(allP == 0)
            {
                var p = 0;

            }else{
                var p = (allPro*100)/(allP);

            }

                var pfor = p.toFixed(1);


                $('#promop').text(pfor);

                if(parseInt(p) >= 60)
                {
                    $('.propropro').removeClass('d-none');
                    $('#def-zakazPro').addClass('d-none');
                }else{
                    $('.propropro').addClass('d-none');
                    $('#def-zakazPro').removeClass('d-none');
                }

        }
        function plusPromo($id)
        {

            var stock = parseInt($(`.productPro${$id}`).val());
            $(`.productPro${$id}`).val(stock+1);

            var price = parseInt($(`.product-pricePro${$id}`).text().replace(/[^0-9]/g,''));

            var orderPrice = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));
            var allprice = number_format(price+orderPrice, 0, ',', ' ');


            $('.summa-zakazPro').text(allprice);
            $(`.product-borderPro${$id}`).addClass('plus-borderPro');
            $('.plus-borderPro').removeClass('product-borderPro');

            var proId = [36,37,38,39,29,47,61,62,63,64,65];

            if(proId.includes($id))
            {

                var orderPricePro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
                var allpricePro = number_format(price+orderPricePro, 0, ',', ' ');
                $('.summa-promoPro').text(allpricePro);






            }

            var allP = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));
            var allPro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
            if(allP == 0)
            {
                var p = 0;

            }else{
                var p = (allPro*100)/(allP);

            }


                var pfor = p.toFixed(1);


                $('#promop').text(pfor);

                if(parseInt(p) >= 60)
                {
                    $('.propropro').removeClass('d-none');
                    $('#def-zakazPro').addClass('d-none');
                }else{
                    $('.propropro').addClass('d-none');
                    $('#def-zakazPro').removeClass('d-none');
                }
        }
        function plus($id)
        {
            var stock = parseInt($(`.product${$id}`).val());
            $(`.product${$id}`).val(stock+1);
            var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g,''));
            var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g,''));


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
