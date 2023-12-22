<div class="modal-content">
    <style>
        .news-menu-item {
            width: 32.2%;
            padding: 9px 25px;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
            box-sizing: border-box;
            background: #677e97;
            border-top: 1px solid #7fa0b8;
            border-left: 1px solid #7fa0b8;
            border-right: 1px solid #7fa0b8;
        }

        .news-menu-item.active {
            background: #aadff9;
            border-top: 1px solid #74d5ff;
            border-left: 1px solid #74d5ff;
            border-right: 1px solid #74d5ff;
        }
        .news-menu-item a {
            font-size: 13px;
            text-align: center;
            text-shadow: -1px 1px 0 #000,
                1px 1px 0 #000,
                1px -1px 0 #000,
                -1px -1px 0 #000;
        }
    </style>
    <div class="modal-header p-0" style="position:relative;background:#384b5e">
        <div class="container p-0"
            style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
            <span class="supercell text-white pl-3" style="font-size:25px;">MEGA TURNIR</span>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="opacity: 5;position:absolute;top:8px;right:10px;">
            <img src="{{ asset('mobile/xclose.png') }}" width="30px">
        </button>

    </div>


    @if($resime == 2)

    <div class="col-12" style="background-image: url(/promo/dist/img/promo/bg2.png);">


        <div class="col-12 mt-1 mb-1" >
            <img src="{{asset('mobile/turnir/saroy.webp')}}" style="width:100%;" alt="">
        </div>


        <div class="container mt-1 mb-1" data-toggle="modal" data-target="#mega-turnir-dori">
            <div class="col-12 pt-4 pb-4 pr-3 supercell text-center"
                style="color: white;background-image: url({{ asset('mobile/counter.png') }});background-size: 100% 100%;">
                <img src="{{asset('mobile/turnir/newchoy.png')}}" style="width:15%;margin-right: 15px;" alt="">

                <span class="text-center" id="count-timer-day" style="font-size: 25px;"></span>
                <span style="font-size: 15px;">k :</span>
                <span class="text-center" id="count-timer-hour" style="font-size: 25px;"></span>
                <span style="font-size: 15px;">s :</span>
                <span class="text-center" id="count-timer-minut" style="font-size: 25px;"></span>
                <span style="font-size: 15px;">m</span>
            </div>
        </div>

        <div class="row">

            <div class="col-6 mt-1 mb-1" >
                <button class="btn btn-block supercell"
                style="background: #4b2c8b;
                border-radius: 12px;
                font-size: 28px;
                border: 2px solid white;
                color: white;"
                onclick="$('#turnirreyt').css('display','block');$('#turnirtab').css('display','none');"
                >MINI O'YIN</button>
                {{-- <img src="{{asset('mobile/turnir/turnirr.png')}}" style="width:100%;cursor: pointer;" height="60px" alt=""
                > --}}
            </div>

            <div class="col-6 mt-1 mb-1" >
                <button class="btn btn-block supercell"
                style="background: #ffbb2b;
                border-radius: 12px;
                font-size: 28px;
                border: 2px solid white;
                color: white;"
                onclick="$('#turnirreyt').css('display','none');$('#turnirtab').css('display','block');"
                >YARIM FINAL</button>
                {{-- <img src="{{asset('mobile/turnir/turnirb.png')}}" style="width:100%;cursor: pointer;" height="60px" alt=""
                > --}}
            </div>

        </div>




        <div class="border-0 mb-3" id="turnirreyt">
            <div class="col-12 mt-1 mb-1">
                @foreach ($user_battle_sold as $key => $battle)
                    {{-- @if ($key == 0)
                        <div class="supercell text-center mb-2" style="color:#2d4ac1">
                            Qiziq janglar
                        </div>
                    @endif
                    @if ($key == 3)
                        <div class="supercell text-center mb-2" style="color:#2d4ac1">
                            Qolgan janglar
                        </div>
                    @endif --}}
                    <div style="position: relative" class="mb-2">
                        @if ($key == 0 || $key == 1 || $key == 2)
                            <img style="width: 100%" src="{{ asset('mobile/turnir/turnirtop.png') }}"
                                alt="Image">
                        @else
                            <img style="width: 100%" src="{{ asset('mobile/turnir/turnirbattles.png') }}"
                                alt="Image">
                        @endif
                        @php
                            $user1 = DB::table('tg_user')->where('id',$battle['id1'])->first();
                            $user2 = DB::table('tg_user')->where('id',$battle['id2'])->first();
                        @endphp
                        <div class="teamimage1" style="left: 23px;">

                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text" style="font-size: 10px;">

                                    {{ $user1->first_name }}


                                    {{ substr($user1->last_name, 0, 1) }}

                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text" style="font-size: 13px;">{{formatterr($battle['sold1'])}}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text" style="font-size: 13px;">
                                        {{formatterr($battle['sold11'])}}
                                    </span>
                                </div>



                            </div>
                        </div>

                        <div class="teamimage2">
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text" style="font-size: 10px;">

                                    {{ $user2->first_name }}


                                    {{ substr($user2->last_name, 0, 1) }}

                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text" style="font-size: 13px;">{{formatterr($battle['sold2'])}}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text" style="font-size: 13px;">
                                        {{formatterr($battle['sold22'])}}
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach
            <style>
                @media (min-width: 200px) {
                    .turnir-all-text {
                        font-size: 9px;
                    }

                    .teamimage3{
                        position: absolute;
                        display: flex;
                        top: 76%;
                        left: 35%;
                        -webkit-text-stroke: 1px #040c10;
                        font-size: 15px;
                    }

                    .teamimage1 {
                        position: absolute;
                        display: flex;
                        top: 18%;
                        left: 2%;
                    }

                    .teamimage2 {
                        display: flex;
                        position: absolute;
                        top: 18%;
                        right: 2%;
                    }

                    .teamprof-detail {
                        display: flex;
                        overflow: hidden;
                        width: 50px;
                        height: 50px;
                    }

                    .teamprof-detail div {
                        overflow: hidden;
                        width: 50%;
                    }

                    .teamprof-detail div img {
                        transform: translateX(-30%);
                        width: 50px;
                    }

                    .tur-all-gold {
                        width: 12px;
                    }

                    .tur-all-king {
                        width: 12px;
                    }
                }

                @media (max-width: 540px) {
                    .teamimage2 {
                        left: 330px;
                    }
                }
                @media (max-width: 500px) {
                    .teamimage2 {
                        left: 290px;
                    }
                }
                @media (max-width: 450px) {
                    .teamimage2 {
                        left: 242px;
                    }
                }
                @media (max-width: 350px) {
                    .teamimage2 {
                        left: 142px;
                    }
                }
                @media (min-width: 340px) {
                    .teamimage1 {
                        top: 20%;
                    }

                    .teamimage2 {
                        top: 20%;
                    }

                    .teamprof-detail {
                        width: 52px;
                        height: 52px;
                    }

                    .teamprof-detail div img {
                        transform: translateX(-35%);
                        width: 52px;
                    }

                    .tur-all-gold {
                        width: 16px;
                    }

                    .tur-all-king {
                        width: 16px;
                    }
                }

                @media (min-width: 370px) {
                    .teamimage1 {
                        top: 17%;
                    }

                    .teamimage2 {
                        top: 17%;
                    }

                    .teamprof-detail {
                        display: flex;
                        overflow: hidden;
                        width: 65px;
                        height: 65px;
                    }

                    .teamprof-detail div img {
                        transform: translateX(-40%);
                        width: 65px;
                    }
                }

                @media (min-width: 410px) {
                    .turnir-all-text {
                        font-size: 10px;
                    }

                    .teamprof-detail {
                        width: 70px;
                        height: 70px;
                    }

                    .teamprof-detail div img {
                        transform: translateX(-40%);
                        width: 70px;
                    }

                    .tur-all-gold {
                        width: 18px;
                    }

                    .tur-all-king {
                        width: 18px;
                    }
                }
            </style>
        </div>
        </div>
        <div class="border-0 mb-3" id="turnirtab" style="display:none;">
            <div class="col-12 mt-1 mb-1">
                @foreach ($user_battle_sold2 as $key => $battle)
                    {{-- @if ($key == 0)
                        <div class="supercell text-center mb-2" style="color:#2d4ac1">
                            Qiziq janglar
                        </div>
                    @endif
                    @if ($key == 3)
                        <div class="supercell text-center mb-2" style="color:#2d4ac1">
                            Qolgan janglar
                        </div>
                    @endif --}}
                    <div style="position: relative" class="mb-2">
                        @if ($key == 0 || $key == 1 || $key == 2)
                            <img style="width: 100%" src="{{ asset('mobile/turnir/turnirtop.png') }}"
                                alt="Image">
                        @else
                            <img style="width: 100%" src="{{ asset('mobile/turnir/turnirbattles.png') }}"
                                alt="Image">
                        @endif
                        @php
                            $user1 = DB::table('tg_user')->where('id',$battle['id1'])->first();
                            $user2 = DB::table('tg_user')->where('id',$battle['id2'])->first();
                        @endphp
                        <div class="teamimage1" style="left: 23px;">

                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text" style="font-size: 10px;">

                                    {{ $user1->first_name }}


                                    {{ substr($user1->last_name, 0, 1) }}

                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text" style="font-size: 13px;">{{formatterr($battle['sold1'])}}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text" style="font-size: 13px;">
                                        {{formatterr($battle['sold11'])}}
                                    </span>
                                </div>




                            </div>
                        </div>

                        <div class="teamimage2">
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text" style="font-size: 10px;">

                                    {{ $user2->first_name }}


                                    {{ substr($user2->last_name, 0, 1) }}

                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text" style="font-size: 13px;">{{formatterr($battle['sold2'])}}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text" style="font-size: 13px;">
                                        {{formatterr($battle['sold22'])}}

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="teamimage3">
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text" style="font-size: 15px;">
                                    LIMIT: {{$battle['limit']/100}} mln
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach
            <style>
                @media (min-width: 200px) {
                    .turnir-all-text {
                        font-size: 9px;
                    }

                    .teamimage3{
                        position: absolute;
                        display: flex;
                        top: 76%;
                        left: 35%;
                        -webkit-text-stroke: 1px #040c10;
                        font-size: 15px;
                    }

                    .teamimage1 {
                        position: absolute;
                        display: flex;
                        top: 18%;
                        left: 2%;
                    }

                    .teamimage2 {
                        display: flex;
                        position: absolute;
                        top: 18%;
                        right: 2%;
                    }

                    .teamprof-detail {
                        display: flex;
                        overflow: hidden;
                        width: 50px;
                        height: 50px;
                    }

                    .teamprof-detail div {
                        overflow: hidden;
                        width: 50%;
                    }

                    .teamprof-detail div img {
                        transform: translateX(-30%);
                        width: 50px;
                    }

                    .tur-all-gold {
                        width: 12px;
                    }

                    .tur-all-king {
                        width: 12px;
                    }
                }

                @media (max-width: 540px) {
                    .teamimage2 {
                        left: 330px;
                    }
                }
                @media (max-width: 500px) {
                    .teamimage2 {
                        left: 290px;
                    }
                }
                @media (max-width: 450px) {
                    .teamimage2 {
                        left: 242px;
                    }
                }
                @media (max-width: 350px) {
                    .teamimage2 {
                        left: 142px;
                    }
                }
                @media (min-width: 340px) {
                    .teamimage1 {
                        top: 20%;
                    }

                    .teamimage2 {
                        top: 20%;
                    }

                    .teamprof-detail {
                        width: 52px;
                        height: 52px;
                    }

                    .teamprof-detail div img {
                        transform: translateX(-35%);
                        width: 52px;
                    }

                    .tur-all-gold {
                        width: 16px;
                    }

                    .tur-all-king {
                        width: 16px;
                    }
                }

                @media (min-width: 370px) {
                    .teamimage1 {
                        top: 17%;
                    }

                    .teamimage2 {
                        top: 17%;
                    }

                    .teamprof-detail {
                        display: flex;
                        overflow: hidden;
                        width: 65px;
                        height: 65px;
                    }

                    .teamprof-detail div img {
                        transform: translateX(-40%);
                        width: 65px;
                    }
                }

                @media (min-width: 410px) {
                    .turnir-all-text {
                        font-size: 10px;
                    }

                    .teamprof-detail {
                        width: 70px;
                        height: 70px;
                    }

                    .teamprof-detail div img {
                        transform: translateX(-40%);
                        width: 70px;
                    }

                    .tur-all-gold {
                        width: 18px;
                    }

                    .tur-all-king {
                        width: 18px;
                    }
                }
            </style>
        </div>
        </div>
    </div>
    @endif
    <script>
        var dday = <?php echo json_encode(date('d', strtotime('2023-12-28'))); ?>;
        var dname = <?php echo json_encode(date('F', strtotime('2023-12-28'))); ?>;
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
    </script>
</div>
