@php use App\Services\LMSTopshiriq; @endphp
<div class="modal-content" style="border: 1px solid blue;
    border-radius: 0px 0px 20px 20px;">
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
        .crystal {
            /*width: 0;*/
            /*height: 0;*/
            /*border-left: 50px solid transparent;*/
            /*border-right: 50px solid transparent;*/
            /*border-bottom: 87px solid #74b9ff;*/
            /*position: relative;*/
            animation: sparkle 0.5s infinite alternate;
        }

        @keyframes sparkle {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
            100% {
                transform: translateY(-10px);
            }
        }

        .crystal2 {
            /*width: 0;*/
            /*height: 0;*/
            /*border-left: 50px solid transparent;*/
            /*border-right: 50px solid transparent;*/
            /*border-bottom: 87px solid #74b9ff;*/
            /*position: relative;*/
            animation: sparkle2 0.5s infinite alternate;
        }

        @keyframes sparkle2 {
            0% {
                transform: translateY(-10px);
            }
            50% {
                transform: translateY(-5px);
            }
            100% {
                transform: translateY(0);
            }
        }
    </style>
    <div class="modal-header p-0" style="position:relative;background:#384b5e">
        <div class="container p-0"
             style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
            <span class="supercell text-white pl-3" style="font-size:25px;">Topshiriq</span>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style="opacity: 5;position:absolute;top:8px;right:10px;">
            <img src="{{ asset('mobile/xclose.png') }}" width="30px">
        </button>
    </div>
    <div class="modal-body" style="
        background-image: url(/promo/dist/img/promo/bg2.png);
        border-radius: 0px 0px 19px 19px;
        padding: 20px;
     /*padding: 2rem !important;*/
        ">

            {{--        Oltin sut--}}
        @if($oltin_sut_topshiriq_name)
            @if($oltin_sut_topshiriq_javob && $oltin_sut_topshiriq_javob->status == 1)
                <div class="row align-items-center justify-content-center crystal" style="background-image: url(/images/jang_topshiriq/svg125.svg);
            background-size: cover;
            /*background-repeat: no-repeat;*/
            height: 58px;
            /*background-repeat: no-repeat;*/
            margin-bottom: 15px;
            ">
                    <div class="col-2" style=" text-align: center">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"  height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;">{{$oltin_sut_topshiriq_name->name}}</h6>
                        <svg width="200px" height="30">
                            <text y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>

                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;margin-bottom: 0 !important;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 12px;color: white;">
                        {{$oltin_sut_topshiriq_name->star}}
                    </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                        <span style="font-family: Supercell-Magic;font-size: 12px;color: white;">
                        {{$oltin_sut_crystall}}
                    </span>
                        <img src="{{asset('images/jang_topshiriq/crys.png')}}" width="15" alt="">
                        {{--                <img src="{{asset('images/jang_topshiriq/toj.svg')}}" height="30" alt="">--}}
                    </div>
                </div>
            @elseif($oltin_sut_topshiriq_javob && $oltin_sut_topshiriq_javob->status == 0)
                <div class="row align-items-center justify-content-center crystal" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);
                background-size: cover;height: 58px; margin-bottom: 15px;">
                    <div class="col-2" style="margin: auto;padding: 0 !important; text-align: center">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"  height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;">{{$oltin_sut_topshiriq_name->name}}</h6>
                        <svg width="280px" height="30">
                            <text y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;margin-bottom: 0 !important;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 12px;color: white;">
                            0
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                        <span style="font-family: Supercell-Magic;font-size: 12px;color: white;">
                            0
                        </span>
                        <img src="{{asset('images/jang_topshiriq/crys.png')}}" width="15" alt="">
                        {{--                <img src="{{asset('images/jang_topshiriq/toj.svg')}}" height="30" alt="">--}}
                    </div>
                </div>
            @else
                <div class="row align-items-center crystal" style="
                background-image: url(/images/jang_topshiriq/svg100.svg);
                justify-content: space-evenly;
                margin-bottom: 25px;
                background-size: cover;
                background-position: center;
                /*height: 102px;*/
                /* background-repeat: no-repeat; */
                /*width: 470px;*/
                filter: drop-shadow(0px 0px 20px yellow)
                ">
                    <div class="col-2" style="padding: 0 !important; text-align: center">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="
                        font-family: 'Supercell-Magic';
                        font-size: 10px;
                        text-align: center;
                        /*margin: 15px; */
                        color: #d6bbbb;">
                            {{$oltin_sut}} / {{$oltin_sut_topshiriq_name->number}}
                        </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="
                        font-family: Supercell-Magic; font-size: 12px;
                        color: white;
                        /*margin-bottom: 0 !important;*/
                        margin-top: 20px
                        ">{{$oltin_sut_topshiriq_name->name}}</h6>
                        <div >
                            <svg width="180" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
                                <foreignObject width="100%" height="100%">
                                    <i class="fas fa-stopwatch" style="color: white;font-size: 17px;float: left;margin-top: 6px;margin-left: 5px;"></i>
                                </foreignObject>
                                <text x="25" y="20" font-family="Supercell-Magic" font-size="13" fill="white" stroke="blue" stroke-width="1">
                                    {{$oltin_sut_date}}
                                </text>
                            </svg>
                        </div>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                            {{$oltin_sut_topshiriq_name->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                            {{$oltin_sut_crystall}}
                        </span>
                        <img src="{{asset('images/jang_topshiriq/crys.png')}}"  width="20"  alt="">
                        {{--                    <i class="fas fa-star" style="color: #fbb72c;"></i>--}}
                    </div>
                </div>
            @endif
        @else
        @endif

            {{--        End oltin sut--}}

            {{--        Suyak Komplex--}}
        @if($suyak_komplex_topshiriq_name)
            @if($suyak_komplex_topshiriq_javob && $suyak_komplex_topshiriq_javob->status ==1 )
                <div class="row align-items-center justify-content-center crystal2" style="background-image: url(/images/jang_topshiriq/svg125.svg);
            background-size: cover;
            height: 58px;
            /*background-repeat: no-repeat;*/
            margin-bottom: 15px;
            ">
                    <div class="col-2" style=" text-align: center">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"  height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;">{{$suyak_komplex_topshiriq_name->name}}</h6>
                        <svg width="200px" height="30">
                            <text y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>

                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;margin-bottom: 0 !important;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 12px;color: white;">
                        {{$suyak_komplex_topshiriq_name->star}}
                    </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                        <span style="font-family: Supercell-Magic;font-size: 12px;color: white;">
                        {{$suyak_komplex_crystall}}
                    </span>
                        <img src="{{asset('images/jang_topshiriq/crys.png')}}" width="15" alt="">
                    </div>
                </div>
            @elseif($suyak_komplex_topshiriq_javob && $suyak_komplex_topshiriq_javob->status == 0)
                <div class="row align-items-center justify-content-center crystal2" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);
                background-size: cover;height: 58px; margin-bottom: 15px; ">
                    <div class="col-2" style="margin: auto;padding: 0 !important; text-align: center">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"  height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;">{{$suyak_komplex_topshiriq_name->name}}</h6>
                        <svg width="280px" height="30">
                            <text y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;margin-bottom: 0 !important;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 12px;color: white;">
                            0
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                        <span style="font-family: Supercell-Magic;font-size: 12px;color: white;">
                            0
                        </span>
                        <img src="{{asset('images/jang_topshiriq/crys.png')}}" width="15" alt="">
                        {{--                <img src="{{asset('images/jang_topshiriq/toj.svg')}}" height="30" alt="">--}}
                    </div>
                </div>
            @else
                <div class="row align-items-center crystal2" style="
                background-image: url(/images/jang_topshiriq/svg100.svg);
                justify-content: space-evenly;
                margin-bottom: 25px;
                background-size: cover;
                background-position: center;
                filter: drop-shadow(0px 0px 20px yellow)
                /*height: 102px;*/
                /* background-repeat: no-repeat; */
                /*width: 470px;*/

                ">
                    <div class="col-2" style="padding: 0 !important; text-align: center">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">
                    {{$suyak_komplex}} / {{$suyak_komplex_topshiriq_name->number}}
                </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-top: 20px">{{$suyak_komplex_topshiriq_name->name}}</h6>
                        <div style="">
                            <svg width="180" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
                                <foreignObject width="100%" height="100%">
                                    <i class="fas fa-stopwatch" style="color: white;font-size: 17px;float: left;margin-top: 6px;margin-left: 5px;"></i>
                                </foreignObject>
                                <text x="25" y="20" font-family="Supercell-Magic" font-size="13" fill="white" stroke="blue" stroke-width="1">
                                    {{$suyak_komplex_date}}
                                </text>
                            </svg>
                        </div>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                            {{$suyak_komplex_topshiriq_name->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                            {{$suyak_komplex_crystall}}
                        </span>
                        <img src="{{asset('images/jang_topshiriq/crys.png')}}" width="20"  alt="">
                    </div>
                </div>
            @endif
        @else
        @endif

            {{--        End suyak komplex--}}

{{--        LMS         --}}
        @if($topshiriq_name)
            @if($topshiriq_javob && $topshiriq_javob->status == 1)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$topshiriq_name->name}}</h6>
                        <svg width="200px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        {{$topshiriq_name->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @elseif($topshiriq_javob && $topshiriq_javob->status == 0)
                <div class="row align-items-center justify-content-center" style="
                    background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                    height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$topshiriq_name->name}}</h6>
                        <svg width="250px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                            0
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @else
                <div class="row align-items-center " style="
                background-image: url(/images/jang_topshiriq/svg100.svg);
                justify-content: space-evenly;
                margin-top: 20px;
                background-size: cover;
                height: 102px;
                /*background-repeat: no-repeat;*/
                /*width: 470px;*/
                ">
                    <div class="col-2" style="padding: 0 !important;">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">
                        {{$result}} / {{$topshiriq_name->number}}
                    </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-bottom: 0 !important;margin-top: 20px">{{$topshiriq_name->name}}</h6>
                        <div style="margin-top: 15px;margin-bottom: 15px;">
                            <svg width="180" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
                                <foreignObject width="100%" height="100%">
                                    <i class="fas fa-stopwatch" style="color: white;font-size: 17px;float: left;margin-top: 6px;margin-left: 5px;"></i>
                                </foreignObject>
                                <text x="25" y="20" font-family="Supercell-Magic" font-size="13" fill="white" stroke="blue" stroke-width="1">
                                    {{$lms_date}}
                                </text>
                            </svg>
                        </div>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;margin-left: 9px">
                           {{$topshiriq_name->star}}
                       </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @endif
        @else
        @endif
{{--    END LMS    --}}

        {{--SMENA--}}
        @if($smena_topshiriq)
            @if($smena_topshiriq_javob && $smena_topshiriq_javob->status == 1)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$smena_topshiriq->name}}</h6>
                        <svg width="200px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        {{$smena_topshiriq->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @elseif($smena_topshiriq_javob && $smena_topshiriq_javob->status == 0)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$smena_topshiriq->name}}</h6>
                        <svg width="250px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        0
                    </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @else
                <div class="row align-items-center " style="
            background-image: url(/images/jang_topshiriq/svg100.svg);
            justify-content: space-evenly;
            margin-top: 20px;
            background-size: cover;
            height: 102px;
            /*background-repeat: no-repeat;*/
            /*width: 470px;*/
            ">
                    <div class="col-2" style="padding: 0 !important;">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">
                    {{$smena}} / {{$smena_topshiriq->number}}
                </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-bottom: 0 !important;margin-top: 20px">{{$smena_topshiriq->name}}</h6>
                        <div style="margin-top: 15px;margin-bottom: 15px;">
                            <svg width="180" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
                                <foreignObject width="100%" height="100%">
                                    <i class="fas fa-stopwatch" style="color: white;font-size: 17px;float: left;margin-top: 6px;margin-left: 5px;"></i>
                                </foreignObject>
                                <text x="25" y="20" font-family="Supercell-Magic" font-size="13" fill="white" stroke="blue" stroke-width="1">
                                    {{$smena_date}}
                                </text>
                            </svg>
                        </div>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;margin-left: 7px">
                       {{$smena_topshiriq->star}}
                   </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @endif
        @else
        @endif
        {{--END SMENA--}}

