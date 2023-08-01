<div class="modal-content">
    <div class="modal-header" style="background: #e8e8e0">
        <img src="{{ asset('mobile/vil.webp') }}" width="111%"
            style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="opacity: 5;position:absolute;top:8px;right:10px;">
            <img src="{{ asset('mobile/xclose.png') }}" width="30px">
        </button>
    </div>
    <div class="modal-body p-0" style="background: #e8e8e0">
        <div class="container p-0">
            <div class="mb-3 pt-3">
                <div class="col-12 supercell">
                    <div class="card border-0 mb-1">
                        <div class="card-body" class="pr-0"
                            style="height:220px;background-image: linear-gradient(to bottom,#867eb9,#5f5699,#474180);border-radius:9px;border:2px solid #342e5b;">
                            @if($bestRegions)
                                @if (count($bestRegions) > 0)
                                    <div class="row align-items-center">
                                        <div class="col-4 text-center">
                                            <div style="position: relative">
                                                <img style="width: 75px"
                                                    src="{{ asset('mobile/regions/' . $bestRegions[1]->id . '.png') }}"
                                                    alt="">
                                                <img style="position: absolute;bottom:31px;right:-10px;width: 35px;height:35px;border-radius:50%"
                                                    src="{{ $bestRegions[1]->users[0]->image_url }}" alt="">
                                                <img style="position: absolute;bottom:8px;right:-2px;width:30px;height:30px;border-radius:50%"
                                                    src="{{ $bestRegions[1]->users[1]->image_url }}" alt="">
                                                <img style="position: absolute;bottom:-11px;right:21px;width:30px;height:30px;border-radius:50%"
                                                    src="{{ $bestRegions[1]->users[2]->image_url }}" alt="">
                                                </div>
                                                <div style="font-size:12px;color:#d4d9e0" class="supercell text-center pt-4">2. {{ substr($bestRegions[1]->name, 0, 6) }}</div>
                                                <div class="pt-2 d-flex align-items-center justify-content-center">
                                                    <span
                                                        style="font-size:11px;color:#fff">
                                                        @if (round($bestRegions[1]->allprice / 1000000) == 0)
                                                            0
                                                        @else
                                                            {{ round($bestRegions[1]->allprice / 1000000) }}M
                                                        @endif
                                                    </span>
                                                    <img src="{{ asset('mobile/oltin.png') }}" width="23px;"
                                                        style="padding-left:3px">
                                                </div>
                                        </div>
                                        <div class="col-4 p-0 text-center">
                                            <div style="position: relative">
                                                <img style="width: 95px"
                                                    src="{{ asset('mobile/regions/' . $bestRegions[0]->id . '.png') }}"
                                                    alt="">
                                                    <img style="position: absolute;bottom:46px;right:-15px;width: 40px;height:40px;border-radius:50%"
                                                    src="{{ $bestRegions[0]->users[0]->image_url }}" alt="">
                                                <img style="position: absolute;bottom:15px;right:-2px;width:30px;height:30px;border-radius:50%"
                                                    src="{{ $bestRegions[0]->users[1]->image_url }}" alt="">
                                                <img style="position: absolute;bottom:-6px;right:21px;width:30px;height:30px;border-radius:50%"
                                                    src="{{ $bestRegions[0]->users[2]->image_url }}" alt="">
                                                </div>
                                                <div style="font-size:14px;color:#ffd20f" class="supercell text-center pt-4">1. {{ substr($bestRegions[0]->name, 0, 7) }}</div>
                                                <div class="pt-2 d-flex align-items-center justify-content-center">
                                                    <span
                                                        style="font-size:11px;color:#fff">
                                                        @if (round($bestRegions[0]->allprice / 1000000) == 0)
                                                            0
                                                        @else
                                                            {{ round($bestRegions[0]->allprice / 1000000) }}M
                                                        @endif
                                                    </span>
                                                    <img src="{{ asset('mobile/oltin.png') }}" width="23px;"
                                                        style="padding-left:3px">
                                                </div>
                                            </div>
                                        <div class="col-4 text-center">
                                            <div style="position: relative">
                                                <img style="width: 60px"
                                                    src="{{ asset('mobile/regions/' . $bestRegions[2]->id . '.png') }}"
                                                    alt="">
                                                    <img style="position: absolute;bottom:31px;right:-10px;width: 35px;height:35px;border-radius:50%"
                                                    src="{{ $bestRegions[2]->users[0]->image_url }}" alt="">
                                                <img style="position: absolute;bottom:8px;right:-2px;width:30px;height:30px;border-radius:50%"
                                                    src="{{ $bestRegions[2]->users[1]->image_url }}" alt="">
                                                <img style="position: absolute;bottom:-11px;right:21px;width:30px;height:30px;border-radius:50%"
                                                    src="{{ $bestRegions[2]->users[2]->image_url }}" alt="">
                                                </div>
                                                <div style="font-size:10px;color:#d89d6e" class="supercell text-center pt-4">3. {{ substr($bestRegions[2]->name, 0, 8) }}</div>
                                                <div class="pt-2 d-flex align-items-center justify-content-center">
                                                    <span
                                                        style="font-size:11px;color:#fff">
                                                        @if (round($bestRegions[2]->allprice / 1000000) == 0)
                                                            0
                                                        @else
                                                            {{ round($bestRegions[2]->allprice / 1000000) }}M
                                                        @endif
                                                    </span>
                                                    <img src="{{ asset('mobile/oltin.png') }}" width="23px;"
                                                        style="padding-left:3px">
                                                </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 my-2">
                    <div class="d-flex align-items-center justify-content-end">
                        <div id="switch" class="switch @if ($date != 'Oy') month @endif"
                            wire:click="$emit('changeRegTime', @if ($date != 'Oy') 'Oy' @else 'Kun' @endif)"
                            >
                            <div class="switch-img">
                                <img src="{{ asset('mobile/switch.png') }}" alt="">
                            </div>
                            <div id="switch-time" class="switch-time">
                                {{ $date }}
                            </div>
                        </div>
                    </div>
                    <style>
                        .switch {
                            width: 60px;
                            height: 19px;
                            border-radius: 15px;
                            background: #7c7799;
                            position: relative;
                        }

                        .switch .switch-img {
                            z-index: 100;
                            left: -4px;
                            top: -5px;
                            position: absolute;
                            transition: all 0.3s ease;
                        }

                        .switch.month .switch-img {
                            left: 40px;
                        }

                        .switch .switch-img img {
                            width: 26px;
                        }

                        .switch .switch-time {
                            position: absolute;
                            z-index: 4;
                            width: 40px;
                            color: #ffffff;
                            top: 0;
                            right: 0px;
                            text-align: center;
                            font-weight: 700;
                            font-size: 13px;
                            transition: all 0.3s ease;

                        }

                        .switch.month .switch-time {
                            right: 15px;
                        }
                    </style>
                    <script>
                        function switcher() {
                            let img = document.getElementById('switch');
                            let switchTime = document.getElementById('switch-time');
                            if (img.classList.contains('month')) {
                                switchTime.innerHTML = "Oy"
                                img.classList.remove('month')
                            } else {
                                switchTime.innerHTML = "Kun"
                                img.classList.add('month')
                            }
                        }
                    </script>
                </div>
                @if($regions)
                    @foreach ($regions as $key => $item)
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
                            <div class="card border-0 mb-1" data-toggle="modal" data-target="#region-profil"
                                onclick="showRegion({{ $item->id }})">
                                <div class="card-body" class="pr-0"
                                    style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                                    <div class="row align-items-center pr-3">
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
                                        <div class="col-1 text-center p-0" style="border-left:1px solid #959690">
                                            <img style="width:40px;padding-left:4px"
                                                src="{{ asset('mobile/regions/' . $item->id . '.png') }}" alt="">
                                        </div>
                                        <div class="col-4 pr-0 pl-3">
                                            <span class="mb-1 supercell" style="color: #272730;font-size:12px">
                                                {{ substr($item->name, 0, 8) }}
                                            </span>
                                        </div>
                                        <div class="col-2 text-center p-0" style="padding-right: 4px !important;">
                                            <div style="font-size:12px;font-weight:600">Elchilar</div>
                                            <div style="font-size:15px;font-weight:800">{{ $item->count }}</div>
                                        </div>
                                        <div class="col-3 p-0"
                                            style="border-left:1px solid #959690;padding-left: 4px !important;">
                                            <button type="button" class="btn btn-sm btn-secondary supercell"
                                                style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                        @if (round($item->allprice / 1000000) == 0)
                                                            0
                                                        @else
                                                            {{ round($item->allprice / 1000000) }}M
                                                        @endif
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
                @endif
            </div>
        </div>
    </div>
</div>
