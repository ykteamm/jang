
<div class="modal-content">
    @if($resime == 2)
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
    <div class="modal-header p-0" style="position:relative;height:90px;background:#384b5e">
        <button type="button" class="close" data-dismiss="modal" aria-label="allNews"
            style="opacity: 5;position:absolute;top:8px;right:10px;z-index:20">
            <img src="{{ asset('mobile/news/close.png') }}" width="30px">
        </button>
        <div class="supercell d-flex align-items-center justify-content-center"
            style="position:absolute;top:0px;left:0;right:0;font-size:22px">
            <div class="pl-4 text-white pt-2"
                style="text-shadow: -1px 4px 0 #000, 3px 1px 0 #000, 3px -1px 0 #000, -1px -1px 0 #000">
                Turnir</div>
        </div>
        <div style="position: absolute; bottom:3px;left:0;right:0">
            <ul class="mx-1 navbar-nav flex-row align-items-center justify-content-around">
                {{-- <li onclick="megachangeTab1()" id="megaturnirTab1" class="nav-item news-menu-item active">
                    <a class="nav-link p-0 text-white supercell" href="#">Jamoa</a>
                </li> --}}
                {{-- <li onclick="megachangeTab2()" id="megaturnirTab2" class="nav-item news-menu-item active">
                    <a class="nav-link p-0 text-white supercell" href="#">Jangchi</a>
                </li> --}}
            </ul>
        </div>
        <script>
            function megachangeTab1() {
                let tab1 = document.querySelector(`#megaturnirTab1`)
                let tab2 = document.querySelector(`#megaturnirTab2`)
                let tabmain1 = document.querySelector(`#megaturnir1tab`)
                let tabmain2 = document.querySelector(`#megaturnir2tab`)
                tab2.classList.remove('active')
                tab1.classList.add('active')
                tabmain1.classList.remove('d-none')
                tabmain2.classList.add('d-none')
            }

            function megachangeTab2() {
                let tab1 = document.querySelector(`#megaturnirTab1`)
                let tab2 = document.querySelector(`#megaturnirTab2`)
                let tabmain1 = document.querySelector(`#megaturnir1tab`)
                let tabmain2 = document.querySelector(`#megaturnir2tab`)
                tab2.classList.add('active')
                tab1.classList.remove('active')
                tabmain1.classList.add('d-none')
                tabmain2.classList.remove('d-none')
            }
        </script>
        <div style="position:absolute;height:1px;top:86px;background:#74d5ff;width:100%"></div>
    </div>
    <div id="megaturnir1tab" class="modal-body p-0">
        <div class="col-12 mt-1 mb-1">
                @foreach ($user_battle_sold as $key => $battle)
                    @if ($key == 0)
                        <div class="supercell text-center mb-2" style="color:#2d4ac1">
                            Qiziq janglar
                        </div>
                    @endif
                    @if ($key == 3)
                        <div class="supercell text-center mb-2" style="color:#2d4ac1">
                            Qolgan janglar
                        </div>
                    @endif
                    <div style="position: relative" class="mb-2">
                        @if ($key == 0 || $key == 1 || $key == 2)
                            <img style="width: 100%" src="{{ asset('mobile/turnir/turnirtop.png') }}"
                                alt="Image">
                        @else
                            <img style="width: 100%" src="{{ asset('mobile/turnir/turnirbattles.png') }}"
                                alt="Image">
                        @endif
                        <div class="teamimage1">
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ asset('mobile/target.webp') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('mobile/target.webp') }}" alt="">
                                </div>
                            </div>
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ $battle['user1']->first_name }} {{ substr($battle['user1']->last_name, 0, 1) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{formatterr($battle['sold1'])}}</span>
                                </div>
                                {{-- <div class="mt-1 d-flex align-items-center justify-content-center"> 
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}"
                                        alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">444</span>
                                </div>43 --}}
                            </div>
                        </div>
                        <div class="teamimage2">
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ $battle['user2']->first_name }} {{ substr($battle['user2']->last_name, 0, 1) }}

                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{formatterr($battle['sold2'])}}</span>
                                </div>
                                {{-- <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}"
                                        alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">43</span>
                                </div> --}}
                            </div>
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ asset('mobile/target.webp') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('mobile/target.webp') }}" alt="">
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
        <div id="megaturnir2tab" class="modal-body p-0 d-none">
            <div class="col-12 mt-1 mb-1">
                @foreach ($team_battle_sold as $key => $battle)
                    @if ($key == 0)
                        <div class="supercell text-center mb-2" style="color:#2d4ac1">
                            Qiziq janglar
                        </div>
                    @endif
                    @if ($key == 3)
                        <div class="supercell text-center mb-2" style="color:#2d4ac1">
                            Qolgan janglar
                        </div>
                    @endif
                    <div style="position: relative" class="mb-2">
                        @if ($key == 0 || $key == 1 || $key == 2)
                            <img style="width: 100%" src="{{ asset('mobile/turnir/turnirtop.png') }}"
                                alt="Image">
                        @else
                            <img style="width: 100%" src="{{ asset('mobile/turnir/turnirbattles.png') }}"
                                alt="Image">
                        @endif
                        <div class="teamimage1">
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ asset('mobile/target.webp') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('mobile/target.webp') }}" alt="">
                                </div>
                            </div>
                            <div class="turnir-all-result">
                                <div class="text-default-secondary mt-1 supercell turnir-all-text">
                                    {{ $battle['teacher1']->first_name }} {{ substr($battle['teacher1']->last_name, 0, 1) }}
                                </div>
                                <div class="text-default-secondary mt-1 supercell turnir-all-text">
                                   Jamoasidan
                                </div>
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ $battle['user1']->first_name }} {{ substr($battle['user1']->last_name, 0, 1) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{formatterr($battle['sold1'])}}</span>
                                </div>
                                {{-- <div class="mt-1 d-flex align-items-center justify-content-center"> 
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}"
                                        alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">444</span>
                                </div>43 --}}
                            </div>
                        </div>
                        <div class="teamimage2">
                            <div class="turnir-all-result">
                                <div class="text-default-secondary mt-1 supercell turnir-all-text">
                                    {{ $battle['teacher2']->first_name }} {{ substr($battle['teacher2']->last_name, 0, 1) }}
                                </div>
                                <div class="text-default-secondary mt-1 supercell turnir-all-text">
                                    Jamoasidan
                                </div>
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ $battle['user2']->first_name }} {{ substr($battle['user2']->last_name, 0, 1) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{formatterr($battle['sold2'])}}</span>
                                </div>
                                {{-- <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}"
                                        alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">43</span>
                                </div> --}}
                            </div>
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ asset('mobile/target.webp') }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ asset('mobile/target.webp') }}" alt="">
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
</div>