{{--        Savdo 300--}}
        @if($kombo_topshiriq_name)
            @if($kombo_topshiriq_javob && $kombo_topshiriq_javob->status == 1)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$kombo_topshiriq_name->name}}</h6>
                        <svg width="200px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        {{$kombo_topshiriq_name->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @elseif($kombo_topshiriq_javob && $kombo_topshiriq_javob->status == 0)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$kombo_topshiriq_name->name}}</h6>
                        <svg width="250px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                       0
                    </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @else
                <div class="row align-items-center " style="
            background-image: url(/images/jang_topshiriq/svg100.svg);
            justify-content: space-evenly;
            margin-top: 20px;
            background-size: cover;
            height: 102px;
            /*background-repeat: no-repeat;*/
            /*width: 470px;*/
            ">
                    <div class="col-2" style="padding: 0 !important;">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">
                    {{$kombo_sotuv}} / {{$kombo_topshiriq_name->number}}
                </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-bottom: 0 !important;margin-top: 20px">{{$kombo_topshiriq_name->name}}</h6>
                        <div style="margin-top: 15px;margin-bottom: 15px;">
                            <svg width="180" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
                                <foreignObject width="100%" height="100%">
                                    <i class="fas fa-stopwatch" style="color: white;font-size: 17px;float: left;margin-top: 6px;margin-left: 5px;"></i>
                                </foreignObject>
                                <text x="25" y="20" font-family="Supercell-Magic" font-size="13" fill="white" stroke="blue" stroke-width="1">
                                    {{$kombo_date}}
                                </text>
                            </svg>
                        </div>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;margin-left: 7px">{{$kombo_topshiriq_name->star}}</span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @endif
        @else
        @endif
        {{--        End Savdo 300--}}


