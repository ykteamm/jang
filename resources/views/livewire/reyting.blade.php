<div class="modal-content" style="background: #5f5554;">
    <div class="modal-header">
            <img src="{{asset('mobile/reyting.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                <img src="{{asset('mobile/xclose.png')}}" width="30px">
            </button>
    </div>
    <div class="modal-body p-0">

    <div class="container p-0">

        <ul class="nav mr-3 ml-3 justify-content-center" id="myTab" role="tablist">
            <li class="nav-item active new-reyting-tab-active reyting-tab1 reyting-tab-class mr-2" onclick="changeReytingTabrey(1)">
              <a class="supercel-text-stroke text-center align-items-center" id="home-tabw" data-toggle="tab" href="#homew" role="tab" aria-controls="homew" aria-selected="true">Sotuv</a>
            </li>
            <li class="nav-item new-reyting-tab reyting-tab2 reyting-tab-class" onclick="changeReytingTabrey(2)">
              <a class="supercel-text-stroke text-center align-items-center" id="profile-tabw" data-toggle="tab" href="#profilew" role="tab" aria-controls="profilew" aria-selected="false">Kubok</a>
            </li>
            {{-- <li class="nav-item reyting-tab reyting-tab3 reyting-tab-class" onclick="changeReytingTab(3)">
                <a class="supercel-text-stroke text-center align-items-center" id="profile-tab2w" data-toggle="tab" href="#profile2w" role="tab" aria-controls="profile2w" aria-selected="false">Viloyat</a>
            </li> --}}
        </ul>

        <div class="tab-content ml-2 mr-2" id="myTabContent">
            <div class="tab-pane fade show active" id="homew" role="tabpanel" aria-labelledby="home-tabw" style="background: #e9e9e1;border-radius:7px;">

                <div class="mb-3 pt-3">

                    {{-- <div class="row" style="background: aqua;
                    border-radius: 8px;
                    border: 2px solid red;">
                        <div class="col-md-4">
                            <img src="{{asset('mobile/ligabronza.webp')}}" width="25%" alt="">
                        </div>
                        <div class="col-md-8">
                            @php
                                $fff = [1,2,3];
                            @endphp
                            @foreach ($fff as $item)
                                <p>Salomova S</p>

                            @endforeach
                        </div>
                    </div> --}}
                    <div class="row text-center mb-3">
                        <div class="col-4 pr-0 mt-1">
                            <button class="@if($liga == 'all') active-reyt @else reyt @endif" wire:click="$emit('changeLiga','all',`{{$date}}`)">
                                Hammasi
                            </button>
                        </div>

                            @foreach ($ligas as $l)
                                <div class="mr-1">
                                    <button class="@if($liga == $l->id) active-reyt @else reyt @endif"  wire:click="$emit('changeLiga',{{$l->id}},`{{$date}}`)">
                                        <img src="{{asset('mobile/'.$l->image)}}" alt="" width="25px">
                                    </button>
                                </div>

                            @endforeach
                    </div>
                    <style>
                        .reyt{
                            background: #c3bdbb;
                            border: 2px solid #81807d;
                            border-radius: 5px;
                        }
                        .active-reyt{
                            background: #ffffff;
                            border: 2px solid #81807d;
                            border-radius: 5px;
                        }
                    </style>
                    <div class="col-12 supercell">
                        <div class="card border-0 mb-1">
                            <div class="card-body" class="pr-0" style="background-image: linear-gradient(to bottom,#867eb9,#5f5699,#474180);border-radius:9px;border:2px solid #342e5b;">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        @foreach ($ligas as $l)
                                            @if($liga == $l->id)
                                                <img src="{{asset('mobile/'.$l->image)}}" width="100%;">
                                            @endif
                                        @endforeach

                                        @if ($liga == 'all')
                                            @foreach ($ligas as $l)
                                                <img src="{{asset('mobile/'.$l->image)}}" width="60%;">
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-9 pl-0" style="color:white;font-size:13px;">
                                        @if (isset($solds))

                                            @foreach ($solds as $key => $item)
                                                @if ($key < 3)
                                                    <p class="m-1" style="border-bottom:1px solid white;
                                                    @if($key == 0)
                                                    color:#fcd422
                                                    @elseif($key == 1)
                                                    color: #dbe9f7;
                                                    @else
                                                    color: #de9454
                                                    @endif
                                                    "
                                                    >{{($key+1).')'}}
                                                        {{$item->first_name}} {{substr($item->last_name,0,1)}}
                                                        <span class="ml-2">
                                                    <img src="{{asset('mobile/oltin.png')}}" width="23px;">{{numb($item->allprice)}}</span>
                                                    </p>
                                                @endif
                                            @endforeach

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <div class="d-flex align-items-center justify-content-end">
                            <div id="switch" class="switch @if ($date != 'Oy') month @endif"
                            wire:click="$emit('changeRegTime2', @if ($date != 'Oy') 'Oy' @else 'Kun' @endif, `{{$liga}}` )"
                            onclick="switcher()"
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
                    @if (isset($solds))
                        @foreach ($solds as $key => $item)
                        @php
                            if ($key == 0) { $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#f3e48d,#ffd20f,#c39008);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fff0a8;'; }
                            if ($key == 1) { $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#a1aab8,#d4d9e0,#767c81);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #e7eae8;'; }
                            if ($key == 2) { $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#c7854d,#d89d6e,#946c48);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fbe2c4;'; }
                            if (!in_array($key,[0,1,2])) { $color = '-webkit-text-stroke: 1px #36393a !important;background: #bdcedd;border: 1px solid #c8b7b7;'; }
                        @endphp
                            <div class="col-12 supercell">
                                <div class="card border-0 mb-1">
                                    <div class="card-body" class="pr-0" style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                                        <div class="row align-items-center">
                                            <div class="col-2 pl-2">
                                                <button type="button" class="btn-sm btn-secondary supercell p-0" style="{{$color}};width: 45px;height: 35px;">
                                                    @php
                                                        $wer = ($key+1).'.';
                                                    @endphp
                                                    <span style="font-size: 16px;text-shadow: 0px 3px 2px #0a0a0a, 0 0 5px #000000;">{{$wer}}</span>
                                                </button>
                                            </div>
                                            <div class="col-1 text-center p-0">
                                                <img style="width:35px;height:35px;padding-left:4px"
                                                    src="{{$item->image_url}}" alt="">
                                            </div>
                                            <div class="col-5 pr-0">
                                                <span class="mb-1" style="color: #272730;font-size:12px">{{$item->first_name}} {{substr($item->last_name,0,1)}}</span>
                                                <p style="color: #272730;font-size:10px;color:#6c757d;">
                                                    {{setRegionTosh($item->t)}}
                                                </p>
                                            </div>
                                            <div class="col-4 p-0">
                                                <button type="button" class="btn btn-sm btn-secondary supercell" style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 100px;height: 40px;">
                                                {{-- <span style="font-size:11px;">{{number_format($item->allprice,0,',',' ')}}</span> --}}
                                                <span style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: 0px 3px 2px #0a0a0a, 0 0 5px #000000;">
                                                    {{numb($item->allprice)}}
                                                </span>
                                                <img src="{{asset('mobile/oltin.png')}}" width="23px;" style="filter: drop-shadow(0px 0px 2px black);">

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
            <div class="tab-pane fade" id="profilew" role="tabpanel" aria-labelledby="profile-tabw" style="background: #677e97">
                <div class="mb-3 pt-3">
                    @if($kubok)
                        @foreach ($kubok as $key => $item)
                        @php
                            if ($key == 0) { $color = 'e0aa2c'; }
                            if ($key ==1) { $color = 'bdccdb'; }
                            if ($key == 2) { $color = 'cc8448'; }
                            if (!in_array($key,[0,1,2])) { $color = '8d9eb8'; }
                        @endphp
                            <div class="col-12 supercell">
                                <div class="card border-0 mb-1">
                                    <div class="card-body" class="pr-0" style="background:  @if($item->user->id == Auth::id()) #a6e693 @else #c8d7ec @endif;border-radius:15px;">
                                        <div class="row align-items-center">
                                            <div class="col-1 p-0 pl-1">
                                                <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #{{$color}};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                    {{$key+1}}
                                                </button>
                                            </div>
                                            <div class="col-4 pr-0">
                                                <span class="mb-1" style="color: #272730;font-size:12px">{{$item->user->first_name}} {{substr($item->user->last_name,0,1)}}</span>
                                            </div>
                                            <div class="col-1 pl-0 pr-1 text-right">
                                                <img src="{{asset('mobile/kb.png')}}" width="23px;">
                                            </div>
                                            <div class="col-2 pl-0 text-left">
                                                <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                    {{$item->ball}}
                                                </button>
                                            </div>
                                            <div class="col-1 pr-1 text-right">
                                                <img src="{{asset('mobile/crys.png')}}" width="23px;">
                                            </div>
                                            <div class="col-2 text-left">
                                                <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                    {{getcris($item->user_id)}}
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
</div>
</div>
