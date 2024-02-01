<style>
    @media screen and (max-width: 360px) {
        .for-media-img {
            width: 150px !important;
        }


        .for-media-task-btn {
            left: 38px !important;
        }

        .for-media-news-btn {
            left: 17px !important;
        }

        .for-media-news {
            width: 135px !important;
            margin-right: -30px !important;
            padding-top: 15px !important;
        }

        .for-media-task {
            width: 90px !important;
        }

    }
</style>
<div class="swiper-slide overflow-hidden text-center">
    <div class="row">
        <div class="col align-self-center px-3">
            {{-- @if (Auth::user()->specialty_id == 1)

                @if ($lock->mayBeLocked)
                    <button class="my-2 btn btn-danger w-100 mt-0 d-flex align-items-center justify-content-between"
                        type="button" data-toggle="modal" data-target="#lock">
                        <div class="" style="font-size:20px;font-weight:800">
                            Blokirovkaga qoldi
                        </div>
                        <span class="d-flex align-items-end">
                            <span class="mr-1" style="font-size:20px;font-weight:800">
                                {{ $lock->day }}
                            </span> kun <strong class="px-1" style="font-weight:800;font-size:22px">
                                {{ ' : ' }} </strong>
                            <span class="mr-1" style="font-size:20px;font-weight:800">
                                {{ $lock->hour }}
                            </span> soat
                        </span>
                    </button>
                @else
                    <div class="container pl-0 pr-0">
                        <div class="row">
                            <div class="col-6 pl-0 pr-0">

                                <button type="button" class="btn pr-0" data-toggle="modal" data-target="#exercise">
                                    <img src="{{asset('mobile/top22.webp')}}" class="for-media-img" width="160px" alt="">
                                </button>
                            </div>
                            <div class="col-6 pl-0 pr-0">

                                <button type="button" class="btn pl-0" data-toggle="modal" data-target="#turnir">
                                    <img src="{{asset('mobile/ksold.webp')}}" class="for-media-img" width="160px" alt="">
                                </button>
                            </div>
                            <button type="button" class="btn d-none" id="openkingchecksold" data-toggle="modal" data-target="#openkingcheck">
                                Ko'rish
                            </button>
                        </div>
                        
                    </div>
                @endif
            @endif --}}

            @foreach (getShogirdUser() as $item)
                <div class="container mt-3">
                    @if (count(getAllShiftShogird($item->id)) != 0)
                        @if (getCloseShift(Auth::id()) >= 1)
                            @if (count($shifts) != 1)
                                @if (count(getShogirdStar()) == 0)
                                    <button type="button" class="mb-2 btn btn-lg btn-info"
                                        style="background: #d36f32;
                                    border-radius: 26px;">
                                        Bugungi amaliyot uchun 5 ballik tizimda shogird {{ $item->last_name }}
                                        {{ $item->first_name }}ni baholang.Yulduzchani ustiga bosing. !
                                        <form action="{{ route('teach-test-store-teach') }}" method="POST">
                                            @csrf
                                            <div class="col-12  pl-0 pr-0 mt-5">
                                                <div class=" border-0 mb-1">
                                                    <div class="card-body pt-1 pb-1 text-center">
                                                        <div class="row align-items-center">
                                                            <div class="col-12">

                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i class="material-icons allteachstar"
                                                                        id="teachstar{{ $i }}"
                                                                        onclick="teachStar({{ $i }})"
                                                                        style="color:white;font-size:40px;">star</i>
                                                                @endfor
                                                                <input type="number" class="d-none" id="teachstarinput"
                                                                    name="star" value="0">
                                                                <input type="number" class="d-none" name="user_id"
                                                                    value="{{ $item->id }}">
                                                            </div>

                                                            <div class="col-12 mt-2">
                                                                <button type="submit" class="mb-2 btn btn-lg btn-info"
                                                                    style="background: #69d836ab;
                                                        border-radius: 26px;">
                                                                    Saqlash
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </button>
                                @endif
                            @endif
                        @endif
                    @endif
                </div>
                <div class="container mt-3">
                    @if (count(getShogirdStar()) != 0)
                        @if (getTestReviewById($item->id) == 1)
                            <button type="button" class="mb-2 btn btn-lg btn-info"
                                style="background: #2522c2;
                            border-radius: 26px;">
                                Haftalik amaliyot yakuni uchun shogird {{ $item->last_name }} {{ $item->first_name }}ni
                                baholang !
                                <form action="{{ route('teach-test-store-teach2') }}" method="POST">
                                    @csrf
                                    <div class="col-12  pl-0 pr-0 mt-5">
                                        <div class=" border-0 mb-1">
                                            <div class="card-body pt-1 pb-1 text-center">
                                                <div class="row align-items-center">
                                                    @foreach (getTeachQuestion() as $itemder)
                                                        <div class="col-2">
                                                            <input type="checkbox" name="{{ $itemder->id }}">
                                                        </div>
                                                        <div class="col-10 pl-0">
                                                            <h4 class="text-white">{{ $itemder->name }}</h4>

                                                        </div>
                                                    @endforeach
                                                    <input type="number" class="d-none" name="user_id"
                                                        value="{{ $item->id }}">

                                                    <div class="col-12 mt-5">
                                                        <button type="submit" class="mb-2 btn btn-lg btn-info"
                                                            style="background: #69d836ab;
                                                border-radius: 26px;">
                                                            Saqlash
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </button>
                        @endif
                    @endif
                </div>
            @endforeach



            @if (Auth::user()->specialty_id == 1)

                <div class="container pl-0 pr-0">
                    <div class="row">
                        @if (getShogirdOneMonth(Auth::id()) == 1)
                            <div class="col-12 pb-1 pl-0 pr-0">
                                <button type="button" class="btn" style="background: #8bd137" data-toggle="modal"
                                    data-target="#onemonth">
                                    SINOV
                                </button>
                            </div>
                            <div class="col-12" style="position: relative">
                                {{-- <button style="position: absolute;top:10px;right:35px;z-index:10;border:none;outline:none;background:transparent;color:#fff" type="button" class="rounded d-flex align-items-center justify-content-center" data-toggle="popover" title="Shox yurish nima?"  data-content="Shox yurish -bu savdoni oshirish va oylikdan tashqari  premiya  olish uchun ajoyib imkoniyat !!!
                                    Bir mijozga 200.000 va undan ortiq summada soting va chekni sistemaga kiriting!!!
                                    0.5 Shox yurish: Bir mijozga 4 ta choy yoki 1 ta preparat+2 ta choy" data-placement="left">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg>
                                    </button> --}}
                                    <livewire:turnir-button>
                            </div>

                            {{-- <div class="col-6 pl-0 pr-0" style="position: relative">
                                <div>
                                    <button style="position: absolute;top:-12px;right:25px;z-index:10000" type="button"
                                        class="for-media-task-btn btn pl-0" data-toggle="modal" data-target="#exercise">
                                        <img src="{{ asset('mobile/news/top.png') }}" class="for-media-task"
                                            width="100px" style="margin-right:21px" alt="">
                                    </button>
                                </div>
                                <div style="padding-top:35px">
                                    <livewire:news-button>
                                </div>
                            </div> --}}
                        @else
                            @if (Auth::user()->status == 1)
                                <div class="col-12" style="position: relative">
                                    {{-- <button style="position: absolute;top:10px;right:35px;z-index:10;border:none;outline:none;background:transparent;color:#fff" type="button" class="rounded d-flex align-items-center justify-content-center" data-toggle="popover" title="Shox yurish nima?"  data-content="Shox yurish -bu savdoni oshirish va oylikdan tashqari  premiya  olish uchun ajoyib imkoniyat !!!
                                        Bir mijozga 200.000 va undan ortiq summada soting va chekni sistemaga kiriting!!!
                                        0.5 Shox yurish: Bir mijozga 4 ta choy yoki 1 ta preparat+2 ta choy" data-placement="left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                        </svg>
                                      </button> --}}
                                    <livewire:turnir-button>
                                </div>
                            @else
                                <div class="col-12" style="position: relative">
                                    {{-- <button style="position: absolute;top:10px;right:35px;z-index:10;border:none;outline:none;background:transparent;color:#fff" type="button" class="rounded d-flex align-items-center justify-content-center" data-toggle="popover" title="Shox yurish nima?"  data-content="Shox yurish -bu savdoni oshirish va oylikdan tashqari  premiya  olish uchun ajoyib imkoniyat !!!
                                        Bir mijozga 200.000 va undan ortiq summada soting va chekni sistemaga kiriting!!!
                                        0.5 Shox yurish: Bir mijozga 4 ta choy yoki 1 ta preparat+2 ta choy" data-placement="left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                        </svg>
                                      </button> --}}
                                      <livewire:turnir-button>
                                </div>
                            @endif

                            {{-- @if (Auth::user()->status == 1)
                                
                            @endif --}}
                        @endif
                        {{-- <div class="col-6 pl-0 pr-0" style="position: relative">
                            <div>
                                <button style="position: absolute;top:-18px;right:-13px;z-index:10000"
                                    type="button" class="for-media-task-btn btn pl-0" data-toggle="modal"
                                    data-target="#ustoz-shogird" onclick="livewire.emit('for_ustoz_stajer');">
                                    <img src="{{ asset('mobile/ustoz/btnust.jpg') }}" class="for-media-task"
                                    height="50px"
                                    width=  "140px" style="margin-right:21px" alt="">
                                </button>
                            </div>
                            <div style="padding-top:35px">
                                <livewire:news-button>
                            </div>
                        </div> --}}
                        <button type="button" class="btn d-none" id="openkingchecksold" data-toggle="modal"
                            data-target="#openkingcheck">
                            Ko'rish
                        </button>
                    </div>

                </div>
            @endif

            @if (Auth::user()->status == 1)
                @if (count(getOneMonthUser()) == 0)
                    @if ($haveTurnirBattle == 1)
                        <livewire:turnir-home>
                    @else
                        @if ($battle_yes == 'end' || $battle_yes == 'no')
                            <div class="container-fluid text-center mb-2 mt-3 pl-0 pd-0 img-container">
                                {{-- <img class="responsive-img" src="{{asset('mobile/jang3.webp')}}"> <button style="position: absolute;top:10px;left:5px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
                                    type="button" class="rounded d-flex align-items-center justify-content-center"
                                    data-toggle="popover" title="Elchi jangi"
                                    data-content="3 kunlik Elchi Jangida g'olib bo'ling va kuboklarga ega bo'ling!"
                                    data-placement="right">
                                    <img width="20" class="instruksiya" src="{{ asset('mobile/instruksiya.png') }}" alt="Instruksiya">
                                </button> --}}
                                <div class="">
                                    <div class="for-avatar avatar avatar-140 rounded-circle mx-auto"
                                        style="width: 130px;height:130px;">
                                        <div class="background">

                                            @if (isset(Auth::user()->image_url))
                                                <img src="{{ Auth::user()->image_url }}" height="10px"
                                                    alt="">
                                            @else
                                                <img src="https://api.multiavatar.com/kathrin.svg" height="100px"
                                                    alt="">
                                            @endif

                                        </div>


                                    </div>

                                    <div class="text-white mt-1 supercell text-font for-name">
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    </div>
                                </div>
                            </div>
                            <div class="container pl-0 pr-0 mt-3">
                                <div class="row">
                                    <div class="col-6 pl-3 pr-0">

                                        <button type="button" class="btn pr-0" data-toggle="modal"
                                            data-target="#reyting">
                                            <img src="{{ asset('mobile/reyting.webp') }}" class="for-media-img live-reyting"
                                                width="160px" alt="">
                                        </button>
                                    </div>
                                    <div class="col-6 pl-0 pr-4">

                                        <button type="button" class="btn pl-0" data-toggle="modal"
                                            data-target="#region">
                                            {{-- data-target="#viloyatim"> --}}
                                            <img src="{{ asset('mobile/viloyatim.webp') }}" class="for-media-img live-region"
                                                width="160px" alt="">
                                        </button>
                                    </div>
                                </div>

                            </div>
                        @endif
                        @if ($battle_yes == 'yes')
                            <div class="container-fluid text-center mb-2 mt-1 pl-0 pd-0 img-container">
                                <button
                                    style="position: absolute;top:10px;left:5px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
                                    type="button"
                                    class="rounded d-flex align-items-center justify-content-center"
                                    data-toggle="popover" title="Elchi jangi"
                                    data-content="3 kunlik Elchi Jangida g'olib bo'ling va kuboklarga ega bo'ling!"
                                    data-placement="right">
                                    <img width="20" class="instruksiya"
                                        src="{{ asset('mobile/instruksiya.png') }}" alt="Instruksiya">
                                </button>
                                <img class="responsive-img" src="{{ asset('mobile/jang3.webp') }}">
                                <div class="user-image1">
                                    <div class="for-avatar avatar avatar-140 rounded-circle mx-auto"
                                        style="width: 130px;height:130px;
                                @if ($summa_bugun1 > $summa_bugun2) box-shadow: 0px 1px 17px 5px #d3cf17; @endif
                                @if ($summa_bugun1 < $summa_bugun2) box-shadow: 0px 1px 17px 5px #ff0000; @endif
                                ">
                                        <div class="background">

                                            @if (Auth::user()->id == $my_battle[0]->u1ids->id)
                                                @if (isset($my_battle[0]->u1ids->image_url))
                                                    <img src="{{ $my_battle[0]->u1ids->image_url }}"
                                                        height="10px" alt="">
                                                @else
                                                    <img src="https://api.multiavatar.com/kathrin.svg"
                                                        height="10px" alt="">
                                                @endif
                                            @else
                                                @if (isset($my_battle[0]->u2ids->image_url))
                                                    <img src="{{ $my_battle[0]->u2ids->image_url }}"
                                                        height="10px" alt="">
                                                @else
                                                    <img src="https://api.multiavatar.com/kathrin.svg"
                                                        height="10px" alt="">
                                                @endif
                                            @endif

                                        </div>


                                    </div>

                                    <div class="text-dark mt-1 supercell text-font for-name">
                                        @if (Auth::user()->id == $my_battle[0]->u1ids->id)
                                            {{ $my_battle[0]->u1ids->first_name }}
                                            {{ substr($my_battle[0]->u1ids->last_name, 0, 1) }}
                                        @else
                                            {{ $my_battle[0]->u2ids->first_name }}
                                            {{ substr($my_battle[0]->u2ids->last_name, 0, 1) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="user-image2">
                                    <div class="for-avatar avatar avatar-140 rounded-circle mx-auto"
                                        style="width: 130px;height:130px;
                                @if ($summa_bugun1 < $summa_bugun2) box-shadow: 0px 1px 17px 5px #d3cf17; @endif
                                @if ($summa_bugun1 > $summa_bugun2) box-shadow: 0px 1px 17px 5px #ff0000; @endif
                                ">
                                        <div class="background">
                                            @if (Auth::user()->id != $my_battle[0]->u1ids->id)
                                                @if (isset($my_battle[0]->u1ids->image_url))
                                                    <img src="{{ $my_battle[0]->u1ids->image_url }}"
                                                        height="10px" alt="">
                                                @else
                                                    <img src="https://api.multiavatar.com/kathrin.svg"
                                                        height="10px" alt="">
                                                @endif
                                            @else
                                                @if (isset($my_battle[0]->u2ids->image_url))
                                                    <img src="{{ $my_battle[0]->u2ids->image_url }}"
                                                        height="10px" alt="">
                                                @else
                                                    <img src="https://api.multiavatar.com/kathrin.svg"
                                                        height="10px" alt="">
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-dark mt-1 supercell text-font for-name">
                                        @if (Auth::user()->id != $my_battle[0]->u1ids->id)
                                            {{ $my_battle[0]->u1ids->first_name }}
                                            {{ substr($my_battle[0]->u1ids->last_name, 0, 1) }}
                                        @else
                                            {{ $my_battle[0]->u2ids->first_name }}
                                            {{ substr($my_battle[0]->u2ids->last_name, 0, 1) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="battle_date supercell">
                                    <span>{{ $my_battle[0]->day + 1 }} / {{ $my_battle[0]->days }}</span>
                                    <p>KUN</p>
                                </div>
                                <div class="bugun1 img-container first_one" onclick="changeDay(0)">
                                    <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
                                </div>
                                <div class="bugun1 img-container first_two d-none" onclick="changeDay(1)">
                                    <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
                                </div>
                                <div class="bugun_date1 supercell first_one" onclick="changeDay(0)">
                                    <span>Bugun</span>
                                </div>
                                <div class="bugun_date1 supercell first_two d-none" onclick="changeDay(1)">
                                    <span>{{ date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($battle_start_day))))->format('%a') }}
                                        kun</span>
                                </div>
                                <div class="bugun_price1 supercell first_one" style="font-size: 13px;"
                                    onclick="changeDay(0)">
                                    @if (count($summa1) > 0)
                                        {{ number_format($summa1[0]->allprice, 0, ',', ' ') }}
                                    @else
                                        0
                                    @endif
                                </div>
                                <div class="bugun_price1 supercell first_two d-none" onclick="changeDay(1)"
                                    style="font-size: 13px;">
                                    @if (count($summa_bugun1) > 0)
                                        {{ number_format($summa_bugun1[0]->allprice, 0, ',', ' ') }}
                                    @else
                                        0
                                    @endif
                                </div>

                                <div class="bugun2 img-container first_one" onclick="changeDay(0)">
                                    <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
                                </div>
                                <div class="bugun2 img-container first_two" onclick="changeDay(1)">
                                    <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
                                </div>
                                <div class="bugun_date2 supercell first_one" onclick="changeDay(0)">
                                    <span>Bugun</span>
                                </div>
                                <div class="bugun_date2 supercell first_two d-none" onclick="changeDay(1)">
                                    <span>{{ date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($battle_start_day))))->format('%a') }}
                                        kun</span>
                                </div>
                                <div class="bugun_price2 supercell first_one" style="font-size: 13px;"
                                    onclick="changeDay(0)">
                                    @if (count($summa2) > 0)
                                        {{ number_format($summa2[0]->allprice, 0, ',', ' ') }}
                                    @else
                                        0
                                    @endif
                                </div>
                                <div class="bugun_price2 supercell first_two d-none" style="font-size: 13px;"
                                    onclick="changeDay(1)">
                                    @if (count($summa_bugun2) > 0)
                                        {{ number_format($summa_bugun2[0]->allprice, 0, ',', ' ') }}
                                    @else
                                        0
                                    @endif
                                </div>

                                <div class="container mt-5 natija-img">
                                    <div class="col-auto text-center img-container">

                                        {{-- @if (count($battle_history) > 0)
                                            @if ($battle_history[count($battle_history) - 1]['win'] == Auth::user()->id)
                                                <a class="play-btn" style="position: absolute;top:40px;right:10px"
                                                    aria-labelledby="#imageDownload" data-toggle="modal"
                                                    data-target="#imageDownload">
                                                    <img src="{{ asset('mobile/kb.png') }}" alt="Image"
                                                        width="30">
                                                </a>
                                            @endif
                                        @endif --}}


                                        <button type="button" class="btn" data-toggle="modal"
                                            data-target="#exampleModalCenter">
                                            <img src="{{ asset('mobile/natija.webp') }}" width="190px"
                                                alt="">
                                        </button>
                                        @if (count($battle_history) >=  5)
                                            @php
                                                $i = 1;
                                            @endphp
                                            @for ($b = 4; $b >= 0; $b--)
                                                @isset($battle_history[$b])
                                                    @if ($battle_history[$b]->u1id == Auth::user()->id)
                                                        <div class="stars{{ $i }}"
                                                            style="background-color:#c19736b3;border-radius:5px;padding: 2px 2px;">
                                                            @if ($battle_history[$b]->win == Auth::user()->id)
                                                                <img src="{{ asset('mobile/stars1.webp') }}"
                                                                    width="30px" alt="">
                                                            @else
                                                                <img src="{{ asset('mobile/stars2.webp') }}"
                                                                    width="30px" alt="">
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="stars{{ $i }}"
                                                            style="background-color:#c19736b3;border-radius:5px;padding: 2px 2px;">
                                                            @if ($battle_history[$b]->lose == Auth::user()->id)
                                                                <img src="{{ asset('mobile/stars2.webp') }}"
                                                                    width="30px" alt="">
                                                            @else
                                                                <img src="{{ asset('mobile/stars1.webp') }}"
                                                                    width="30px" alt="">
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endisset
                                                @php
                                                    $i++;
                                                @endphp
                                            @endfor
                                        @else
                                            @for ($j = 1; $j <= 5 - count($battle_history); $j++)
                                                <div class="stars{{ count($battle_history) + $j }}"
                                                    style="background-color:#c18f36;border-radius:5px;padding: 2px 2px;">
                                                    <div
                                                        style="background-color:#c19736b3;border-radius:5px;width:30px;height:30px;">
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="container pl-0 pr-0 reyting-user">
                                <div class="row">
                                    <div class="col-6 pl-3 pr-0">

                                        <button type="button" class="btn pr-0" data-toggle="modal"
                                            data-target="#reyting">
                                            <img src="{{ asset('mobile/reyting.webp') }}" class="for-media-img live-reyting"
                                                width="160px" alt="">
                                        </button>
                                    </div>
                                    <div class="col-6 pl-0 pr-4">

                                        <button type="button" class="btn pl-0" data-toggle="modal"
                                            data-target="#region">
                                            <img src="{{ asset('mobile/viloyatim.webp') }}" class="for-media-img live-region"
                                                width="160px" alt="">
                                        </button>
                                    </div>
                                </div>

                            </div>

                        @endif
                    @endif
                @else
                    @if ($haveTurnirBattle == 1)
                        <livewire:turnir-home>
                        @else
                            @if ($battle_yes == 'end' || $battle_yes == 'no')
                                <div class="container-fluid text-center mb-2 mt-1 pl-0 pd-0 img-container">
                                    Sizga mos raqib tanlayapmiz
                                    <p>Jangga tayyor turing</p>
                                </div>
                            @endif
                            @if ($battle_yes == 'yes')
                                <div class="container-fluid text-center mb-2 mt-1 pl-0 pd-0 img-container">
                                    <img class="responsive-img" src="{{ asset('mobile/jang3.webp') }}">
                                    <div class="user-image1">
                                        <div class="for-avatar avatar avatar-140 rounded-circle mx-auto"
                                            style="width: 130px;height:130px;
                                @if ($summa_bugun1 > $summa_bugun2) box-shadow: 0px 1px 17px 5px #d3cf17; @endif
                                @if ($summa_bugun1 < $summa_bugun2) box-shadow: 0px 1px 17px 5px #ff0000; @endif
                                ">
                                            <div class="background">

                                                @if (Auth::user()->id == $my_battle[0]->u1ids->id)
                                                    @if (isset($my_battle[0]->u1ids->image_url))
                                                        <img src="{{ $my_battle[0]->u1ids->image_url }}"
                                                            height="10px" alt="">
                                                    @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg"
                                                            height="10px" alt="">
                                                    @endif
                                                @else
                                                    @if (isset($my_battle[0]->u2ids->image_url))
                                                        <img src="{{ $my_battle[0]->u2ids->image_url }}"
                                                            height="10px" alt="">
                                                    @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg"
                                                            height="10px" alt="">
                                                    @endif
                                                @endif

                                            </div>


                                        </div>

                                        <div class="text-dark mt-1 supercell text-font for-name">
                                            @if (Auth::user()->id == $my_battle[0]->u1ids->id)
                                                {{ $my_battle[0]->u1ids->first_name }}
                                                {{ substr($my_battle[0]->u1ids->last_name, 0, 1) }}
                                            @else
                                                {{ $my_battle[0]->u2ids->first_name }}
                                                {{ substr($my_battle[0]->u2ids->last_name, 0, 1) }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="user-image2">
                                        <div class="for-avatar avatar avatar-140 rounded-circle mx-auto"
                                            style="width: 130px;height:130px;
                            @if ($summa_bugun1 < $summa_bugun2) box-shadow: 0px 1px 17px 5px #d3cf17; @endif
                            @if ($summa_bugun1 > $summa_bugun2) box-shadow: 0px 1px 17px 5px #ff0000; @endif
                            ">
                                            <div class="background">
                                                @if (Auth::user()->id != $my_battle[0]->u1ids->id)
                                                    @if (isset($my_battle[0]->u1ids->image_url))
                                                        <img src="{{ $my_battle[0]->u1ids->image_url }}"
                                                            height="10px" alt="">
                                                    @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg"
                                                            height="10px" alt="">
                                                    @endif
                                                @else
                                                    @if (isset($my_battle[0]->u2ids->image_url))
                                                        <img src="{{ $my_battle[0]->u2ids->image_url }}"
                                                            height="10px" alt="">
                                                    @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg"
                                                            height="10px" alt="">
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-dark mt-1 supercell text-font for-name">
                                            @if (Auth::user()->id != $my_battle[0]->u1ids->id)
                                                {{ $my_battle[0]->u1ids->first_name }}
                                                {{ substr($my_battle[0]->u1ids->last_name, 0, 1) }}
                                            @else
                                                {{ $my_battle[0]->u2ids->first_name }}
                                                {{ substr($my_battle[0]->u2ids->last_name, 0, 1) }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="battle_date supercell">
                                        <span>{{ $my_battle[0]->day + 1 }} / {{ $my_battle[0]->days }}</span>
                                        <p>KUN</p>
                                    </div>
                                    <div class="bugun1 img-container first_one" onclick="changeDay(0)">
                                        <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
                                    </div>
                                    <div class="bugun1 img-container first_two d-none" onclick="changeDay(1)">
                                        <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
                                    </div>
                                    <div class="bugun_date1 supercell first_one" onclick="changeDay(0)">
                                        <span>Bugun</span>
                                    </div>
                                    <div class="bugun_date1 supercell first_two d-none" onclick="changeDay(1)">
                                        <span>{{ date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($battle_start_day))))->format('%a') }}
                                            kun</span>
                                    </div>
                                    <div class="bugun_price1 supercell first_one" style="font-size: 13px;"
                                        onclick="changeDay(0)">
                                        @if (count($summa1) > 0)
                                            {{ number_format($summa1[0]->allprice, 0, ',', ' ') }}
                                        @else
                                            0
                                        @endif
                                    </div>
                                    <div class="bugun_price1 supercell first_two d-none" onclick="changeDay(1)"
                                        style="font-size: 13px;">
                                        @if (count($summa_bugun1) > 0)
                                            {{ number_format($summa_bugun1[0]->allprice, 0, ',', ' ') }}
                                        @else
                                            0
                                        @endif
                                    </div>

                                    <div class="bugun2 img-container first_one" onclick="changeDay(0)">
                                        <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
                                    </div>
                                    <div class="bugun2 img-container first_two" onclick="changeDay(1)">
                                        <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
                                    </div>
                                    <div class="bugun_date2 supercell first_one" onclick="changeDay(0)">
                                        <span>Bugun</span>
                                    </div>
                                    <div class="bugun_date2 supercell first_two d-none" onclick="changeDay(1)">
                                        <span>{{ date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($battle_start_day))))->format('%a') }}
                                            kun</span>
                                    </div>
                                    <div class="bugun_price2 supercell first_one" style="font-size: 13px;"
                                        onclick="changeDay(0)">
                                        @if (count($summa2) > 0)
                                            {{ number_format($summa2[0]->allprice, 0, ',', ' ') }}
                                        @else
                                            0
                                        @endif
                                    </div>
                                    <div class="bugun_price2 supercell first_two d-none" style="font-size: 13px;"
                                        onclick="changeDay(1)">
                                        @if (count($summa_bugun2) > 0)
                                            {{ number_format($summa_bugun2[0]->allprice, 0, ',', ' ') }}
                                        @else
                                            0
                                        @endif
                                    </div>

                                    <div class="container mt-5 natija-img">
                                        <div class="col-auto text-center img-container">

                                            {{-- @if (count($battle_history) > 0)
                                                @if ($battle_history[count($battle_history) - 1]['win'] == Auth::user()->id)
                                                    <a class="play-btn" style="position: absolute;top:40px;right:10px"
                                                        aria-labelledby="#imageDownload" data-toggle="modal"
                                                        data-target="#imageDownload">
                                                        <img src="{{ asset('mobile/kb.png') }}" alt="Image"
                                                            width="30">
                                                    </a>
                                                @endif
                                            @endif --}}


                                            <button type="button" class="btn" data-toggle="modal"
                                                data-target="#exampleModalCenter">
                                                <img src="{{ asset('mobile/natija.webp') }}" width="190px"
                                                    alt="">
                                            </button>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($battle_history as $key => $item)
                                                @if ($i <= 5)
                                                    @if ($item->u1id == Auth::user()->id)
                                                        <div class="stars{{ $i }}"
                                                            style="background-color:#c19736b3;border-radius:5px;padding: 2px 2px;">
                                                            @if ($item->win == Auth::user()->id)
                                                                <img src="{{ asset('mobile/stars1.webp') }}"
                                                                    width="30px" alt="">
                                                            @else
                                                                <img src="{{ asset('mobile/stars2.webp') }}"
                                                                    width="30px" alt="">
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="stars{{ $i }}"
                                                            style="background-color:#c19736b3;border-radius:5px;padding: 2px 2px;">
                                                            @if ($item->lose == Auth::user()->id)
                                                                <img src="{{ asset('mobile/stars2.webp') }}"
                                                                    width="30px" alt="">
                                                            @else
                                                                <img src="{{ asset('mobile/stars1.webp') }}"
                                                                    width="30px" alt="">
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endif
                                                @php
                                                    $i += 1;
                                                @endphp
                                            @endforeach
                                            @if (count($battle_history) < 5)
                                                @for ($j = 1; $j <= 5 - count($battle_history); $j++)
                                                    <div class="stars{{ count($battle_history) + $j }}"
                                                        style="background-color:#c18f36;border-radius:5px;padding: 2px 2px;">
                                                        <div
                                                            style="background-color:#c19736b3;border-radius:5px;width:30px;height:30px;">
                                                        </div>
                                                    </div>
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            @endif
                    @endif
                @endif
            @endif
            {{-- @if (Auth::user()->status == 0)
                ddd {{getTeacher()->first_name}} {{getTeacher()->last_name}}
            @endif --}}
            {{-- test --}}
            @if (Auth::user()->status == 0)
                @php
                    $shogird_day = getShogirdDay(Auth::id());
                @endphp
                @if (gettype(getTeacher()) != 'array')

                    <div class="container p-1" style="background:#3ad1717d;border-radius:13px;" data-toggle="modal"
                        data-target="#new-elchi">
                        <h4 class="text-center">O'quv haftasi</h4>
                        @if (count($shifts) == 1)

                            @if (count($shogird_day) != 0)
                                <h5 class="text-center">{{ count($shogird_day) }} - kun</h5>
                            @endif
                        @endif
                        <div class="card-body" style="padding: 5px 25px;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div style="font-weight:500">Plan:</div>
                                <div style="font-weight:500">
                                    {{ number_format(getShogirdPlan(), 0, ',', ' ') }} so'm
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div style="font-weight:500">Bajarildi:</div>
                                <div style="font-weight:500">
                                    {{ number_format(getShogirdFact(Auth::id()), 0, ',', ' ') }} so'm
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('mobile/target.webp') }}" width="30px" alt="">
                                </div>
                                <div class="col-9 mt-2 pl-0 pr-0">
                                    <div class="row">

                                        @for ($i = 1; $i <= 7; $i++)
                                            {{-- @if ($i == 5)
                                        
                                        <div style="width:12%;height:15px;border: 1px solid #4e34da;border-radius:13px;@if ($i <= count($shogird_day))
                                        background:orange;
                                    @endif">
                                            <span style="display: block;font-size:10px;">{{count($shogird_day)}}/7</span>
                                        </div>
                                    @endif --}}
                                            @php
                                                if ($i <= count($shogird_day) - 1) {
                                                    $sum = getShogirdDay(Auth::id());
                                                    $all_sum = $sum[$i]['make'] + $sum[$i]['make_other'];
                                                    if ($all_sum >= 250000) {
                                                        $color = 'green';
                                                    } else {
                                                        $color = 'orange';
                                                    }
                                                } else {
                                                    // $color = 'orange';
                                                }
                                                
                                            @endphp
                                            <div
                                                style="width:11%;height:15px;border: 1px solid #4e34da;border-radius:13px;@if ($i <= count($shogird_day) - 1) background:{{ $color }}; @endif ">

                                            </div>
                                        @endfor
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="container p-1 mt-3" style="background:#b1d4eb7d;border-radius:13px;">
                        <div class="row">
                            <div class="col-6 pl-0 pr-0">
                                <div style="border-radius:10px">
                                    <img src="{{ getTeacher()->image_url }}" width="80px"
                                        style="border-radius:13px;">
                                </div>
                            </div>
                            <div class="pl-0 pr-0pl-0 pr-0">
                                <p class="text-dark m-0">Ustozingiz</p>
                                <p class="m-0">{{ getTeacher()->first_name }} {{ getTeacher()->last_name }}</p>
                                <p>{{ getTeacher()->phone_number }}</p>
                            </div>
                        </div>

                    </div>
                @endif

                @if (gettype(getTeacher()) != 'array')

                    <div class="container mt-3">
                        @if (count(getAllShiftShogird(Auth::id())) != 0)
                            @if (count($shifts) != 1)
                                @if (count(getShogirdStar()) == 0)
                                    <button type="button" class="mb-2 btn btn-lg btn-info" data-toggle="modal"
                                        data-target="#teachgradestar"
                                        style="background: #d36f32;
                                border-radius: 26px;">
                                        Bugungi amaliyot uchun ustozingizni baholang !
                                    </button>
                                @endif
                            @endif
                        @endif
                    </div>
                @endif
                <div class="container mt-3">
                    @if (count(getShogirdStar()) != 0)
                        @if (getTestReview() == 1)
                            <button type="button" class="mb-2 btn btn-lg btn-info" data-toggle="modal"
                                data-target="#teachtest"
                                style="background: #2522c2;
                            border-radius: 26px;">
                                Haftalik amaliyot yakuni uchun ustozingizni baholang !
                            </button>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
{{-- <div>

</div> --}}