{{--        Kombo Sotuv--}}
        @if($savdo_topshiriq_name)
            @if($savdo_topshiriq_javob && $savdo_topshiriq_javob->status == 1)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$savdo_topshiriq_name->name}}</h6>
                        <svg width="200px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        {{$savdo_topshiriq_name->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @elseif($savdo_topshiriq_javob && $savdo_topshiriq_javob->status == 0)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$savdo_topshiriq_name->name}}</h6>
                        <svg width="250px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                       0
                    </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @else
                <div class="row align-items-center " style="
            background-image: url(/images/jang_topshiriq/svg100.svg);
            justify-content: space-evenly;
            margin-top: 20px;
            background-size: cover;
            height: 102px;
            /*background-repeat: no-repeat;*/
            /*width: 470px;*/
            ">
                    <div class="col-2" style="padding: 0 !important;">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">
                    {{$savdo}} / {{$savdo_topshiriq_name->number}}
                </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-bottom: 0 !important;margin-top: 20px">{{$savdo_topshiriq_name->name}}</h6>
                        <div style="margin-top: 15px;margin-bottom: 15px;">
                            <svg width="180" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
                                <foreignObject width="100%" height="100%">
                                    <i class="fas fa-stopwatch" style="color: white;font-size: 17px;float: left;margin-top: 6px;margin-left: 5px;"></i>
                                </foreignObject>
                                <text x="25" y="20" font-family="Supercell-Magic" font-size="13" fill="white" stroke="blue" stroke-width="1">
                                    {{$savdo_date}}
                                </text>
                            </svg>
                        </div>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;margin-left: 7px">{{$savdo_topshiriq_name->star}}</span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @endif
        @else
        @endif
{{--        End Kombo Sotuv--}}

        {{--Birga bir jang--}}
        @if($birga_bir_topshiriq_name)
            @if($birga_bir_topshiriq_javob && $birga_bir_topshiriq_javob->status == 1)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$birga_bir_topshiriq_name->name}}</h6>
                        <svg width="200px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        {{$birga_bir_topshiriq_name->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @elseif($birga_bir_topshiriq_javob && $birga_bir_topshiriq_javob->status == 0)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$birga_bir_topshiriq_name->name}}</h6>
                        <svg width="250px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        0
                    </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @else
                <div class="row align-items-center " style="
            background-image: url(/images/jang_topshiriq/svg100.svg);
            justify-content: space-evenly;
            margin-top: 20px;
            background-size: cover;
            height: 102px;
            /*background-repeat: no-repeat;*/
            /*width: 470px;*/
            ">
                    <div class="col-2" style="padding: 0 !important;">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">
                    {{$birga_bir['win_count']}} / {{$birga_bir_topshiriq_name->number}}
                </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-bottom: 0 !important;margin-top: 20px">{{$birga_bir_topshiriq_name->name}}</h6>
                        {{--                    <div style="margin-top: 15px;margin-bottom: 15px;">--}}
                        {{--                        <svg width="180" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">--}}
                        {{--                            <foreignObject width="100%" height="100%">--}}
                        {{--                                <i class="fas fa-stopwatch" style="color: white;font-size: 17px;float: left;margin-top: 6px;margin-left: 5px;"></i>--}}
                        {{--                            </foreignObject>--}}
                        {{--                            <text x="25" y="20" font-family="Supercell-Magic" font-size="13" fill="white" stroke="blue" stroke-width="1">--}}
                        {{--                                {{$smena_date}}--}}
                        {{--                            </text>--}}
                        {{--                        </svg>--}}
                        {{--                    </div>--}}
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;margin-left: 7px">
                       {{$birga_bir_topshiriq_name->star}}
                   </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @endif
        @else
        @endif
        {{--END birga bir jang--}}

{{--        Oraliq Test --}}
        @if($oraliq_test_topshiriq_name)
            @if($oraliq_test_topshiriq_javob && $oraliq_test_topshiriq_javob->status == 1)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$oraliq_test_topshiriq_name->name}}</h6>
                        <svg width="200px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        {{$oraliq_test_topshiriq_name->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @elseif($oraliq_test_topshiriq_javob && $oraliq_test_topshiriq_javob->status == 0)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$oraliq_test_topshiriq_name->name}}</h6>
                        <svg width="250px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        0
                    </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @else
                <div class="row align-items-center " style="
            background-image: url(/images/jang_topshiriq/svg100.svg);
            justify-content: space-evenly;
            margin-top: 20px;
            background-size: cover;
            height: 102px;
            /*background-repeat: no-repeat;*/
            /*width: 470px;*/
            ">
                    <div class="col-2" style="padding: 0 !important;">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">
                             0 / {{$oraliq_test_topshiriq_name->number}}
                        </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-bottom: 0 !important;margin-top: 20px">{{$oraliq_test_topshiriq_name->name}}</h6>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;margin-left: 7px">
                            {{$oraliq_test_topshiriq_name->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @endif
        @else
        @endif
{{--        End Oraliq Test--}}

{{--        Plan Week--}}
        @if($plan_week)
            @if($plan_week && $plan_week->success == 1 && !$plan_week->success == null)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">Haftalik Plan</h6>
                        <svg width="200px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        {{$plan_week->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @elseif($plan_week && $plan_week->success == 0 && !$plan_week->success == null)
                <div class="row align-items-center justify-content-center" style="
                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;
                height: 58px; margin-top: 20px">
                    <div class="col-2">
                        <img src="{{asset('images/jang_topshiriq/error.svg')}}"   height="30" alt="">
                    </div>
                    <div class="col-8 text-center" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">Haftalik Plan</h6>
                        <svg width="250px" height="30">
                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarilmadi</text>
                        </svg>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: black;">Yutuq</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">
                        0
                    </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @else
                <div class="row align-items-center " style="
            background-image: url(/images/jang_topshiriq/svg100.svg);
            justify-content: space-evenly;
            margin-top: 20px;
            background-size: cover;
            height: 102px;
            /*background-repeat: no-repeat;*/
            /*width: 470px;*/
            ">
                    <div class="col-2" style="padding: 0 !important;">
                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">
                            Qilindi
                        </h5>
                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">
                             @if($pul_week){{$pul_week}}@else 0 @endif / {{$plan_week->plan_week}}
                        </span>
                    </div>
                    <div class="col-7" style="padding: 0 !important;text-align: center">
                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-bottom: 0 !important;margin-top: 20px">Haftalik Plan</h6>
                    </div>
                    <div class="col-2" style="padding: 0 !important;">
                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: white;text-align: center">Sovrin</h6>
                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;margin-left: 7px">
                            {{$plan_week->star}}
                        </span>
                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">
                    </div>
                </div>
            @endif
        @else
        @endif
{{--        End Plan Week--}}

{{--        Origin savdo--}}

{{--        @foreach($origin_savdo as $origin)--}}
{{--            @php--}}
{{--            $user_id = auth()->user()->id;--}}
{{--            $topshiriq = new LMSTopshiriq();--}}
{{--            $check = $topshiriq->origin_check($user_id,$origin->medicine_id,$origin->start_day,$origin->end_day)--}}
{{--            @endphp--}}
{{--            @if($origin && $origin->success == 1)--}}
{{--                <div class="row align-items-center justify-content-center" style="--}}
{{--                background-image: url(/images/jang_topshiriq/svg125.svg);background-size: cover;--}}
{{--                height: 58px; margin-top: 20px">--}}
{{--                    <div class="col-2">--}}
{{--                        <img src="{{asset('images/jang_topshiriq/correct.svg')}}"   height="30" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="col-8 text-center" style="padding: 0 !important;">--}}
{{--                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: #131313;margin-top: 10px">{{$origin->medicine_name}}</h6>--}}
{{--                        <svg width="200px" height="30">--}}
{{--                            <text x="0" y="15" font-family="Supercell-Magic" font-size="15" fill="white" stroke="#d6ba93" stroke-width="1">Topshiriq bajarildi</text>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                    <div class="col-2" style="padding: 0 !important;">--}}
{{--                        <h6 style="font-family: Supercell-Magic;font-size: 12px;color: black;">Yutuq</h6>--}}
{{--                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;">--}}
{{--                        {{$origin->elexir}}--}}
{{--                        </span>--}}
{{--                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <div class="row align-items-center " style="--}}
{{--            background-image: url(/images/jang_topshiriq/svg100.svg);--}}
{{--            justify-content: space-evenly;--}}
{{--            margin-top: 20px;--}}
{{--            background-size: cover;--}}
{{--            height: 102px;--}}
{{--            /*background-repeat: no-repeat;*/--}}
{{--            /*width: 470px;*/--}}
{{--            ">--}}
{{--                    <div class="col-2" style="padding: 0 !important;">--}}
{{--                        <h5 style="font-family: 'Supercell-Magic';font-size: 13px;color: #fff;margin-bottom: 0 !important;">--}}
{{--                            Qilindi--}}
{{--                        </h5>--}}
{{--                        <span style="font-family: 'Supercell-Magic'; font-size: 10px; text-align: center; color: #d6bbbb;">--}}
{{--                    {{$check}} / {{$origin->plan}}--}}
{{--                </span>--}}
{{--                    </div>--}}
{{--                    <div class="col-7" style="padding: 0 !important;text-align: center">--}}
{{--                        <h6 style="font-family: Supercell-Magic; font-size: 12px; color: white;margin-bottom: 0 !important;margin-top: 20px">Bir haftada {{$origin->plan}} ta {{$origin->medicine_name}} sotish</h6>--}}
{{--                        <div style="margin-top: 15px;margin-bottom: 15px;">--}}
{{--                            <svg width="180" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">--}}
{{--                                <foreignObject width="100%" height="100%">--}}
{{--                                    <i class="fas fa-stopwatch" style="color: white;font-size: 17px;float: left;margin-top: 6px;margin-left: 5px;"></i>--}}
{{--                                </foreignObject>--}}
{{--                                <text x="25" y="20" font-family="Supercell-Magic" font-size="13" fill="white" stroke="blue" stroke-width="1">--}}
{{--                                    {{$origin_date}}--}}
{{--                                </text>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-2" style="padding: 0 !important;">--}}
{{--                        <h6 style="font-family: Supercell-Magic;font-size: 13px;color: white;text-align: center">Sovrin</h6>--}}
{{--                        <span style="font-family: Supercell-Magic;font-size: 10px;color: white;margin-left: 7px">--}}
{{--                        {{$origin->elexir}}--}}
{{--                        </span>--}}
{{--                        <img src="{{ asset('mobile/turnir/topsh.png') }}" width="25" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endforeach--}}

{{--        End Origin Savdo--}}
    </div>
    </div>
</div>
