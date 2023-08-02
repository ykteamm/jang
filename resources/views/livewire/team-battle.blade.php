<div class="swiper-slide overflow-hidden text-center">
    <style>
        .team-btn {
            cursor: pointer;
            position: relative;
            display: block;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .team-btn img {
            width: 200px;
            animation: tbtn 2s linear infinite;
        }

        .change-team-time {
            animation: tbtn 2s linear infinite;
        }

        @keyframes tbtn {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .tmloader {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 20px;
            right: 0;
            left: -10px;
            bottom: 0;
        }

        .tmloader .dot {
            position: absolute;

        }

        .tmloader img {
            animation: rotate 10s linear infinite;
        }


        @-webkit-keyframes rotate {
            0% {
                transform: rotate(0);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes rotate {
            0% {
                transform: rotate(0);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        @media screen and (max-width: 360px) {
            .team-btl {
                width: 320px !important;
            }
            .team-btl-info {
                bottom:50px !important;
            }
            .team-btl-info-text {
                font-size: 8px !important;
            }
            .team-btl-info-images img {
                width: 65px !important;
            }
        }
    </style>


    @if(Auth::user()->rm !== 2)

        @if (!$haveIGotTeam)
            <div class="container mt-5">
                <h4 class="text-white text-center">
                    Siz jamoaga biriktirilmagansiz !
                </h4>
            </div>
        @endif
        @if ($haveIGotTeam && !$isTeamBattleBegin)
            <div class="container mt-5">
                <h4 class="text-white text-center">
                    Jamoangiz jangi boshlanmadi !
                </h4>
            </div>
        @endif
        @if ($haveIGotTeam && $isTeamBattleBegin)
        @if (isset($sliders))
        <div class="col-12">

            <div id="carouselExampleIndicators" class="carousel slide mt-2 mb-2" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($sliders as $key => $item)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class=" @if($key == 0) active @endif "></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($sliders as $key => $item)
                        <div class="carousel-item @if($key == 0) active @endif">
                            <img class="d-block w-100" src="https://matrix.novatio.uz/market/slider/{{$item->image}}"
                            style="border-radius:6px" height="230px" alt="Second slide">
                            {{-- <img class="d-block w-100" src="https://matrix.novatio.uz/market/slider/{{$item->image}}" alt="Second slide"> --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="col-12">
            <div class="card" style="background: #ffffff">
                <div class="col align-self-center">
                    @php
                                $fact = $sum1;
                                $plan = $myTeamBattle->team1->plan*10000;
                            @endphp
                    <div class="row">
                        <div class="col-10">
                            <div style="height:70px" class="d-flex justify-content-between align-items-center">
                                <div>
                                    
                                    <div class="mb-1 supercell text-dark" style="font-size:12px;">
                                        IYUL-AVG-SEN
                                    </div>
                                    <div class="text-left">
                                        <span class="supercell"
                                            style="color:#272730;font-weight:600;font-size:10px">{{numb($fact)}}/{{$myTeamBattle->team1->plan}}M</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="supercell" style="background: linear-gradient(154deg, #f9a710 60%, cyan);border-radius: 8px;padding: 3px;">
                                        {{$myTeamBattle->team1->plan}}M
                                    </span>
                                </div>
                            </div>
                            <div class="progress mb-3" style="height: 20px">
                                <div class="progress-bar bg-primary text-white" role="progressbar"
                                    style="width: {{ ($fact * 100) / $plan }}%" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div> 
                        </div>
                        <div class="col-2">
                            <div style="height:70px" class="d-flex justify-content-between align-items-center mt-3">
                                <button type="button" onclick="livewire.emit('for_karma')" data-toggle="modal" data-target="#karma" style="border-radius: 5px;padding: 20px 10px;">A</button>
                            </div>
                        </div>
                    </div>
                    
                        
                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="button" onclick="livewire.emit('for_teambattle500')" data-toggle="modal" data-target="#teambattle" class="btn btn-block mt-2 live-teambattle500" style="background: linear-gradient(345deg, #78fb60,#ff9b00);">
                <span class="supercell">JANG !</span>
            </button>
        </div>
        @endif

    @else
    @if (!$haveIGotTeam)
    <div class="container mt-5">
        <h4 class="text-white text-center">
            Siz jamoaga biriktirilmagansiz !
        </h4>
    </div>
@endif
@if ($haveIGotTeam && !$isTeamBattleBegin)
    <div class="container mt-5">
        <h4 class="text-white text-center">
            Jamoangiz jangi boshlanmadi !
        </h4>
    </div>
@endif
@if ($haveIGotTeam && $isTeamBattleBegin)
    <div class="container p-0" style="height:400px;position: relative;">
        <div style="position: relative;width:350px;height:400px;" class="btn pl-0 pr-0 team-btl">
            <button style="position: absolute;top:25px;right:5px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
                type="button" class="rounded d-flex align-items-center justify-content-center"
                data-toggle="popover" title="Novatio Jang"
                data-content="Jamoaviy jang bu raqib  viloyat elchilari bilan xaftalik,oylik va  3-oylik jang. Yutgan jamoa sovg’a oladi, mag’lub jamoa esa xazilona  jazo oladi! Xaftalik sovg’a olish uchun xaftasiga minimum 3 000 000 savdo qilishingiz shart !"
                data-placement="left">
                <img width="20" class="instruksiya" src="{{ asset('mobile/instruksiya.png') }}" alt="Instruksiya">
            </button>
            <div style="position:absolute;top:0;left:0;right:0;bottom:0;z-index:2">
                <div class="row team-btl-info" style="position: absolute;right:30px; left:30px;bottom:20px;z-index:4">
                    @foreach ($months as $m)
                        @if ($month == $m['month'])
                            <div class="col-4">
                                <div class="supercell pb-1 text-white">
                                    {{ $m['month'] }}
                                </div>
                                <div class="text-white supercell team-btl-info-text" style="font-size:10px">
                                    @if ($amIinTeamOne)
                                        {{ round($m['sum'] / 1000000) . '/' . $myTeamBattle->team1->plan . ' m' }}
                                    @else
                                        {{ round($m['sum'] / 1000000) . '/' . $myTeamBattle->team2->plan . ' m' }}
                                    @endif
                                </div>
                                <div class="team-btl-info-images">
                                    @if (isset($myTeamBattle->monthround))
                                        <img width="80"
                                            src="{{ asset('mobile/team/' . $m['count'] . '-' . $myTeamBattle->monthround . '.png') }}"
                                            alt="">
                                    @else
                                        <img width="80"
                                            src="{{ asset('mobile/team/' . $m['count'] . '-' . $myTeamBattle->round . '.png') }}"
                                            alt="">
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="col-4 d-flex align-items-center justify-content-center">
                                <div>
                                    <div class="supercell pb-1 text-white">
                                        <span>{{ $m['month'] }}</span>
                                    </div>
                                    <div class="text-white supercell team-btl-info-text" style="font-size:10px">
                                        @if ($amIinTeamOne)
                                            {{ round($m['sum'] / 1000000) . '/' . $myTeamBattle->team1->plan . ' m' }}
                                        @else
                                            {{ round($m['sum'] / 1000000) . '/' . $myTeamBattle->team2->plan . ' m' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <img src="{{ asset('mobile/team/third.png') }}" width="100%" style="width:100%" alt="Image">
            </div>
            <img src="{{ asset('mobile/team/first.png') }}" width="100%"
                style="border-radius:15px;position:absolute;top:0;left:0;right:0;bottom:0;z-index:0;width:100%"
                alt="Image">
            <div class="tmloader"
                style="position:absolute;top:-100px;left:0;right:0;bottom:0;z-index:1;opacity:0.8">
                <img src="{{ asset('mobile/team/luch.png') }}" alt="Image" width="100%">
            </div>
            <div style="position: absolute;top:-85px;left:-20px;right:0;bottom:0;z-index:5"
                class="d-flex align-items-center justify-content-center">
                <button type="button" data-toggle="modal" data-target="#teambattle" onclick="livewire.emit('for_teambattle500');" class="team-btn" style="background-color:transparent;border:none;outline:none">
                    @if ($amIinTeamOne)
                        @if (in_array($myTeamBattle->team1->id,[7,10]))
                            <img src="{{ asset('mobile/team/p-500.png') }}" alt="Soqqa" width="250">
                        @elseif(in_array($myTeamBattle->team1->id,[8,12]))
                            <img src="{{ asset('mobile/team/p-400.png') }}" alt="Soqqa" width="250">
                        @elseif(in_array($myTeamBattle->team1->id,[13,9]))
                            <img src="{{ asset('mobile/team/p-350.png') }}" alt="Soqqa" width="250">
                        @elseif(in_array($myTeamBattle->team1->id,[14,15]))
                            <img src="{{ asset('mobile/team/p-250.png') }}" alt="Soqqa" width="250">
                        @endif
                    @else
                        @if (in_array($myTeamBattle->team2->id,[7,10]))
                        <img src="{{ asset('mobile/team/p-500.png') }}" alt="Soqqa" width="250">
                        @elseif(in_array($myTeamBattle->team2->id,[8,12]))
                            <img src="{{ asset('mobile/team/p-400.png') }}" alt="Soqqa" width="250">
                        @elseif(in_array($myTeamBattle->team2->id,[13,9]))
                            <img src="{{ asset('mobile/team/p-350.png') }}" alt="Soqqa" width="250">
                        @elseif(in_array($myTeamBattle->team2->id,[14,15]))
                            <img src="{{ asset('mobile/team/p-250.png') }}" alt="Soqqa" width="250">
                        @endif
                    @endif
                </button>
            </div>
        </div>
    </div>
    <div class="container mt-1 mb-1 p-0">
        <div class="col-12 pt-4 pb-4 pr-3 supercell text-center"
            style="color: white;background-image: url({{ asset('mobile/counter.png') }});background-size: 100% 100%;">
            <p class="p-0 mb-0" style="font-size: 20px;">{{ $myTeamBattle->monthround }} - round</p>

            <span class="text-center" id="count-timer-day2" style="font-size: 35px;"></span>
            <span style="font-size: 15px;">kun :</span>
            <span class="text-center" id="count-timer-hour2" style="font-size: 35px;"></span>
            <span style="font-size: 15px;">soat :</span>
            <span class="text-center" id="count-timer-minut2" style="font-size: 35px;"></span>
            <span style="font-size: 15px;">min</span>
            <p class="p-0" style="font-size: 20px;">Round tugashiga qoldi</p>
        </div>
    </div>
    <div class="container">
        <div class="w-100 my-2">
            <button wire:click="$emit('change')" class="btn btn-warning w-100 supercell change-team-time"
                style="font-weight: 600;font-size:25px">
                {{ $time }}
            </button>
        </div>
        <div class="row">
            <div class="col-6 p-0" style="background:#a1b6d1;border:1px solid white;border-radius:6px;">
                <div class="container px-0 py-1" style="background: #fab516;border-radius:6px;">
                    <span style="font-size:17px;-webkit-text-stroke: 1px #040c10;color:white;"
                        class="supercell py-2">
                        @if ($amIinTeamOne)
                            {{ $myTeamBattle->team1->name }}
                        @else
                            {{ $myTeamBattle->team2->name }}
                        @endif
                    </span>
                </div>
                <div class="container m-1" style="background: #a456ff;border-radius:6px;width:90%;">
                    <span style="font-size:13px;-webkit-text-stroke: 1px #040c10;color:white;"
                        class="supercell py-1">{{ number_format($sum1, 0, ',', ' ') }}</span>
                </div>

                <div class="container p-0">
                    @foreach ($team1 as $k1 => $t1)
                        @php
                            if ($k1 == 0) {
                                $color = 'e0aa2c';
                            }
                            if ($k1 == 1) {
                                $color = 'bdccdb';
                            }
                            if ($k1 == 2) {
                                $color = 'cc8448';
                            }
                            if (!in_array($k1, [0, 1, 2])) {
                                $color = '8d9eb8';
                            }
                        @endphp
                        <div class="col-12 supercell p-0 mb-1">
                            <div class="card border-0 mb-1">
                                <div class="card-body pt-0 pb-0" class="pr-0"
                                    style="background: #c8d7ec;border-radius:6px;">
                                    <div class="row align-items-center py-1">
                                        <div class="col-2 pl-1 pr-0 py-1">
                                            <div
                                                style="width:70%;background:#{{ $color }};border-radius:3px;">
                                                <span style="font-size:10px;"
                                                    class="align-items-center mt-0 py-1">{{ $k1 + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="col-7 pl-0 text-left">
                                            <span class="py-1"
                                                style="color: #272730;font-size:10px">{{ $t1->f }}
                                                {{ substr($t1->l, 0, 1) }}</span>
                                        </div>
                                        {{-- <div class="col-2 pl-0 pr-1 text-right">
                                            <img src="{{ asset('mobile/oltin.png') }}" width="15px;">
                                        </div> --}}
                                        <div class="col-3 pl-0 pr-0">
                                            <div style="width:100%;background:#8599b7;border-radius:6px;">
                                                <span class="py-1"
                                                    style="font-size:10px;-webkit-text-stroke: 1px #040c10;">{{ numb($t1->allprice) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-6 p-0" style="background:#a1b6d1;border:1px solid white;border-radius:6px;">
                <div class="container px-0 py-1" style="background: #fab516;border-radius:6px;">
                    <span style="font-size:17px;-webkit-text-stroke: 1px #040c10;color:white;"
                        class="supercell py-2">
                        @if (!$amIinTeamOne)
                            {{ $myTeamBattle->team1->name }}
                        @else
                            {{ $myTeamBattle->team2->name }}
                        @endif
                    </span>
                </div>
                <div class="container m-1" style="background: #a456ff;border-radius:6px;width:90%;">
                    <span style="font-size:13px;-webkit-text-stroke: 1px #040c10;color:white;"
                        class="supercell py-1">{{ number_format($sum2, 0, ',', ' ') }}</span>
                </div>
                <div class="container p-0">
                    @foreach ($team2 as $k => $t)
                        @php
                            if ($k == 0) {
                                $color = 'e0aa2c';
                            }
                            if ($k == 1) {
                                $color = 'bdccdb';
                            }
                            if ($k == 2) {
                                $color = 'cc8448';
                            }
                            if (!in_array($k, [0, 1, 2])) {
                                $color = '8d9eb8';
                            }
                        @endphp
                        <div class="col-12 supercell p-0 mb-1">
                            <div class="card border-0 mb-1">
                                <div class="card-body pt-0 pb-0" class="pr-0"
                                    style="background: #c8d7ec;border-radius:6px;">
                                    <div class="row align-items-center py-1">
                                        <div class="col-2 pl-1 pr-0 py-1">
                                            <div
                                                style="width:70%;background:#{{ $color }};border-radius:3px;">
                                                <span style="font-size:10px;"
                                                    class="align-items-center mt-0 py-1">{{ $k + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="col-7 pl-0 pr-0 text-left">
                                            <span class="py-1"
                                                style="color: #272730;font-size:10px">{{ $t->f }}
                                                {{ substr($t->l, 0, 1) }}</span>
                                        </div>
                                        {{-- <div class="col-2 pl-0 pr-1 text-right">
                                            <img src="{{ asset('mobile/oltin.png') }}" width="15px;">
                                        </div> --}}
                                        <div class="col-3 pl-0 pr-0">
                                            <div style="width:100%;background:#8599b7;border-radius:6px;">
                                                <span class="py-1"
                                                    style="font-size:10px;-webkit-text-stroke: 1px #040c10;">{{ numb($t->allprice) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
    @endif
</div>
