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
</div>
