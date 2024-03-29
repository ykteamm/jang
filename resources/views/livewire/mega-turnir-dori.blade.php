
<div class="modal-content">
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
                Karobka sovg'a choy</div>
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


    @if($resime == 2)

    <div class="col-12" style="background-image: url(/promo/dist/img/promo/bg2.png);">





        {{-- <div class="col-12 mt-1 mb-1" >

           <button class="btn btn-danger" data-toggle="modal" data-target="#mega-turnir-battle">janglar</button>

        </div> --}}


        <div class="border-0 mb-3">
            <div class="card-body" class="pr-0"
                style="background:none;">
                <div class="supercell text-center mb-4" style="color:rgb(255, 255, 255)">Reyting</div>


                <style>
                    .katak1{
                        padding: 9px 10px;
                        border-radius: 4px;
                    }
                </style>
                @foreach ($arrays as $key => $team)
                    @php
                        if ($key == 0) {
                            $color = '-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#f3e48d,#ffd20f,#c39008);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fff0a8;';
                            $gr = 'linear-gradient(45deg, #f5b746, #ffe764)';
                            $grv = 'linear-gradient(45deg, #c78f29, #e9cb29)';
                            $katak = '#d99d2f';
                        }
                        if (!in_array($key, [0])) {
                            $color = '-webkit-text-stroke: 1px #36393a !important;background: #77a9d5;border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #e7eae8;';
                            $grv = 'linear-gradient(45deg, #7f9cef, #7f9cef)';
                            $katak = '#7f9cef';

                        }
                    @endphp
                    @if (in_array($key,[0,1,2]))
                        <div class="row align-items-center pr-3 py-2"
                        style="
                            background: {{$grv}};
                            border-top-left-radius: 15px;
                            border-top-right-radius: 15px;
                        "
                        ></div>
                        <div class="row align-items-center pr-3 py-1 mb-1"
                            style="border-bottom:1px solid #959690;background: {{$gr}};
                            border-bottom-left-radius: 15px;
                            border-bottom-right-radius: 15px;
                            ">

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
                                {{-- <img src="{{asset('mobile/turnir/qil.webp')}}" width="100%" alt=""> --}}
                            </div>
                            <div class="col-5 katak1"
                                style="background:{{$katak}}">
                                <div class="mb-1 supercell" style="color: #ffffff;font-size:12px;-webkit-text-stroke: 1px #36393a !important;">
                                    {{-- {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }} --}}
                                    {{$team['name']}}
                                </div>
                            </div>
                            <div class="col-3 katak1 ml-3"
                                style="background:{{$katak}}">
                                <div class="mb-1 supercell" style="color: #ffffff;font-size:12px;-webkit-text-stroke: 1px #36393a !important;">
                                    {{-- {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }} --}}
                                    {{$team['ball']}} dona
                                </div>
                            </div>
                            {{-- <div class="col-3 text-center p-0" style="padding-right: 4px !important;">
                                <div style="font-size:15px;font-weight:800">
                                    <img src="{{asset('mobile/team/12000.webp')}}" width="50px" alt="">
                                </div>
                            </div>
                            <div class="col-2 text-center" style="border-left:1px solid #717fe9;">
                                <button type="button" class="btn btn-sm btn-secondary supercell"
                                    style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width:50px;height: 40px;">
                                    <span class="text-center"
                                        style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                        23
                                    </span>
                                </button>
                            </div> --}}
                        </div>
                    @else
                    <div class="row align-items-center pr-3 py-2"
                        style="
                            background: {{$grv}};
                            border-top-left-radius: 15px;
                            border-top-right-radius: 15px;
                        "
                        ></div>
                        <div class="row align-items-center pr-3 py-1 mb-1"
                            style="background:linear-gradient(45deg, #b2bccf, #bdc1c7);;
                            border-bottom-left-radius: 15px;
                            border-bottom-right-radius: 15px;
                            ">
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
                                {{-- <img src="{{asset('mobile/turnir/qil.webp')}}" width="100%" alt=""> --}}

                            </div>
                            <div class="col-5 katak1"
                                style="background:{{$katak}}">
                                <div class="mb-1 supercell" style="color: #ffffff;font-size:12px;-webkit-text-stroke: 1px #36393a !important;">
                                    {{-- {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }} --}}
                                    {{$team['name']}}

                                </div>
                            </div>
                            <div class="col-3 katak1 ml-3"
                                style="background:{{$katak}}">
                                <div class="mb-1 supercell" style="color: #ffffff;font-size:12px;-webkit-text-stroke: 1px #36393a !important;">
                                    {{-- {{ substr($team->f1, 0, 8) }}.{{ substr($team->l1, 0, 1) }} --}}
                                    {{$team['ball']}} dona
                                </div>
                            </div>
                            {{-- <div class="col-3 text-center p-0" style="padding-right: 4px !important;">
                                <div style="font-size:15px;font-weight:800">
                                    -
                                </div>
                            </div>
                            <div class="col-2 text-center" style="border-left:1px solid #717fe9;">
                                <button type="button" class="btn btn-sm btn-secondary supercell"
                                    style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width:50px;height: 40px;">
                                    <span class="text-center"
                                        style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                23
                                    </span>
                                </button>
                            </div> --}}
                        </div>
                    @endif

                @endforeach
            </div>
        </div>


    </div>
    @endif


</div>
