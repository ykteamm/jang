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
     /*padding: 2rem !important;*/
        ">

            {{--        Oltin sut--}}
            @if($oltin_sut_topshiriq_javob && $oltin_sut_topshiriq_javob->status == 1)
            <div class="row align-items-center justify-content-center" style="background-image: url(/images/jang_topshiriq/svg125.svg);
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
                <div class="row align-items-center justify-content-center" style="
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
                <div class="row align-items-center" style="
                background-image: url(/images/jang_topshiriq/svg100.svg);
                justify-content: space-evenly;
                /*margin-bottom: 15px;*/
                background-size: cover;
                height: 102px;
                /*background-repeat: no-repeat;*/
                /*width: 470px;*/
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
                            <svg width="150" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
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
                        <img src="{{asset('images/jang_topshiriq/crys.png')}}" width="20"  alt="">
                        {{--                    <i class="fas fa-star" style="color: #fbb72c;"></i>--}}
                    </div>
                </div>
            @endif
            {{--        End oltin sut--}}

            {{--        Suyak Komplex--}}
            @if($suyak_komplex_topshiriq_javob && $suyak_komplex_topshiriq_javob->status ==1 )
            <div class="row align-items-center justify-content-center" style="background-image: url(/images/jang_topshiriq/svg125.svg);
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
            <div class="row align-items-center justify-content-center" style="
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
                <div class="row align-items-center " style="
                background-image: url(/images/jang_topshiriq/svg100.svg);
                justify-content: space-evenly;
                /*margin-bottom: 15px;*/
                background-size: cover;
                height: 102px;
                /*background-repeat: no-repeat;*/
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
                            <svg width="150" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
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
            {{--        End suyak komplex--}}

{{--        LMS         --}}
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
                            <svg width="150" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
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
{{--    END LMS    --}}

        {{--SMENA--}}
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
                        {{$smena_topshiriq->star}}
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
                        <svg width="150" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
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
        {{--END SMENA--}}

{{--        Savdo 300--}}
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
                        <svg width="150" height="35" style="background: #0c60ac; border-radius: 8px; padding: 6px;">
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
        {{--        End Savdo 300--}}

    </div>
    </div>
</div>
