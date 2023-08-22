
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
                <li onclick="changeTab1()" id="turnirTab1" class="nav-item news-menu-item active">
                    <a class="nav-link p-0 text-white supercell" href="#">Jadval</a>
                </li>
                <li onclick="changeTab2()" id="turnirTab2" class="nav-item news-menu-item">
                    <a class="nav-link p-0 text-white supercell" href="#">Janglar</a>
                </li>
            </ul>
        </div>
        <script>
            function changeTab1() {
                let tab1 = document.querySelector(`#turnirTab1`)
                let tab2 = document.querySelector(`#turnirTab2`)
                let tabmain1 = document.querySelector(`#turnir1tab`)
                let tabmain2 = document.querySelector(`#turnir2tab`)
                tab2.classList.remove('active')
                tab1.classList.add('active')
                tabmain1.classList.remove('d-none')
                tabmain2.classList.add('d-none')
            }

            function changeTab2() {
                let tab1 = document.querySelector(`#turnirTab1`)
                let tab2 = document.querySelector(`#turnirTab2`)
                let tabmain1 = document.querySelector(`#turnir1tab`)
                let tabmain2 = document.querySelector(`#turnir2tab`)
                tab2.classList.add('active')
                tab1.classList.remove('active')
                tabmain1.classList.add('d-none')
                tabmain2.classList.remove('d-none')
            }
        </script>
        <div style="position:absolute;height:1px;top:86px;background:#74d5ff;width:100%"></div>
    </div>
    <div id="turnir2tab" class="modal-body p-0 d-none">
        {{-- <div class="col-12 mt-1 mb-1 text-center">
            <h2 style="color: red">Har bir jamoaning sotuvlari bittalab tekshirilyapti.Yaqin orada yarim final g'oliblarini e'lon qilamiz.</h2>
        </div> --}}
        <div class="col-12 mt-1 mb-1">
            @if ($playOffStart)
                <div class="supercell text-center mb-2" style="color:#2d4ac1">
                    {{ $tourTitle }} janglar
                </div>
                @foreach ($playOffBattles as $key => $battle)
                    <div style="position: relative" class="mb-2">
                        <img style="width: 100%" src="{{ asset('mobile/turnir/turnirtop.png') }}" alt="Image">
                        <div class="teamimage1">
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ $battle->team1[0]->users[0]->img }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ $battle->team1[0]->users[1]->img }}" alt="">
                                </div>
                            </div>
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ substr($battle->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($battle->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ formatterr($battle->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ $battle->team1[0]->ksb[0]->count }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="teamimage2">
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ substr($battle->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($battle->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ formatterr($battle->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ $battle->team2[0]->ksb[0]->count }}</span>
                                </div>
                            </div>
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ $battle->team2[0]->users[0]->img }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ $battle->team2[0]->users[1]->img }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="supercell text-center mb-2" style="color:#2d4ac1">
                    Qolgan janglar
                </div>
                @foreach ($playOffGames as $key => $battle)
                    <div style="position: relative" class="mb-2">
                        <img style="width: 100%" src="{{ asset('mobile/turnir/turnirbattles.png') }}" alt="Image">
                        <div class="teamimage1">
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ $battle->team1[0]->users[0]->img }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ $battle->team1[0]->users[1]->img }}" alt="">
                                </div>
                            </div>
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ substr($battle->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($battle->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ formatterr($battle->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ $battle->team1[0]->ksb[0]->count }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="teamimage2">
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ substr($battle->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($battle->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ formatterr($battle->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}"
                                        alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ $battle->team2[0]->ksb[0]->count }}</span>
                                </div>
                            </div>
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ $battle->team2[0]->users[0]->img }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ $battle->team2[0]->users[1]->img }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($groupBattles as $key => $battle)
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
                                    <img src="{{ $battle->team1[0]->users[0]->img }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ $battle->team1[0]->users[1]->img }}" alt="">
                                </div>
                            </div>
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ substr($battle->team1[0]->users[0]->f, 0, 8) }}{{ ' + ' }}{{ substr($battle->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ formatterr(($battle->team1[0]->prodaja[0]->allprice)) }}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center"> 
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}"
                                        alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ ($battle->team1[0]->ksb[0]->count) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="teamimage2">
                            <div class="turnir-all-result">
                                <div class="text-white mt-1 supercell turnir-all-text">
                                    {{ substr($battle->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($battle->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-gold" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ formatterr(($battle->team2[0]->prodaja[0]->allprice)) }}</span>
                                </div>
                                <div class="mt-1 d-flex align-items-center justify-content-center">
                                    <img class="tur-all-king" src="{{ asset('mobile/load-king.png') }}"
                                        alt="">
                                    <span
                                        class="pl-1 text-white supercell turnir-all-text">{{ ($battle->team2[0]->ksb[0]->count) }}</span>
                                </div>
                            </div>
                            <div class="teamprof-detail rounded-circle mx-auto" style="border:1px solid #fff">
                                <div>
                                    <img src="{{ $battle->team2[0]->users[0]->img }}" alt="">
                                </div>
                                <div>
                                    <img src="{{ $battle->team2[0]->users[1]->img }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
    <div id="turnir1tab" class="modal-body p-0">
        {{-- <div class="col-12 mt-1 mb-1 text-center">
            <h2 style="color: red">Har bir jamoaning sotuvlari bittalab tekshirilyapti.Yaqin orada yarim final g'oliblarini e'lon qilamiz.</h2>
        </div> --}}
        <div class="col-12">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/tr1.webp') }}">
        </div>
        <div class="col-12">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/tr2.webp') }}">
        </div>
        <div class="col-12">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/tr3.webp') }}">
        </div>
        {{-- <div class="col-12">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/playoff.webp') }}">
        </div> --}}
        <div class="container mt-1 mb-1">
            <div class="col-12 pt-4 pb-4 pr-3 supercell text-center"
                style="color: white;background-image: url({{ asset('mobile/counter.png') }});background-size: 100% 100%;">
                <span class="text-center" id="" style="font-size: 35px;">{{ $timer['day'] }}</span>
                <span style="font-size: 15px;">kun :</span>
                <span class="text-center" id="" style="font-size: 35px;">{{ $timer['hour'] }}</span>
                <span style="font-size: 15px;">soat :</span>
                <span class="text-center" id="" style="font-size: 35px;">{{ $timer['minut'] }}</span>
                <span style="font-size: 15px;">min</span>
                <p class="p-0" style="font-size: 20px;">
                    @if ($playOffStart)
                        {{ $tourTitle }} tugashiga qoldi
                    @else
                        Turnir gurux bosqichi tugashiga qoldi
                    @endif
                </p>
            </div>
        </div>
        <div>

        @if ($playOffStart)
            <div class="col-12 mt-3 play-off-image">
                <style>
                    .play-off-image {
                        overflow-x: scroll;
                    }
                    .play-off-image::-webkit-scrollbar {
                        display: none
                    }
                </style>
                <div style="height:750px;width:877px;position:relative">
                    <img style="height:750px;width:877px"  src="{{ asset('mobile/turnir/turChem2.jpeg') }}"
                        alt="">
                    @if ($node1)
                        <div class="node1-1" style="position:absolute;top:148px;left:34px">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node1[0]->team1[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node1[0]->team1[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node1[0]->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node1[0]->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node1[0]->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="node1-2" style="position:absolute;top:267px;left:34px">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node1[0]->team2[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node1[0]->team2[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node1[0]->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node1[0]->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node1[0]->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($node2)
                        <div class="node2-1" style="position:absolute;top:452px;left:34px">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node2[0]->team1[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node2[0]->team1[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node2[0]->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node2[0]->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node2[0]->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="node2-2" style="position:absolute;top:569px;left:34px">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node2[0]->team2[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node2[0]->team2[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node2[0]->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node2[0]->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node2[0]->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($node3)
                        <div class="node3-1" style="position:absolute;top:148px;right:50px">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node3[0]->team1[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node3[0]->team1[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node3[0]->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node3[0]->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node3[0]->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="node3-2" style="position:absolute;top:267px;right:50px">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node3[0]->team2[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node3[0]->team2[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node3[0]->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node3[0]->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node3[0]->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($node4)
                        <div class="node4-1" style="position:absolute;top:452px;right:50px">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node4[0]->team1[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node4[0]->team1[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node4[0]->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node4[0]->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node4[0]->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="node4-2" style="position:absolute;top:569px;right:50px">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node4[0]->team2[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node4[0]->team2[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node4[0]->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node4[0]->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node4[0]->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($node5)
                        <div class="node4-1" style="position:absolute;top:301px;left: 175px;">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node5[0]->team1[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node5[0]->team1[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node5[0]->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node5[0]->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node5[0]->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="node1-2" style="position:absolute;top: 416px;left: 173px;">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node5[0]->team2[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node5[0]->team2[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node5[0]->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node5[0]->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node5[0]->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($node6)
                        <div class="node4-1" style="position:absolute;top:300px;left:625px;">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node6[0]->team1[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node6[0]->team1[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node6[0]->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node6[0]->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node6[0]->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="node1-2" style="position:absolute;top: 416px;left: 625px;">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node6[0]->team2[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node6[0]->team2[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node6[0]->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node6[0]->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node6[0]->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- @if ($node7)
                        <div class="node4-1" style="position:absolute;top:354px;left:323px;">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node7[0]->team1[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node7[0]->team1[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node7[0]->team1[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node7[0]->team1[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node7[0]->team1[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="node1-2" style="position:absolute;top: 353px;left: 480px;">
                            <div class="pl-node">
                                <div class="pl-images rounded-circle mx-auto" style="border:1px solid #fff">
                                    <div>
                                        <img src="{{ $node7[0]->team2[0]->users[0]->img }}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{ $node7[0]->team2[0]->users[1]->img }}" alt="">
                                    </div>
                                </div>
                                <div class="text-white supercell pl-names">
                                    {{ substr($node7[0]->team2[0]->users[0]->f, 0, 3) }}{{ ' + ' }}{{ substr($node7[0]->team2[0]->users[1]->f, 0, 3) }}
                                </div>
                                <div class="d-flex align-items-center justify-content-center pl-summa">
                                    <img class="turnir-oltin" src="{{ asset('mobile/oltin.png') }}" alt="">
                                    <span
                                        class="pl-1 text-white supercell">{{ formatterr($node7[0]->team2[0]->prodaja[0]->allprice) }}</span>
                                </div>
                            </div>
                        </div>
                    @endif --}}
                    <style>
                        .turnir-oltin {
                            width:12px;
                        }
                        .pl-names {
                            position: absolute;
                            top: 50px;
                            left: -10px;
                            width: 90px;
                            height: 12px;
                            font-size: 10px;
                            text-align: center;
                        }

                        .pl-summa {
                            position: absolute;
                            top: 68px;
                            left: 9px;
                            width: 43px;
                            font-size: 10px;
                            height: 11px;
                        }

                        .pl-node {
                            width: 61px;
                            height: 50px;
                            position: relative;
                            border-radius: 8px;
                        }

                        .pl-images {
                            position: absolute;
                            top: 0px;
                            left: 14px;
                            display: flex;
                            overflow: hidden;
                            width: 50px;
                            height: 50px;
                        }

                        .pl-images div {
                            overflow: hidden;
                            width: 50%;
                        }

                        .pl-images div img {
                            transform: translateX(-35%);
                            width: 45px;
                        }
                    </style>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card border-0 mb-3" data-toggle="modal" data-target="#region-profil">
                    <div class="card-body" class="pr-0"
                        style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                        <div class="supercell text-center">{{ $tourTitle }} dagi jamoalar</div>
                        <div class="row align-items-center pr-3 py-1" style="border-bottom:2px solid #959690">
                            <div class="col-2 pl-2 text-center">
                                <span style="font-size:14px;font-weight:800">N</span>
                            </div>
                            <div class="col-8">
                                <div style="font-size:14px;font-weight:800">
                                    Jamoa
                                </div>
                            </div>
                            <div class="col-2 p-0 pl-3" style="font-size:14px;font-weight:800">
                                Ball
                            </div>
                        </div>
                        @foreach ($playOfTable as $key => $team)
                            @php
                                if ($key == 0) {
                                    $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#a1aab8,#d4d9e0,#767c81);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #e7eae8;';
                                }
                                if (!in_array($key, [0])) {
                                    $color = '-webkit-text-stroke: 1px #36393a !important;background: #bdcedd;border: 1px solid #c8b7b7;';
                                }
                            @endphp
                            <div class="row align-items-center pr-3 py-1" style="border-bottom:1px solid #959690">
                                <div class="col-2 pl-2">
                                    <button type="button" class="btn-sm btn-secondary supercell p-0"
                                        style="{{ $color }};width: 35px;height: 35px;">
                                        @php
                                            $wer = $key + 1 . '.';
                                        @endphp
                                        <span
                                            style="font-size: 16px;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                            {{ $key + 1 }}</span>
                                    </button>
                                </div>
                                <div class="col-8"
                                    style="border-left:1px solid #959690;border-right:1px solid #959690">
                                    <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                        {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }}
                                    </div>
                                    <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                        {{ substr($team->f2, 0, 8) }}.{{ substr($team->l2, 0, 1) }}
                                    </div>
                                </div>
                                <div class="col-2 text-center">
                                    <button type="button" class="btn btn-sm btn-secondary supercell"
                                        style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 55px;height: 40px;">
                                        <span class="text-center"
                                            style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                            {{ $team->ball }}
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card border-0 mb-3" data-toggle="modal" data-target="#region-profil">
                    <div class="card-body" class="pr-0"
                        style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                        <div class="supercell text-center">Play-off dan chiqib ketgan jamoalar</div>
                        <div class="row align-items-center pr-3 py-1" style="border-bottom:2px solid #959690">
                            <div class="col-2 pl-2 text-center">
                                <span style="font-size:14px;font-weight:800">N</span>
                            </div>
                            <div class="col-8">
                                <div style="font-size:14px;font-weight:800">
                                    Jamoa
                                </div>
                            </div>
                            <div class="col-2 p-0 pl-3" style="font-size:14px;font-weight:800">
                                Ball
                            </div>
                        </div>
                        @foreach ($gamesTable as $key => $team)
                            @php
                                if ($key == 0) {
                                    $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#a1aab8,#d4d9e0,#767c81);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #e7eae8;';
                                }
                                if (!in_array($key, [0])) {
                                    $color = '-webkit-text-stroke: 1px #36393a !important;background: #bdcedd;border: 1px solid #c8b7b7;';
                                }
                            @endphp
                            <div class="row align-items-center pr-3 py-1" style="border-bottom:1px solid #959690">
                                <div class="col-2 pl-2">
                                    <button type="button" class="btn-sm btn-secondary supercell p-0"
                                        style="{{ $color }};width: 35px;height: 35px;">
                                        @php
                                            $wer = $key + 1 . '.';
                                        @endphp
                                        <span
                                            style="font-size: 16px;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                            {{ $key + 1 }}</span>
                                    </button>
                                </div>
                                <div class="col-8"
                                    style="border-left:1px solid #959690;border-right:1px solid #959690">
                                    <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                        {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }}
                                    </div>
                                    <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                        {{ substr($team->f2, 0, 8) }}.{{ substr($team->l2, 0, 1) }}
                                    </div>
                                </div>
                                <div class="col-2 text-center">
                                    <button type="button" class="btn btn-sm btn-secondary supercell"
                                        style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 45px;height: 40px;">
                                        <span class="text-center"
                                            style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                            {{ $team->ball }}
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if ($tour <= 9)
            @if ($playOffStart)
                <div class="col-12">
                    <button class="my-4 btn btn btn-light supercell w-100" data-toggle="collapse"
                        data-target="#turnirGroupTable" aria-expanded="false" aria-controls="turnirGroupTable"
                        style="font-size:16px;font-weight:600">
                        Gurux jadvali
                    </button>
                </div>
                <div id="turnirGroupTable" class="collapse" aria-labelledby="turnirGroupTable">
                    @foreach ($groupsTable as $nm => $group)
                        <div class="col-12 mt-3">
                            <div class="card border-0 mb-3" data-toggle="modal" data-target="#region-profil">
                                <div class="card-body" class="pr-0"
                                    style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                                    <div class="supercell text-center">{{ $nm }} Gurux</div>
                                    <div class="row align-items-center pr-3 py-1"
                                        style="border-bottom:2px solid #959690">
                                        <div class="col-2 pl-2 text-center">
                                            <span style="font-size:14px;font-weight:800">N</span>
                                        </div>
                                        <div class="col-5">
                                            <div style="font-size:14px;font-weight:800">
                                                Jamoa
                                            </div>
                                        </div>
                                        <div class="col-3 text-center p-0" style="padding-right: 4px !important;">
                                            <div style="font-size:14px;font-weight:800">
                                                Tur
                                            </div>
                                        </div>
                                        <div class="col-2 p-0 pl-3" style="font-size:14px;font-weight:800">
                                            Ball
                                        </div>
                                    </div>
                                    @foreach ($group as $key => $team)
                                        @php
                                            if ($key == 0) {
                                                $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#f3e48d,#ffd20f,#c39008);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fff0a8;';
                                            }
                                            if ($key == 1) {
                                                $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#a1aab8,#d4d9e0,#767c81);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #e7eae8;';
                                            }
                                            // if ($key == 2) {
                                            //     $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#c7854d,#d89d6e,#946c48);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fbe2c4;';
                                            // }
                                            if (!in_array($key, [0, 1])) {
                                                $color = '-webkit-text-stroke: 1px #36393a !important;background: #bdcedd;border: 1px solid #c8b7b7;';
                                            }
                                        @endphp
                                        <div class="row align-items-center pr-3 py-1"
                                            style="border-bottom:1px solid #959690;">
                                            <div class="col-2 pl-2">
                                                <button type="button" class="btn-sm btn-secondary supercell p-0"
                                                    style="{{ $color }};width: 35px;height: 35px;">
                                                    @php
                                                        $wer = $key + 1 . '.';
                                                    @endphp
                                                    <span
                                                        style="font-size: 16px;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                        {{ $key + 1 }}</span>
                                                </button>
                                            </div>
                                            <div class="col-5"
                                                style="border-left:1px solid #959690;border-right:1px solid #959690">
                                                <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                                    {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }}
                                                </div>
                                                <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                                    {{ substr($team->f2, 0, 8) }}.{{ substr($team->l2, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="col-3 text-center p-0" style="padding-right: 4px !important;">
                                                <div style="font-size:15px;font-weight:800">
                                                    {{ $tour > 3 ? 3 : $tour }}
                                                </div>
                                            </div>
                                            <div class="col-2 text-center" style="border-left:1px solid #959690;">
                                                <button type="button" class="btn btn-sm btn-secondary supercell"
                                                    style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 45px;height: 40px;">
                                                    <span class="text-center"
                                                        style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                        {{ $team->ball }}
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
            {{-- <div class="d-none"> --}}
                @foreach ($groupsTable as $nm => $group)
                    <div class="col-12 mt-3">
                        <div class="card border-0 mb-3" data-toggle="modal" data-target="#region-profil">
                            <div class="card-body" class="pr-0"
                                style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                                <div class="supercell text-center">{{ $nm }} Gurux</div>
                                <div class="row align-items-center pr-3 py-1" style="border-bottom:2px solid #959690">
                                    <div class="col-2 pl-2 text-center">
                                        <span style="font-size:14px;font-weight:800">N</span>
                                    </div>
                                    <div class="col-5">
                                        <div style="font-size:14px;font-weight:800">
                                            Jamoa
                                        </div>
                                    </div>
                                    <div class="col-3 text-center p-0" style="padding-right: 4px !important;">
                                        <div style="font-size:14px;font-weight:800">
                                            Tur
                                        </div>
                                    </div>
                                    <div class="col-2 p-0 pl-3" style="font-size:14px;font-weight:800">
                                        Ball
                                    </div>
                                </div>
                                @foreach ($group as $key => $team)
                                    @php
                                        if ($key == 0) {
                                            $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#f3e48d,#ffd20f,#c39008);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fff0a8;';
                                        }
                                        if ($key == 1) {
                                            $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#a1aab8,#d4d9e0,#767c81);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #e7eae8;';
                                        }
                                        if (!in_array($key, [0, 1])) {
                                            $color = '-webkit-text-stroke: 1px #36393a !important;background: #bdcedd;border: 1px solid #c8b7b7;';
                                        }
                                    @endphp
                                    @if (in_array($key,[0,1]))
                                        <div class="row align-items-center pr-3 py-1"
                                            style="border-bottom:1px solid #959690;background: #62e042;">
                                            <div class="col-2 pl-2">
                                                <button type="button" class="btn-sm btn-secondary supercell p-0"
                                                    style="{{ $color }};width: 35px;height: 35px;">
                                                    @php
                                                        $wer = $key + 1 . '.';
                                                    @endphp
                                                    <span
                                                        style="font-size: 16px;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                        {{ $key + 1 }}</span>
                                                </button>
                                            </div>
                                            <div class="col-5"
                                                style="border-left:1px solid #959690;border-right:1px solid #959690">
                                                <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                                    {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }}
                                                </div>
                                                <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                                    {{ substr($team->f2, 0, 8) }}.{{ substr($team->l2, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="col-3 text-center p-0" style="padding-right: 4px !important;">
                                                <div style="font-size:15px;font-weight:800">{{ $tour }}
                                                </div>
                                            </div>
                                            <div class="col-2 text-center" style="border-left:1px solid #959690;">
                                                <button type="button" class="btn btn-sm btn-secondary supercell"
                                                    style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width:50px;height: 40px;">
                                                    <span class="text-center"
                                                        style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                        {{ $team->ball }}
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row align-items-center pr-3 py-1"
                                            style="border-bottom:1px solid #959690;">
                                            <div class="col-2 pl-2">
                                                <button type="button" class="btn-sm btn-secondary supercell p-0"
                                                    style="{{ $color }};width: 35px;height: 35px;">
                                                    @php
                                                        $wer = $key + 1 . '.';
                                                    @endphp
                                                    <span
                                                        style="font-size: 16px;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                        {{ $key + 1 }}</span>
                                                </button>
                                            </div>
                                            <div class="col-5"
                                                style="border-left:1px solid #959690;border-right:1px solid #959690">
                                                <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                                    {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }}
                                                </div>
                                                <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                                    {{ substr($team->f2, 0, 8) }}.{{ substr($team->l2, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="col-3 text-center p-0" style="padding-right: 4px !important;">
                                                <div style="font-size:15px;font-weight:800">{{ $tour }}
                                                </div>
                                            </div>
                                            <div class="col-2 text-center" style="border-left:1px solid #959690;">
                                                <button type="button" class="btn btn-sm btn-secondary supercell"
                                                    style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width:50px;height: 40px;">
                                                    <span class="text-center"
                                                        style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                        {{ $team->ball }}
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            {{-- </div> --}}
            @endif
        @endif
    </div>
    </div>
    @endif
</div>
