<div>
    @if ($turnir)
        <div class="container-fluid text-center mb-2 mt-1 pl-0 pd-0 img-container">
            <img class="responsive-img" style="border: 1px solid #fff;border-radius:20px"
                src="{{ asset('mobile/turnir/turnir.png') }}">
            <div class="userimage1">
                <div class="teamprof rounded-circle mx-auto"
                    style="@if ($team1summa > $team2summa) box-shadow: 0px 1px 17px 5px #d3cf17;
                            @else 
                            box-shadow: 0px 1px 17px 5px #ff0000; @endif
                            ">
                    <div>
                        <img src="{{ $team1images[0]->image_url }}" alt="">
                    </div>
                    <div>
                        <img src="{{ $team1images[1]->image_url }}" alt="">
                    </div>
                </div>
                <div class="text-white mt-4 supercell text-font for-name">
                    {{ $team1names[0]->first_name }}
                    {{ substr($team1names[0]->last_name, 0, 1) }}
                </div>
                <div class="text-white mt-1 supercell text-font for-name">
                    {{ $team1names[1]->first_name }}
                    {{ substr($team1names[1]->last_name, 0, 1) }}
                </div>
                <div class="turnir-result">
                    <div class="mt-1 d-flex align-items-center justify-content-center">
                        <img class="turgold" src="{{ asset('mobile/oltin.png') }}" alt="">
                        <span class="pl-1 text-white supercell text-font for-name">{{ formatterr($team1summa) }}</span>
                    </div>
                    <div class="mt-1 d-flex align-items-center justify-content-center">
                        <img class="turking" src="{{ asset('mobile/load-king.png') }}" alt="">
                        <span class="pl-1 text-white supercell text-font for-name">{{ $team1ksb }}</span>
                    </div>
                </div>
            </div>
            <div class="userimage2">
                <div class="teamprof rounded-circle mx-auto"
                    style="@if ($team1summa < $team2summa) box-shadow: 0px 1px 17px 5px #d3cf17;
                            @else 
                            box-shadow: 0px 1px 17px 5px #ff0000; @endif
                            ">
                    <div>
                        <img src="{{ $team2images[0]->image_url }}" alt="">
                    </div>
                    <div>
                        <img src="{{ $team2images[1]->image_url }}" alt="">
                    </div>
                </div>

                <div class="text-white mt-4 supercell text-font for-name">
                    {{ $team2names[0]->first_name }}
                    {{ substr($team2names[0]->last_name, 0, 1) }}
                </div>
                <div class="text-white mt-1 supercell text-font for-name">
                    {{ $team2names[1]->first_name }}
                    {{ substr($team2names[1]->last_name, 0, 1) }}
                </div>
                <div class="turnir-result">
                    <div class="mt-1 d-flex align-items-center justify-content-center">
                        <img class="turgold" src="{{ asset('mobile/oltin.png') }}" alt="">
                        <span class="pl-1 text-white supercell text-font for-name">{{ formatterr($team2summa) }}</span>
                    </div>
                    <div class="mt-1 d-flex align-items-center justify-content-center">
                        <img class="turking" src="{{ asset('mobile/load-king.png') }}" alt="">
                        <span class="pl-1 text-white supercell text-font for-name">{{ $team2ksb }}</span>
                    </div>
                </div>
            </div>

            <div class="turnir-status supercell">
                @if ($tour < 4)
                    <span>{{ $tour }}</span>
                    <p>TUR</p>
                @else
                    <span style="width:55px;display:block">{{ $tourTitle }}</span> 
                @endif
            </div>

            <style>
                @media (min-width: 200px) {
                    .turnir-status {
                        position: absolute;
                        top: 2%;
                        right: 8%;
                        color: #fff;
                        font-size: 12px;
                    }

                    .userimage1 {
                        position: absolute;
                        top: 31%;
                        left: 10%;
                    }

                    .userimage2 {
                        position: absolute;
                        top: 31%;
                        right: 10%;
                    }

                    .teamprof {
                        display: flex;
                        overflow: hidden;
                        width: 80px;
                        height: 80px;
                        background: red;
                    }

                    .teamprof div {
                        overflow: hidden;
                        width: 50%;
                    }

                    .teamprof div img {
                        transform: translateX(-40%);
                        width: 100px;
                    }

                    .turgold {
                        width: 17px;
                    }

                    .turking {
                        width: 17px;
                    }
                }

                @media (min-width: 340px) {
                    .teamprof {
                        width: 90px;
                        height: 90px;
                        background: yellow;
                    }

                    .userimage1,
                    .userimage2 {
                        top: 30%;
                    }

                    .turgold {
                        width: 20px;
                    }

                    .turking {
                        width: 20px;
                    }
                }

                @media (min-width: 370px) {
                    .teamprof {
                        width: 100px;
                        height: 100px;
                        background: yellow;
                    }

                    .turgold {
                        width: 22px;
                    }

                    .turking {
                        width: 22px;
                    }

                    .turnir-status {
                        font-size: 14px;
                    }
                }

                @media (min-width: 410px) {
                    .turnir-result {
                        margin-top: 15px; 
                    }
                }
            </style>



            <div class="container pl-0 pr-0 reyting-user">
                <div class="row">
                    <div class="col-6 pl-3 pr-0">
                        <button type="button" class="btn pr-0" data-toggle="modal" data-target="#reyting">
                            <img src="{{ asset('mobile/reyting.webp') }}" class="for-media-img live-reyting" width="160px"
                                alt="">
                        </button>
                    </div>
                    <div class="col-6 pl-0 pr-4">
                        <button type="button" class="btn pl-0" data-toggle="modal" data-target="#region">
                            <img src="{{ asset('mobile/viloyatim.webp') }}" class="for-media-img live-region" width="160px"
                                alt="">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
