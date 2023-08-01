@extends('layouts.app')
@section('content')

    <div class="container h-100 pl-0 pr-0">
        {{-- @if ($lock->isLocked)
        <div class="text-center text-white supercell">
            Siz blokirovkaga tushdingiz. RMingiz bilan bo'g'laning
        </div>
        @else
        @endif --}}
        {{-- @dd($user_king_liga) --}}
        {{-- @if (isset($user_king_liga->inc) && $user_king_liga->inc)
            <button class="d-none" data-toggle="modal" id="kingliga-btn" data-target="#kingliga"></button>
        @else --}}
        @if (Session::get('recommendNews'))
            <button class="d-none" data-toggle="modal" id="recommendNews-btn" data-target="#recommendNews"></button>
        @endif
            <div
                class="swiper-container introduction @if ($errors->any() || Session::has('smena')) active1 @else active2 @endif  text-white">
                <div class="swiper-wrapper">
                    {{-- @include('w-component.profil') --}}
                    @include('w-component.smena')
                    {{-- @include('w-component.mijoz') --}}
                    @include('w-component.main')
                    {{-- @include('w-component.money') --}}
                    {{-- @include('w-component.team-battle') --}}
                    {{-- @if (count($videos) > 0 || count($infos) > 0)
                        @include('w-component.info-section')
                    @endif --}}
                </div>
            </div>
        {{-- @endif --}}
    </div>

    @include('modals.news')
    @include('modals.recommendNews')
    @include('modals.showNw')
    @include('modals.exercise')
    @include('modals.turnir')
    @include('modals.history-kubok')
    @include('modals.history-elexir')
    @include('modals.reyting')
    @include('modals.region')
    @include('modals.planuser')
    @include('modals.change_plan')

    @include('modals.openkassa')
    @include('modals.opencheck')
    @include('modals.smena')
    @include('modals.kassa')
    @include('modals.smenaclose')
    @include('modals.hisobot')
    @include('modals.all-sold')

    {{-- @include('modals.kingliga') --}}
    {{-- @include('modals.teambattle') --}}

    {{-- @include('modals.change-image') --}}
    {{-- @include('modals.change-profil') --}}

    {{-- @if (Auth::user()->status == 0)
        @include('modals.new-elchi')
    @endif --}}
    {{-- @if (count($shifts) != 1)
        @include('modals.teachgradestar')
    @endif --}}
    {{-- @if (count(getShogirdUser()) > 0)
        @include('modals.myshogird')

        @include('modals.myshogirdin')
        @include('modals.onemonthin')
    @endif --}}

    {{-- @if (count(getRekrut()) > 0)
        @include('modals.myrekrut')
    @endif --}}

    {{-- @if (getSinovUser(Auth::id()) != 0)
        @include('modals.onemonth')
    @endif --}}
    {{-- @include('modals.teachtest') --}}
    {{-- @include('modals.lock') --}}
    {{-- @include('modals.info-modal') --}}
    {{-- @include('modals.video-modal') --}}
    {{-- @include('modals.image') --}}
    {{-- @include('modals.battle') --}}
    {{-- @include('modals.battle-day') --}}
    
    
    {{-- @include('modals.bonus') --}}
    {{-- @include('modals.king-sold') --}}
    {{-- @include('modals.region-profil') --}}
    {{-- @include('modals.user-profil') --}}
    {{-- @include('modals.money') --}}
    {{-- @include('modals.openkingcheck') --}}
    {{-- @include('modals.ksb') --}}
    {{-- @include('modals.myksbhistory') --}}
    {{-- @include('modals.first-enter') --}}
    {{-- @include('modals.today-check') --}}
    {{-- @include('modals.kscheck') --}}
    <button type="button" class="btn btn-info btn-block rounded m-2 d-none" data-toggle="modal" id="firstenter"
        data-target="#first-enter">
        Smena yopish
    </button>
    @include('modals.first-view')
    <button type="button" class="btn btn-info btn-block rounded m-2 d-none" data-toggle="modal" id="firstview"
        data-target="#first-view">
        Smena yopish
    </button>
    {{-- @include('modals.testtest') --}}
    {{-- @if (Session::has('kingCheck'))
        @php
            $solds = Session::get('kingCheck');
        @endphp
        @foreach ($solds as $key => $item)
            <div class="modal fade" id="openkingcheckr{{ $key * 3 }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                style="opacity: 5">
                                <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card mb-3">
                                <div class="container p-0">
                                    <img src="{{ asset('images/users/king_sold/' . $item->image) }}" width="100%"
                                        width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif --}}
