<div class="modal-content"
    style="background-image: url('/promo/dist/img/promo/bg2.png');
    background-repeat: no-repeat;">
    @if($resime == 2)
    <div class="modal-body p-0">
        <div class="container">
            <img src="{{ asset('mobile/upheader.png') }}" width="111%"
                style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style="opacity: 5;position:absolute;top:6px;right:10px;">
                <img src="{{ asset('mobile/xclose.png') }}" width="30px">
            </button>
        </div>
        <div class="container p-0">
            <div class="container">
                <div class="row mb-3 mt-3">
                    <div class="col-3">
                        <div class="text-center mb-1 d-flex justify-content-center align-items-center"
                            style="
                            height:60px;
                            border-radius: 10px;
                            background:#006791a6;
                            border: 2px solid #1abac6;
                        ">
                            @isset($reg)
                                <img width="80px" src="{{ asset('mobile/regions/' . $reg->id . '.png') }}" alt="">
                            @endisset
                        </div>
                    </div>
                    <div class="col-8 text-center mt-3">
                        @isset($reg)
                            <h4 class="text-white supercell" style="width:200px;height:40px">
                                <span>{{ substr($reg->name, 0, 10) }}</span>
                            </h4>
                        @endisset
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                            style="background: #083f6694;border-radius: 8px;">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="{{ asset('mobile/kb.png') }}" width="23px;">
                                </div>
                                <div class="col-9 pl-0 pr-2">
                                    <div class="supercell py-1"
                                        style="background: #05223b78;border-radius: 4px;margin-top:2px;font-size:17px">
                                        {{ number_format($kubok, 0, ',', ' ') }}
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                            style="background: #083f6694;border-radius: 8px;">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="{{ asset('mobile/king-sold.webp') }}" width="23px;">
                                </div>
                                <div class="col-9 pl-0 pr-2">
                                    <div class="supercell py-1"
                                        style="background: #05223b78;border-radius: 4px;margin-top:2px;;font-size:16px">
                                        {{ number_format($king_sold, 0, ',', ' ') }}
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-12">
                        <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                            style="background: #083f6694;border-radius: 8px;">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="{{ asset('mobile/oltin.png') }}" width="23px;">
                                </div>
                                <div class="col-9 pl-0 pr-2">
                                    <div class="supercell py-1"
                                        style="background: #05223b78;border-radius: 4px;margin-top:2px;;font-size:16px">
                                        {{ number_format($fact, 0, ',', ' ') }}
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            {{-- src="{{asset('mobile/upheader.png')}}" --}}
            <div class="container p-0 mt-5 pb-1" style="background:#e8e8e0;border-radisu:10px !important;">
                <img src="{{ asset('mobile/upheader.png') }}" width="100%" style="margin-top: -30px;">
                <div class="mb-3">
                    @isset($users)
                        <div class="col-12 supercell pl-0 pr-0">
                            <div class="card border-0 mb-1">
                                <div class="card-body pt-1 pb-1 text-center"
                                    style="background: #dfe7f2;border-radius:15px;border:1px solid #666464">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="supercell"> Elchi soni </h6>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="supercell">{{ count($users) }} </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($users as $key => $item)
                            @php
                                if ($key == 0) {
                                    $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#f3e48d,#ffd20f,#c39008);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fff0a8;';
                                }
                                if ($key == 1) {
                                    $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#a1aab8,#d4d9e0,#767c81);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #e7eae8;';
                                }
                                if ($key == 2) {
                                    $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#c7854d,#d89d6e,#946c48);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fbe2c4;';
                                }
                                if (!in_array($key, [0, 1, 2])) {
                                    $color = '-webkit-text-stroke: 1px #36393a !important;background: #bdcedd;border: 1px solid #c8b7b7;';
                                }
                            @endphp
                            <div class="col-12">
                                <div class="card border-0 mb-1" data-toggle="modal" data-target="#user-profil"
                                onclick="upModal({{ $item->id }})">
                                    <div class="card-body" class="pr-0"
                                        style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                                        <div class="row align-items-center">
                                            <div class="col-2 pl-2">
                                                <button type="button" class="btn-sm btn-secondary supercell p-0"
                                                    style="{{ $color }};width: 45px;height: 35px;">
                                                    @php
                                                        $wer = $key + 1 . '.';
                                                    @endphp
                                                    <span
                                                        style="font-size: 16px;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                        {{ $wer }}</span>
                                                </button>
                                            </div>
                                            <div class="col-2 text-center p-0 pl-1" style="border-left:1px solid #959690;padding-left:4px !important">
                                                <div style="width:50px;height:50px;overflow:hidden;border-radius:50%">
                                                    <img style="width:50px;"
                                                    src="{{ $item->image_url }}"
                                                    alt="">
                                                </div>
                                            </div>
                                            <div class="col-4 p-0 pl-1">
                                                <div class="mb-1 supercell" style="color: #272730;font-size:12px">
                                                    {{ $item->first_name }} {{ substr($item->last_name, 0, 1) }}
                                                </div>
                                                <div style="font-size:12px;font-weight:800">{{ userNickName($item->id) }}</div>
                                            </div>
                                            {{-- <div class="col-2 text-center p-0" style="padding-right: 4px !important;">
                                                <div style="font-size:12px;font-weight:600">Elchilar</div>
                                                <div style="font-size:15px;font-weight:800">{{ $item->count }}</div>
                                            </div> --}}
                                            <div class="col-4 p-0"
                                                style="border-left:1px solid #959690;padding-left: 10px !important;">
                                                <button type="button" class="btn btn-sm btn-secondary supercell"
                                                    style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                            {{-- @if (round($item->allprice / 1000000) == 0)
                                                                0
                                                            @else
                                                                {{ round($item->allprice / 1000000) }}M
                                                            @endif --}}
                                                            {{ numb($item->sold) }}
                                                        </span>
                                                        <img src="{{ asset('mobile/oltin.png') }}" width="23px;"
                                                            style="padding-left:3px">
                                                    </div>
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
        </div>
    </div>
    @endif
</div>
