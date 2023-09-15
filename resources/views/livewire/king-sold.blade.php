<div class="modal-content">
    {{-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
            <img src="{{asset('mobile/xclose.png')}}" width="30px">
        </button>
    </div> --}}
    <div class="modal-header p-0 pb-4" style="background: #a4adb8; position:relative">
        <button
            style="position: absolute;top:77px;right:0px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
            type="button" class="rounded d-flex align-items-center justify-content-center" data-toggle="popover"
            title="Shox yurish nima?"
            data-content="Shox yurish -bu savdoni oshirish va oylikdan tashqari  premiya  olish uchun ajoyib imkoniyat !!!
            Bir mijozga 200.000 va undan ortiq summada soting va chekni sistemaga kiriting!!!
            0.5 Shox yurish: Bir mijozga 4 ta choy yoki 1 ta preparat+2 ta choy"
            data-placement="left">
            <img width="20" class="instruksiya" src="{{ asset('mobile/instruksiya.png') }}" alt="Instruksiya">
        </button>
        <div class="container p-0"
            style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
            <span class="supercell text-white pl-3" style="font-size:25px;">SHOH YURISH {{ $ksnumber }}</span>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="opacity: 5;position:absolute;top:8px;right:10px;">
            <img src="{{ asset('mobile/xclose.png') }}" width="30px">
        </button>
    </div>
    <div class="modal-body p-0">
        {{-- <div class="container">
            <img src="{{asset('mobile/ks.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                <img src="{{asset('mobile/xclose.png')}}" width="30px">
            </button>
        </div> --}}
        <div class="container p-0" style="background: #a4adb8">

            <ul class="nav nav-tabs mr-2 ml-2" id="myTab" role="tablist">
                <li class="nav-item @if ($exist_duel == 0) king-sold-tab-active @else king-sold-tab @endif king-sold-tab1"
                    onclick="changeKingSoldTab(1)" style="width: 33.3333% !important;">
                    <a class="supercel-text-stroke text-center" id="home-tab" data-toggle="tab" href="#home"
                        role="tab" aria-controls="home" aria-selected="true">Barchasi</a>
                </li>
                <li class="nav-item king-sold-tab king-sold-tab2" onclick="changeKingSoldTab(2)"
                    style="width: 33.3333% !important;">
                    <a class="supercel-text-stroke text-center" id="profile-tab" data-toggle="tab" href="#profile"
                        role="tab" aria-controls="profile" aria-selected="false">Viloyat</a>
                </li>
                {{-- <li class="nav-item king-sold-tab king-sold-tab3" onclick="changeKingSoldTab(3)"
                    style="width: 33.3333% !important;">
                    <a class="supercel-text-stroke text-center" id="profile-tab" data-toggle="tab" href="#profile"
                        role="tab" aria-controls="profile" aria-selected="false">Turnir</a>
                </li> --}}
                {{-- <li class="nav-item @if ($exist_duel == 1) king-sold-tab-active @else king-sold-tab @endif king-sold-tab3"
                    onclick="changeKingSoldTab(3)" style="width: 33.3333% !important;">
                    <a class="supercel-text-stroke text-center" id="duel-tab" data-toggle="tab" href="#duel"
                        role="tab" aria-controls="duel" aria-selected="false">Duel</a>
                </li> --}}
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if ($exist_duel == 0) show active @endif pb-3" id="home"
                    role="tabpanel" aria-labelledby="home-tab" style="background: #e1edf2">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active p-3">
                                <img class="d-block w-100" src="{{ asset('mobile/king/Glavniy.png') }}"
                                    alt="First slide">
                            </div>
                            <div class="carousel-item p-3">
                                <img class="d-block w-100" src="{{ asset('mobile/king/Oltin.png') }}"
                                    alt="Second slide">
                            </div>
                            <div class="carousel-item p-3">
                                <img class="d-block w-100" src="{{ asset('mobile/king/Kumush.png') }}"
                                    alt="Third slide">
                            </div>
                            <div class="carousel-item p-3">
                                <img class="d-block w-100" src="{{ asset('mobile/king/Bronza.png') }}"
                                    alt="Fouth slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev" style="margin-left: -21px !important;">
                            <span aria-hidden="true">
                                <i class="material-icons" style="color:#000000;font-size:33px;">navigate_before</i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next" style="margin-right: -21px !important;">
                            <span aria-hidden="true">
                                <i class="material-icons" style="color:#000000;font-size:33px;">navigate_next</i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="container mt-1 mb-1">
                        <div class="col-12 pt-4 pb-4 pr-3 supercell text-center"
                            style="color: white;background-image: url({{ asset('mobile/counter.png') }});background-size: 100% 100%;">
                            <span class="text-center" id="count-timer-day" style="font-size: 35px;"></span>
                            <span style="font-size: 15px;">kun :</span>
                            <span class="text-center" id="count-timer-hour" style="font-size: 35px;"></span>
                            <span style="font-size: 15px;">soat :</span>
                            <span class="text-center" id="count-timer-minut" style="font-size: 35px;"></span>
                            <span style="font-size: 15px;">min</span>
                            <p class="p-0" style="font-size: 20px;">Shoh yurish tugashiga qoldi</p>
                        </div>
                    </div>
                    <div class="row m-0 p-0">

                        <div class="col-6 text-center supercell pr-1">
                            @foreach ($region_king_sold as $item)
                            @endforeach
                            @php
                                if (isset($region_king_sold[0])) {
                                    $side1 = $region_king_sold[0]['side'];
                                    $count1 = $region_king_sold[0]['count'];
                                } else {
                                    $side1 = 0;
                                    $count1 = 0;
                                }
                                if (isset($region_king_sold[1])) {
                                    $side2 = $region_king_sold[1]['side'];
                                    $count2 = $region_king_sold[1]['count'];
                                } else {
                                    $side2 = 0;
                                    $count2 = 0;
                                }
                            @endphp
                            @if ($side1 != 0)
                                <button type="button"
                                    class="mb-2 btn deletecolor btn-block
                            @if ($count1 > $count2) btn-primary
                            @elseif($count1 < $count2)
                            btn-danger
                            @else
                            btn-info @endif
                            ">
                                    <span class="text-left">
                                        @if ($side1 == 1)
                                            G'arb
                                        @else
                                            Sharq
                                        @endif
                                    </span>
                                    <p class="text-left">{{ $count1 }} <img
                                            src="{{ asset('mobile/king-sold.webp') }}" width="23px;"></p>
                                </button>
                            @endif
                        </div>
                        <div class="col-6 text-center supercell pl-1">
                            @foreach ($region_king_sold as $item)
                            @endforeach
                            @php
                                if (isset($region_king_sold[0])) {
                                    $side1 = $region_king_sold[0]['side'];
                                    $count1 = $region_king_sold[0]['count'];
                                } else {
                                    $side1 = 0;
                                    $count1 = 0;
                                }
                                if (isset($region_king_sold[1])) {
                                    $side2 = $region_king_sold[1]['side'];
                                    $count2 = $region_king_sold[1]['count'];
                                } else {
                                    $side2 = 0;
                                    $count2 = 0;
                                }
                            @endphp
                            @if ($side2 != 0)
                                <button type="button"
                                    class="mb-2 btn deletecolor btn-block
                            @if ($count1 < $count2) btn-primary
                            @elseif($count1 > $count2)
                            btn-danger
                            @else
                            btn-info @endif
                            ">
                                    <span class="text-right">
                                        @if ($side2 == 1)
                                            G'arb
                                        @else
                                            Sharq
                                        @endif
                                    </span>
                                    <p class="text-right"> <img src="{{ asset('mobile/king-sold.webp') }}"
                                            width="23px;">{{ $count2 }}</p>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="row m-0 p-0">
                        <div class="col-12 text-center supercell p-0">
                            <button type="button" class="mb-2 btn btn-sm deletecolor btn-info"
                                wire:click="$emit('kingSd','Shu hafta')">
                                <span class="supercel-text-stroke">Shu hafta</span>
                            </button>
                            <button type="button" class="mb-2 btn btn-sm deletecolor btn-info"
                                wire:click="$emit('kingSd','Oldingi hafta')">
                                <span class="supercel-text-stroke">Oldingi hafta</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        <div class="row m-0 p-0">
                            <div class="col-12 text-center supercell p-0">
                                <button type="button" class="btn btn-sm deletecolor btn-info">
                                    <span class="supercel-text-stroke">Siz
                                        <span class="ml-4">
                                            {{ getKSCount(Auth::id(), $date_begin, $date_end) }}
                                            <img src="{{ asset('mobile/king-sold.webp') }}" width="23px;">
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        @isset($king_sold)
                            @foreach ($king_sold as $ligaImage => $ligaItems)
                                <div class="m-0 mt-3">
                                    <img src="{{ asset("mobile/king/$ligaImage.png") }}" width="105%"
                                        style="border-radius:15px;margin-left: -9px;margin-top:-2px;position:relative">
                                </div>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($ligaItems as $key => $item)
                                    @php
                                        if ($i == 0) {
                                            $color = 'e0aa2c';
                                        }
                                        if ($i == 1) {
                                            $color = 'bdccdb';
                                        }
                                        if ($i == 2) {
                                            $color = 'cc8448';
                                        }
                                        if (!in_array($i, [0, 1, 2])) {
                                            $color = '8d9eb8';
                                        }
                                    @endphp
                                    <div class="col-12 supercell">
                                        <div class="card border-0 mb-1">
                                            <div class="card-body" class="pr-0"
                                                style="background: #c8d7ec;border-radius:15px;">
                                                <div class="row align-items-center m-0 p-0">
                                                    <div class="col-2 pl-0">
                                                        <button type="button" class="btn btn-sm btn-secondary supercell"
                                                            style="background: #{{ $color }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            {{ $i + 1 }}
                                                        </button>
                                                    </div>
                                                    <div class="col-4 pl-0">
                                                        <span class="mb-1"
                                                            style="color: #272730;font-size:11px">{{ $item->f }}
                                                            {{ substr($item->l, 0, 1) }}</span>
                                                        <p style="color: #272730;font-size:10px;color:#6c757d;">
                                                            {{ setRegionTosh($item->r) }}
                                                        </p>
                                                    </div>
                                                    <div class="col-1 pl-0 pr-1 text-right">

                                                        @if ($item->id != Auth::id() && !in_array($item->id, getKSBId()) && !in_array(Auth::id(), getKSBId()))
                                                            <button style="background: transparent;border:none"
                                                                data-toggle="modal"
                                                                data-target="#ksb{{ $item->id }}">
                                                                <img src="{{ asset('mobile/king/bat.png') }}"
                                                                    width="30px;">
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="col-5 pl-2 pr-0">
                                                        <div class="d-flex align-items-center justify-content-between supercell text-white btn px-1 ml-3"
                                                            style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            <div>
                                                                <img src="{{ asset('mobile/king-sold.webp') }}"
                                                                    width="23px;">
                                                            </div>
                                                            <div>
                                                                {{ $item->count }}@if (isset($get_ksb_bonus[$item->id]))
                                                                    +{{ $get_ksb_bonus[$item->id] }}
                                                                @endif
                                                            </div>
                                                            @if ($date_begin >= '2023-03-04')
                                                                @php
                                                                    $b = strtotime($date_begin);
                                                                    $e = strtotime($date_end);
                                                                @endphp
                                                                <div data-toggle="modal" data-target="#kscheck""
                                                                    onclick="ksCheck(`{{ $item->id }}`,`{{ $b }}`,`{{ $e }}`)">
                                                                    <span aria-hidden="true">
                                                                        <i class="material-icons"
                                                                            style="color:#107a0e;font-size:20px;">visibility</i>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i = $i + 1;
                                    @endphp
                                @endforeach
                            @endforeach
                        @endisset
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"
                    style="background: #e1edf2">
                    <div class="pt-3">
                        @isset($region_all_king_sold)
                            @foreach ($region_all_king_sold as $key => $item)
                                @php
                                    if ($key == 0) {
                                        $color = 'e0aa2c';
                                    }
                                    if ($key == 1) {
                                        $color = 'bdccdb';
                                    }
                                    if ($key == 2) {
                                        $color = 'cc8448';
                                    }
                                    if (!in_array($key, [0, 1, 2])) {
                                        $color = '8d9eb8';
                                    }
                                @endphp
                                <div class="col-12 supercell">
                                    <div class="card border-0 mb-1">
                                        <div class="card-body" class="pr-0"
                                            style="background: #c8d7ec;border-radius:15px;">
                                            <div class="row align-items-center m-0 p-0">
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell"
                                                        style="background: #{{ $color }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        {{ $key + 1 }}
                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    @if (regionKingSoldStrikeDay()[0] != $item['id'] && regionKingSoldStrikeDayBad()[0] != $item['id'])
                                                        <span class="mb-1" style="color: #272730;font-size:12px">
                                                            {{ setRegionTosh($item['name']) }}
                                                        </span>
                                                    @else
                                                        @if (regionKingSoldStrikeDay()[0] == $item['id'])
                                                            <span class="mb-1" style="color: #272730;font-size:9px">
                                                                {{ setRegionTosh($item['name']) }}
                                                                <button type="button"
                                                                    class="btn btn-sm btn-secondary supercell"
                                                                    style="font-size:11px;background: #12a80f8a;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                                    <span>Strike + {{ count(regionKingSoldStrikeDay()) }}
                                                                        <span style="font-size:13px;">🔥</span>
                                                                    </span>
                                                                </button>
                                                            </span>
                                                        @endif
                                                        @if (regionKingSoldStrikeDayBad()[0] == $item['id'])
                                                            <span class="mb-1" style="color: #272730;font-size:9px">
                                                                {{ setRegionTosh($item['name']) }}
                                                                <button type="button"
                                                                    class="btn btn-sm btn-secondary supercell"
                                                                    style="font-size:11px;background: #de14148a;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                                    <span>Strike - {{ count(regionKingSoldStrikeDay()) }}
                                                                        <span style="font-size:13px;">💩</span>
                                                                    </span>
                                                                </button>
                                                            </span>
                                                        @endif
                                                    @endif
                                                </div>

                                                <div class="col-2">
                                                    <img src="{{ asset('mobile/king-sold.webp') }}" width="23px;">
                                                </div>
                                                <div class="col-2 pl-0">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell"
                                                        style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        {{ $item['count'] }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @endisset
                    </div>
                </div>
                {{-- <div class="tab-pane fade @if ($exist_duel == 0) show active @endif pb-3" id="home"
                    role="tabpanel" aria-labelledby="home-tab" style="background: #e1edf2">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active p-3">
                                <img class="d-block w-100" src="{{ asset('mobile/king/Glavniy.png') }}"
                                    alt="First slide">
                            </div>
                            <div class="carousel-item p-3">
                                <img class="d-block w-100" src="{{ asset('mobile/king/Oltin.png') }}"
                                    alt="Second slide">
                            </div>
                            <div class="carousel-item p-3">
                                <img class="d-block w-100" src="{{ asset('mobile/king/Kumush.png') }}"
                                    alt="Third slide">
                            </div>
                            <div class="carousel-item p-3">
                                <img class="d-block w-100" src="{{ asset('mobile/king/Bronza.png') }}"
                                    alt="Fouth slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev" style="margin-left: -21px !important;">
                            <span aria-hidden="true">
                                <i class="material-icons" style="color:#000000;font-size:33px;">navigate_before</i>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next" style="margin-right: -21px !important;">
                            <span aria-hidden="true">
                                <i class="material-icons" style="color:#000000;font-size:33px;">navigate_next</i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="container mt-1 mb-1">
                        <div class="col-12 pt-4 pb-4 pr-3 supercell text-center"
                            style="color: white;background-image: url({{ asset('mobile/counter.png') }});background-size: 100% 100%;">
                            <span class="text-center" id="" style="font-size: 35px;">{{ $timer['day'] }}</span>
                            <span style="font-size: 15px;">kun :</span>
                            <span class="text-center" id="" style="font-size: 35px;">{{ $timer['hour'] }}</span>
                            <span style="font-size: 15px;">soat :</span>
                            <span class="text-center" id="" style="font-size: 35px;">{{ $timer['minut'] }}</span>
                            <span style="font-size: 15px;">min</span>
                            <p class="p-0" style="font-size: 20px;">Shox turnir tugashiga qoldi</p>
                        </div>
                    </div>
                    <div class="row m-0 p-0">

                        <div class="col-6 text-center supercell pr-1">
                            @foreach ($region_king_sold as $item)
                            @endforeach
                            @php
                                if (isset($region_king_sold[0])) {
                                    $side1 = $region_king_sold[0]['side'];
                                    $count1 = $region_king_sold[0]['count'];
                                } else {
                                    $side1 = 0;
                                    $count1 = 0;
                                }
                                if (isset($region_king_sold[1])) {
                                    $side2 = $region_king_sold[1]['side'];
                                    $count2 = $region_king_sold[1]['count'];
                                } else {
                                    $side2 = 0;
                                    $count2 = 0;
                                }
                            @endphp
                            @if ($side1 != 0)
                                <button type="button"
                                    class="mb-2 btn deletecolor btn-block
                            @if ($count1 > $count2) btn-primary
                            @elseif($count1 < $count2)
                            btn-danger
                            @else
                            btn-info @endif
                            ">
                                    <span class="text-left">
                                        @if ($side1 == 1)
                                            G'arb
                                        @else
                                            Sharq
                                        @endif
                                    </span>
                                    <p class="text-left">{{ $count1 }} <img
                                            src="{{ asset('mobile/king-sold.webp') }}" width="23px;"></p>
                                </button>
                            @endif
                        </div>
                        <div class="col-6 text-center supercell pl-1">
                            @foreach ($region_king_sold as $item)
                            @endforeach
                            @php
                                if (isset($region_king_sold[0])) {
                                    $side1 = $region_king_sold[0]['side'];
                                    $count1 = $region_king_sold[0]['count'];
                                } else {
                                    $side1 = 0;
                                    $count1 = 0;
                                }
                                if (isset($region_king_sold[1])) {
                                    $side2 = $region_king_sold[1]['side'];
                                    $count2 = $region_king_sold[1]['count'];
                                } else {
                                    $side2 = 0;
                                    $count2 = 0;
                                }
                            @endphp
                            @if ($side2 != 0)
                                <button type="button"
                                    class="mb-2 btn deletecolor btn-block
                            @if ($count1 < $count2) btn-primary
                            @elseif($count1 > $count2)
                            btn-danger
                            @else
                            btn-info @endif
                            ">
                                    <span class="text-right">
                                        @if ($side2 == 1)
                                            G'arb
                                        @else
                                            Sharq
                                        @endif
                                    </span>
                                    <p class="text-right"> <img src="{{ asset('mobile/king-sold.webp') }}"
                                            width="23px;">{{ $count2 }}</p>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div>
                        @isset($king_sold)
                            @foreach ($king_sold as $ligaImage => $ligaItems)
                                <div class="m-0 mt-3">
                                    <img src="{{ asset("mobile/king/$ligaImage.png") }}" width="105%"
                                        style="border-radius:15px;margin-left: -9px;margin-top:-2px;position:relative">
                                </div>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($ligaItems as $key => $item)
                                    @php
                                        if ($i == 0) {
                                            $color = 'e0aa2c';
                                        }
                                        if ($i == 1) {
                                            $color = 'bdccdb';
                                        }
                                        if ($i == 2) {
                                            $color = 'cc8448';
                                        }
                                        if (!in_array($i, [0, 1, 2])) {
                                            $color = '8d9eb8';
                                        }
                                    @endphp
                                    <div class="col-12 supercell">
                                        <div class="card border-0 mb-1">
                                            <div class="card-body" class="pr-0"
                                                style="background: #c8d7ec;border-radius:15px;">
                                                <div class="row align-items-center m-0 p-0">
                                                    <div class="col-2 pl-0">
                                                        <button type="button" class="btn btn-sm btn-secondary supercell"
                                                            style="background: #{{ $color }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            {{ $i + 1 }}
                                                        </button>
                                                    </div>
                                                    <div class="col-4 pl-0">
                                                        <span class="mb-1"
                                                            style="color: #272730;font-size:11px">{{ $item->f }}
                                                            {{ substr($item->l, 0, 1) }}</span>
                                                        <p style="color: #272730;font-size:10px;color:#6c757d;">
                                                            {{ setRegionTosh($item->r) }}
                                                        </p>
                                                    </div>
                                                    <div class="col-1 pl-0 pr-1 text-right">

                                                        @if ($item->id != Auth::id() && !in_array($item->id, getKSBId()) && !in_array(Auth::id(), getKSBId()))
                                                            <button style="background: transparent;border:none"
                                                                data-toggle="modal"
                                                                data-target="#ksb{{ $item->id }}">
                                                                <img src="{{ asset('mobile/king/bat.png') }}"
                                                                    width="30px;">
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="col-5 pl-2 pr-0">
                                                        <div class="d-flex align-items-center justify-content-between supercell text-white btn px-1 ml-3"
                                                            style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            <div>
                                                                <img src="{{ asset('mobile/king-sold.webp') }}"
                                                                    width="23px;">
                                                            </div>
                                                            <div>
                                                                {{ $item->count }}@if (isset($get_ksb_bonus[$item->id]))
                                                                    +{{ $get_ksb_bonus[$item->id] }}
                                                                @endif
                                                            </div>
                                                            @if ($date_begin >= '2023-03-04')
                                                                @php
                                                                    $b = strtotime($date_begin);
                                                                    $e = strtotime($date_end);
                                                                @endphp
                                                                <div data-toggle="modal" data-target="#kscheck""
                                                                    onclick="ksCheck(`{{ $item->id }}`,`{{ $b }}`,`{{ $e }}`)">
                                                                    <span aria-hidden="true">
                                                                        <i class="material-icons"
                                                                            style="color:#107a0e;font-size:20px;">visibility</i>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i = $i + 1;
                                    @endphp
                                @endforeach
                            @endforeach
                        @endisset
                    </div>
                </div> --}}
                {{-- <div class="tab-pane fade @if ($exist_duel == 1) show active @endif" id="duel"
                    role="tabpanel" aria-labelledby="duel-tab" style="background: #e1edf2">
                    <div class="row pt-3">
                        <div class="col-12 text-center supercell p-0">
                            <button type="button" class="mb-2 btn btn-sm deletecolor btn-info"
                                wire:click="$emit('ksbHistory','Shu hafta')">
                                <span class="supercel-text-stroke">Shu hafta</span>
                            </button>
                            <button type="button" class="mb-2 btn btn-sm deletecolor btn-info"
                                wire:click="$emit('ksbHistory','Oldingi hafta')">
                                <span class="supercel-text-stroke">Oldingi hafta</span>
                            </button>
                        </div>
                    </div>
                    <div class="pt-3">
                        @if (count($myks_battle) > 0)
                            <div class="col-12 col-md-6">
                                <div class="card border-0">

                                    <div class="card-body"
                                        style="background: #898989;border-radius:15px;padding:20px;padding-bottom:5px !important;padding-top:5px !important">
                                        <div class="row supercell pt-1 pb-0"
                                            style="font-size:10px;background: #e8b331;border-top-left-radius:15px;border-top-right-radius:15px;height:3.4em;">
                                            <div class="col pl-0">
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    style="font-size:13px;-webkit-text-stroke: 1px #363b3d;color:#ffffff;">
                                                    {{ date('d.m', strtotime($myks_battle[0]->start_date)) }} -
                                                    {{ date('d.m', strtotime($myks_battle[0]->end_date)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row supercell p-2"
                                            style="background: #ffffff;border-bottom-left-radius:15px;border-bottom-right-radius:15px;">
                                            <div class="col-5 col-md-2">
                                                <div class="rounded-circle mb-1 bg-default-light text-default"
                                                    style="width: 85px">
                                                    @if (Auth::user()->id == $myks_battle[0]->offer_uids->id)
                                                        @if (isset($myks_battle[0]->offer_uids->image_url))
                                                            <img src="{{ $myks_battle[0]->offer_uids->image_url }}"
                                                                height="85px" alt=""
                                                                style="border-radius: 50%;">
                                                        @else
                                                            <img src="https://api.multiavatar.com/kathrin.svg"
                                                                height="85px" alt="">
                                                        @endif
                                                    @else
                                                        @if (isset($myks_battle[0]->accept_uids->image_url))
                                                            <img src="{{ $myks_battle[0]->accept_uids->image_url }}"
                                                                height="85px" alt=""
                                                                style="border-radius: 50%;">
                                                        @else
                                                            <img src="https://api.multiavatar.com/kathrin.svg"
                                                                height="85px" alt="">
                                                        @endif
                                                    @endif
                                                </div>
                                                <p class="text-dark mb-1" style="font-size:14px;">
                                                    @if (Auth::user()->id == $myks_battle[0]->offer_uids->id)
                                                        {{ $myks_battle[0]->offer_uids->first_name }}
                                                        {{ substr($myks_battle[0]->offer_uids->last_name, 0, 1) }}
                                                    @else
                                                        {{ $myks_battle[0]->accept_uids->first_name }}
                                                        {{ substr($myks_battle[0]->accept_uids->last_name, 0, 1) }}
                                                    @endif
                                                </p>

                                                @if ($myks_battle[0]->start == 1)
                                                    <button style="font-size:10px;background: #0c2237;"
                                                        class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                        @if (Auth::user()->id == $myks_battle[0]->offer_uids->id)
                                                            {{ getKSCount($myks_battle[0]->offer_uids->id, $myks_battle[0]->start_date, $myks_battle[0]->end_date) }}
                                                        @else
                                                            {{ getKSCount($myks_battle[0]->accept_uids->id, $myks_battle[0]->start_date, $myks_battle[0]->end_date) }}
                                                        @endif
                                                    </button>
                                                @endif

                                            </div>
                                            <div class="col-2 col-md-2 text-center pt-4"
                                                style="padding-left: 31px !important">
                                                <img src="{{ asset('mobile/vs.png') }}" width="50px"
                                                    style="border-radius:15px;margin-left: -28px;margin-top:-5px;">
                                            </div>
                                            <div class="col-5 col-md-2 text-right">
                                                <div class="rounded-circle mb-1 bg-default-light text-default"
                                                    style="width: 85px;margin-left:1.5em !important">
                                                    @if (Auth::user()->id != $myks_battle[0]->offer_uids->id)
                                                        @if (isset($myks_battle[0]->offer_uids->image_url))
                                                            <img src="{{ $myks_battle[0]->offer_uids->image_url }}"
                                                                height="85px" alt=""
                                                                style="border-radius: 50%;">
                                                        @else
                                                            <img src="https://api.multiavatar.com/kathrin.svg"
                                                                height="85px" alt="">
                                                        @endif
                                                    @else
                                                        @if (isset($myks_battle[0]->accept_uids->image_url))
                                                            <img src="{{ $myks_battle[0]->accept_uids->image_url }}"
                                                                height="85px" alt=""
                                                                style="border-radius: 50%;">
                                                        @else
                                                            <img src="https://api.multiavatar.com/kathrin.svg"
                                                                height="85px" alt="">
                                                        @endif
                                                    @endif
                                                </div>
                                                <p class="text-dark mb-1" style="font-size:14px;">
                                                    @if (Auth::user()->id != $myks_battle[0]->offer_uids->id)
                                                        {{ $myks_battle[0]->offer_uids->first_name }}
                                                        {{ substr($myks_battle[0]->offer_uids->last_name, 0, 1) }}
                                                    @else
                                                        {{ $myks_battle[0]->accept_uids->first_name }}
                                                        {{ substr($myks_battle[0]->accept_uids->last_name, 0, 1) }}
                                                    @endif
                                                </p>
                                                @if ($myks_battle[0]->start == 1)

                                                    <button style="font-size:10px;background: #0c2237;"
                                                        class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                        @if (Auth::user()->id != $myks_battle[0]->offer_uids->id)
                                                            {{ getKSCount($myks_battle[0]->offer_uids->id, $myks_battle[0]->start_date, $myks_battle[0]->end_date) }}
                                                        @else
                                                            {{ getKSCount($myks_battle[0]->accept_uids->id, $myks_battle[0]->start_date, $myks_battle[0]->end_date) }}
                                                        @endif
                                                    </button>
                                                @endif
                                            </div>
                                            @if ($myks_battle[0]->start == 0 && $myks_battle[0]->offer_uids->id == Auth::id())
                                                <div class="col-12 mt-2 mb-2 text-center">
                                                    <button style="box-shadow: 1px 1px 3px 1px #8e8989" type="button"
                                                        style="background: #2cc445"
                                                        class="btn btn-sm btn-info btn-block">
                                                        <span
                                                            style="-webkit-text-stroke: 1px #000000;">Kutilmoqda</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if ($myks_battle[0]->start == 0 && $myks_battle[0]->accept_uids->id == Auth::id())
                                                <div class="col-12 mt-2 mb-2 text-center">
                                                    <span
                                                        style="font-size:12px;">{{ getUser($myks_battle[0]->offer_uids->id)->last_name }}
                                                        {{ substr(getUser($myks_battle[0]->offer_uids->id)->first_name, 0, 1) }}
                                                        sizni jangga chaqirdi va xabar yubordi
                                                    </span>
                                                </div>
                                                <div class="card-body p-0">
                                                    <form action="{{ route('answer.ksb') }}" method="POST"
                                                        id="ksb_form">
                                                        @csrf
                                                        <div class="container p-0 mt-2 mb-2 text-center">
                                                            <div class="form-group">
                                                                <input style="font-size:12px;" type="text"
                                                                    class="form-control"
                                                                    value="{{ $myks_battle[0]->offer_comment }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="container p-0 mt-2 mb-2 text-center">
                                                            <div class="form-group">
                                                                <input style="font-size:12px;" type="text"
                                                                    name="comment" class="form-control"
                                                                    placeholder="Xabar yuborish..." required>
                                                            </div>
                                                        </div>
                                                        <input class="d-none" id="accept_ksb" type="number"
                                                            name="accept" value="1">
                                                        <input class="d-none" id="no_accept_ksb" type="number"
                                                            name="accept" value="0">
                                                        <input class="d-none" type="number" name="ksb_id"
                                                            value="{{ $myks_battle[0]->id }}">
                                                        <div class="col-12 mt-2 mb-2 text-left double_ksb">
                                                            <button
                                                                onclick="$('#no_accept_ksb').remove();$('.double_ksb').remove();$('.double_ksb_no').removeClass('d-none');$('#ksb_form').submit();"
                                                                style="box-shadow: 1px 1px 3px 1px #8e8989"
                                                                type="button" style="background: #2cc445"
                                                                class="btn btn-sm btn-success btn-block">
                                                                <span style="-webkit-text-stroke: 1px #000000;">Duelni
                                                                    qabul
                                                                    qilish</span>
                                                            </button>
                                                        </div>
                                                        <div class="col-12 mt-2 mb-2 text-right double_ksb">
                                                            <button
                                                                onclick="$('#accept_ksb').remove();$('.double_ksb').remove();$('.double_ksb_no').removeClass('d-none');$('#ksb_form').submit();"
                                                                style="box-shadow: 1px 1px 3px 1px #8e8989"
                                                                type="button" style="background: #2cc445"
                                                                class="btn btn-sm btn-danger btn-block">
                                                                <span style="-webkit-text-stroke: 1px #000000;">Duelni
                                                                    rad
                                                                    qilish</span>
                                                            </button>
                                                        </div>
                                                        <div class="col-12 mt-2 mb-2 text-right double_ksb_no d-none">
                                                            <button style="box-shadow: 1px 1px 3px 1px #8e8989"
                                                                type="button" style="background: #2cc445"
                                                                class="btn btn-sm btn-info btn-block">
                                                                <span style="-webkit-text-stroke: 1px #000000;">Biroz
                                                                    kuting</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @foreach ($all_ks_battle as $item)
                            <div class="col-12 col-md-6">
                                <div class="card border-0">
                                    <div class="card-body"
                                        style="background: #898989;border-radius:15px;padding:20px;padding-bottom:5px !important;padding-top:5px !important">
                                        <div class="row supercell pt-1 pb-0"
                                            style="font-size:10px;background: #e8b331;border-top-left-radius:15px;border-top-right-radius:15px;height:3.4em;">
                                            <div class="col pl-0">
                                            </div>
                                            <div class="col-auto">
                                                <span
                                                    style="font-size:13px;-webkit-text-stroke: 1px #363b3d;color:#ffffff;">
                                                    {{ date('d.m', strtotime($item->start_date)) }} -
                                                    {{ date('d.m', strtotime($item->end_date)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row supercell p-2"
                                            style="background: #ffffff;border-bottom-left-radius:15px;border-bottom-right-radius:15px;">
                                            <div class="col-5 col-md-2">

                                                <p class="text-dark mb-1" style="font-size:14px;">
                                                    {{ $item->offer_uids->first_name }}
                                                    {{ substr($item->offer_uids->last_name, 0, 1) }}
                                                </p>

                                                @if ($item->start == 1)
                                                    <button style="font-size:10px;background: #0c2237;"
                                                        class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                        {{ getKSCount($item->offer_uids->id, $item->start_date, $item->end_date) }}
                                                    </button>
                                                @endif

                                            </div>
                                            <div class="col-2 col-md-2 text-center pt-4"
                                                style="padding-left: 31px !important">
                                                <img src="{{ asset('mobile/vs.png') }}" width="30px"
                                                    style="border-radius:15px;margin-left: -28px;margin-top:-40px;">
                                            </div>
                                            <div class="col-5 col-md-2 text-right">

                                                <p class="text-dark mb-1" style="font-size:14px;">
                                                    {{ $item->accept_uids->first_name }}
                                                    {{ substr($item->accept_uids->last_name, 0, 1) }}
                                                </p>
                                                @if ($item->start == 1)
                                                    <button style="font-size:10px;background: #0c2237;"
                                                        class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                        {{ getKSCount($item->accept_uids->id, $item->start_date, $item->end_date) }}
                                                    </button>
                                                @endif
                                            </div>
                                            @if ($item->start == 0)
                                                <div class="col-12 mt-2 mb-2 text-center">
                                                    <button style="box-shadow: 1px 1px 3px 1px #8e8989" type="button"
                                                        style="background: #2cc445"
                                                        class="btn btn-sm btn-info btn-block">
                                                        <span
                                                            style="-webkit-text-stroke: 1px #000000;">Kutilmoqda</span>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>

    </div>
</div>