@endsection
@section('scripts')
    <script src="{{ asset('promo/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        function rekrutSuccess(id)
    {
        var comment = $(`#rekruting${id}`).val();

        if(comment.length > 5)
        {
            $('.rekrutbutton').addClass('d-none');
            $('.rekrutbutton2').removeClass('d-none');
            $(`.rekrutinput${id}`).val(1);
            $(`#rekrutform${id}`).submit();
        }

    }
    function rekrutCancel(id)
    {
        var comment = $(`#rekruting${id}`).val();

        if(comment.length > 5)
        {
            $('.rekrutbutton').addClass('d-none');
            $('.rekrutbutton2').removeClass('d-none');
            $(`.rekrutinput${id}`).val(2);
            $(`#rekrutform${id}`).submit();
        }

    }
        $(function() {
            $('[data-toggle="popover"]').popover()
        })

        function teachStar($i) {
            $('.allteachstar').css('color', 'white');
            $('#teachstarinput').val($i);
            for (let index = 1; index <= $i; index++) {
                $(`#teachstar${index}`).css('color', '#d4ed3c');
            }
        }
        $(document).ready(function() {
            $("#kingliga-btn").click();
            $("#recommendNews-btn").click();
            var first = <?php echo json_encode(Auth::user()->first_enter); ?>;
            if (first == 0) {
                // $('#firstenter').click();
            }
            var shogird = <?php echo json_encode(count(getShogird())); ?>;


            if (shogird > 0) {
                // $('#firstview').click();
            }
            // getShogird
        });

        function firstSuccess() {
            var _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/first-success",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#first-close').click();
                }
            });
        }

        function firstViewSuccess() {
            var _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/first-view",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#first-view-close22').click();
                }
            });
        }

        function teachStar($i) {
            $('.allteachstar').css('color', 'white');
            $('#teachstarinput').val($i);
            for (let index = 1; index <= $i; index++) {
                $(`#teachstar${index}`).css('color', '#d4ed3c');
            }
        }


        function upModal(id) {
            $(`#user-profil${id}`).click();
        }

        function ksCheck(id, b, e) {
            $(`#kscheck${id}${b}${e}`).click();
        }
    </script>
    <script>
        $(function() {
            $('[data-mask]').inputmask()
        });
        var dday = <?php echo json_encode(date('d', strtotime(getKSDay()['this_end']))); ?>;
        var dname = <?php echo json_encode(date('F', strtotime(getKSDay()['this_end']))); ?>;
        var countDownDate = new Date(dname + " " + dday + ", 2023 23:59:59").getTime();

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

        var countDownDate2 = new Date(dname + " " + dday + ", 2023 23:59:59").getTime();


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
        $(function() {
            var img = $('.imgvvv'),
                imgshow = $('#imgshowimg'),
                overly = $('#overimg'),
                close = $('#closeimg');
            img.on('click', function() {
                overly.show();
                imgshow.attr('src', $(this).attr('src'));
                close.click(function() {
                    overly.hide();
                });
            });
        });

        function changeTextPlan() {
            $('.for-plan-text-active').addClass('d-none');
            $('.for-plan-text').removeClass('d-none');
        }

        function clickPlan() {
            $('.click-plan').click();
            changeReytingTab(2);
            changeReytingTab(2);
            changeReytingTab(2);
        }

        function openKassa() {
            $(".kassa-input").each(function() {
                $(this).val(0);
                $('.summa-zakaz').text(0);
            })

        }

        function changeReytingTab(number) {
            $('.reyting-tab-class').removeClass('reyting-tab-active');
            $('.reyting-tab-class').addClass('reyting-tab');

            $(`.reyting-tab${number}`).removeClass('reyting-tab');
            $(`.reyting-tab${number}`).addClass('reyting-tab-active');
        }
        function changeReytingTabrey(number) {
            $('.reyting-tab-class').removeClass('new-reyting-tab-active');
            $('.reyting-tab-class').addClass('new-reyting-tab');

            $(`.reyting-tab${number}`).removeClass('new-reyting-tab');
            $(`.reyting-tab${number}`).addClass('new-reyting-tab-active');
        }
        function changeReytingTab23(number) {
            $('.reyting-tab-class23').removeClass('reyting-tab-active23');
            $('.reyting-tab-class23').addClass('reyting-tab23');

            $(`.reyting-tab${number}`).removeClass('reyting-tab23');
            $(`.reyting-tab${number}`).addClass('reyting-tab-active23');
        }

        function changeKingSoldTab(number) {
            $(`.king-sold-tab${number}`).removeClass('king-sold-tab');
            $(`.king-sold-tab${number}`).addClass('king-sold-tab-active');
            if (number == 2) {
                $('.king-sold-tab1').addClass('king-sold-tab');
                $('.king-sold-tab1').removeClass('king-sold-tab-active');

                $('.king-sold-tab3').addClass('king-sold-tab');
                $('.king-sold-tab3').removeClass('king-sold-tab-active');
            }
            if (number == 3) {
                $('.king-sold-tab1').addClass('king-sold-tab');
                $('.king-sold-tab1').removeClass('king-sold-tab-active');

                $('.king-sold-tab2').addClass('king-sold-tab');
                $('.king-sold-tab2').removeClass('king-sold-tab-active');
            }
            if (number == 1) {
                $('.king-sold-tab2').addClass('king-sold-tab');
                $('.king-sold-tab2').removeClass('king-sold-tab-active');

                $('.king-sold-tab3').addClass('king-sold-tab');
                $('.king-sold-tab3').removeClass('king-sold-tab-active');
            }
        }

        function changeColorReyting(d) {
            $('.delete-reyting-bg').css('background', 'white');
            $(`.${d}`).css('background', '#6a74b570');
        }
    </script>
    <script>
        window.onload = async function() {
            getAllNews()
            getUserCrystall()
        }

        function readNotificationEvent(id) {
            $.ajax({
                url: `/read-notification/${id}`,
                method: 'get',
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response > 0) {
                        $("#newsNotifCount").text(response);
                    } else {
                        $("#newsNotifCount").empty()
                        $("#newsNotifCountParent").empty()
                    }
                }
            })

        }

        function getUserCrystall() {
            $.ajax({
                url: '/user-crystall',
                method: 'get',
                contentType: false,
                processData: false,
                success: (response) => {
                    $("#userCrystall").append(`<div>${response}</div>`);
                    $("#userCrystallMain").append(`<div>${response}</div>`);
                }
            })
        }

        function setReaction() {
            setTimeout(() => {
                getAllNews();
            }, 1000);
        }

        function getAllNews() {
            let months = [
                'Yanvar',
                'Fevral',
                'Mart',
                'Aprel',
                'May',
                'Iyun',
                'Iyul',
                'August',
                'Sentabr',
                'Oktabr',
                'Noyabr',
                'Dekabr'
            ]
            $("#allnews").empty();
            $.ajax({
                url: '/allnews',
                method: 'get',
                contentType: false,
                processData: false,
                success: (response) => {
                    response.forEach(nw => {
                        let date = new Date(nw.created_at);
                        let emojies = nw.emojies.map(e => (`
                        <div class="mr-1 d-flex align-items-center justify-content-center">
                            <span class="pr-1" style="color:#78787c;font-size:12px;z-index:1000; font-weight:600">
                                ${e.count}
                            </span>
                            <span class="d-flex align-items-center justify-content-center" style="width:16px;height:16px">
                                ${e.icon}
                            </span>
                        </div>`))
                        .join("");
                        $("#allnews").append(`
                    <div class="news-card border mb-3 shadow bg-white"
                                style="height: 100px;padding:10px;border-radius:16px">
                                <div class="d-flex align-items-center">
                                    <div onclick="showNw(${nw.id})" data-toggle="modal" data-target="#showNws" style="width: 80px;height:80px;border-radius:8px;">
                                        <img src="${nw.img}" width="80" height="80" alt="">
                                    </div>
                                    <div style="height:80px;padding-left:10px;width:100%">
                                        <div class="d-flex align-items-center justify-content-between w-100"
                                            style="margin-bottom:5px;">
                                            <div style="font-size:11px;color:blue;font-weight:500">
                                                News
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                ${emojies}
                                            </div>
                                        </div>
                                        <div onclick="showNw(${nw.id})" data-toggle="modal" data-target="#showNws" class="supercell"
                                            style="font-weight:600;overflow:hidden;font-size:11px;height:35px">
                                            ${nw.title}
                                        </div>
                                        <div onclick="showNw(${nw.id})" data-toggle="modal" data-target="#showNws" style="margin-top:8px" class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <div
                                                    style="font-weight:500;font-size:11px;height:10px;color:#78787c">
                                                    ${date.getDate()} -
                                                    ${months[date.getMonth()]}
                                                </div>
                                                <div class="ml-4" style="opacity:0.6">
                                                    <div class="mr-1 d-flex align-items-center justify-content-center">
                                                        <span class="pr-1" style="color:#78787c;font-size:12px;z-index:1000; font-weight:600;opacity:0.8">
                                                            ${nw.shows.length > 0 ? nw.shows[0].show : 0}
                                                        </span>
                                                        <span class="d-flex align-items-center justify-content-center" style="width:14px;height:14px;opacity:0.6">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top:-10px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `)
                    })
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('.alert-danger').remove();
                $('.alert-success').remove();
            }, 4000);
            $('#choose-file-user').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-user-close').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user-close')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-king-sold').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-king-sold')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $("#submitSold").click(function() {
                $("#soldForm").submit();
                $("#submitSold").addClass('d-none');
                $("#close-zakaz").removeClass('d-none');
            });
            // $("#kas").click();

            var check = <?php echo json_encode(Session::get('checksold')); ?>;
            if (check != null) {
                $("#check").click();
            }

            var kingsold = <?php echo json_encode(Session::get('kingSold')); ?>;
            if (kingsold != null) {
                $(`#opencheck${kingsold}`).click();
            }

            var kingsoldcheck = <?php echo json_encode(Session::get('kingCheck')); ?>;
            if (kingsoldcheck != null) {
                $('#openkingchecksold').click();
            }

            // function openCode() {

                var code = makeCode();
                $('input[name=open_code]').val(code);
                $('.open-code').text(code);

            // }
        });

        function openCode() {
            var code = makeCode();
            $('input[name=open_code]').val(code);
            $('.open-code').text(code);

        }

        function closeCode() {
            var code = makeCode();
            $('input[name=close_code]').val(code);
            $('.close-code').text(code);
        }

        function makeCode() {

            var sdf = localStorage.getItem('codes');

            var time_storage = localStorage.getItem('time_storage');
            var time_now = $.now();

            if (time_storage) {
                if ((time_now - time_storage) > 900000) {
                    var result = '';
                    var characters = 'ABCDEFGHKLMNPQRSTUVWXYZ';
                    var numbers = '123456789';
                    var charactersLength = characters.length;
                    var numbersLength = numbers.length;
                    for (var i = 0; i < 1; i++) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    for (var i = 0; i < 2; i++) {
                        result += numbers.charAt(Math.floor(Math.random() * numbersLength));
                    }
                    var sdf = localStorage.setItem('codes', result);
                    localStorage.setItem('time_storage', $.now());
                }
            }
            var sdf = localStorage.getItem('codes');

            // console.log($.now());
            if (!sdf) {
                var result = '';
                var characters = 'ABCDEFGHKLMNPQRSTUVWXYZ';
                var numbers = '123456789';
                var charactersLength = characters.length;
                var numbersLength = numbers.length;
                for (var i = 0; i < 1; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                for (var i = 0; i < 2; i++) {
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

        function minus($id) {
            var stock = parseInt($(`.product${$id}`).val());
            if (stock <= 1) {
                $(`.product-border${$id}`).removeClass('plus-border');
                $(`.product-border${$id}`).addClass('product-border')
            }
            if (stock != 0) {
                ;
                $(`.product${$id}`).val(stock - 1);
                var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g, ''));

                var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g, ''));

                var allprice = number_format(orderPrice - price, 0, ',', ' ');

                $('.summa-zakaz').text(allprice);
            }

        }

        function plus($id) {
            var stock = parseInt($(`.product${$id}`).val());
            $(`.product${$id}`).val(stock + 1);
            var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g, ''));
            var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g, ''));

            console.log(orderPrice);

            var allprice = number_format(price + orderPrice, 0, ',', ' ');

            $('.summa-zakaz').text(allprice);
            $(`.product-border${$id}`).addClass('plus-border');
            $('.plus-border').removeClass('product-border');

        }

        function changeDay(number) {
            // console.log(number);
            if (number == 0) {
                $('.first_one').addClass('d-none');
                $('.first_two').removeClass('d-none');
            } else {
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
            }, {
                name: 'Liga',
                data: liga,
            }],
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
            },
            tooltip: {
                x: {},
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart_plan"), options);
        chart.render();
    </script>
@endsection
