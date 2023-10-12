<div class="modal fade" id="turnir" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
            
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
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="allNews"
            style="opacity: 5;position:absolute;top:8px;right:10px;z-index:20">
            <img src="{{ asset('mobile/news/close.png') }}" width="30px">
        </button>
        <div class="supercell d-flex align-items-center justify-content-center"
            style="position:absolute;top:0px;left:0;right:0;font-size:22px">
            <div class="pl-4 text-white pt-2"
                style="text-shadow: -1px 4px 0 #000, 3px 1px 0 #000, 3px -1px 0 #000, -1px -1px 0 #000">
                Turnir</div>
        </div> --}}
        <div class="container p-0"
            style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
            <span class="supercell text-white pl-3" style="font-size:25px;">G'OLIBLAR SAROYI</span>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="opacity: 5;position:absolute;top:8px;right:10px;">
            <img src="{{ asset('mobile/xclose.png') }}" width="30px">
        </button>
        {{-- <div style="position: absolute; bottom:3px;left:0;right:0">
            <ul class="mx-1 navbar-nav flex-row align-items-center justify-content-around">
                <li onclick="changeTab1()" id="turnirTab1" class="nav-item news-menu-item active">
                    <a class="nav-link p-0 text-white supercell" href="#">Jadval</a>
                </li>
                <li onclick="changeTab2()" id="turnirTab2" class="nav-item news-menu-item">
                    <a class="nav-link p-0 text-white supercell" href="#">Janglar</a>
                </li>
            </ul>
        </div> --}}
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
    <div id="turnir2tab" class="modal-body p-0 d-none">
        
    </div>
    <div id="turnir1tab" class="modal-body p-0">

        <div class="col-12 mb-3">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/turnir-desc.jpg') }}">
        </div>

        {{-- <div class="container p-0 text-center"
            style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
            <span class="supercell text-white pl-3" style="font-size:25px;">TURNIR 2</span>
        </div> --}}

        <div class="card m-3" style="background: linear-gradient(45deg, #416d69, transparent);">

            <div class="col-12 mb-3">
                <img width="100%" style="margin-top:15px;border-radius:10px;" src="{{ asset('mobile/turnir/xadicha.jpg') }}">
            </div>

            @php    
                $arrs1[0] = ['Xadicha N','Qizlarxon T'];
                $arrs1[1] = ['Komola I',''];
                $arrs1[2] = ['Mohigul B','Aziza N'];

                $arrs1s[0] = ['2222','2222'];
                $arrs1s[1] = ['600','600'];
                $arrs1s[2] = ['400','400'];

                $arrs12[0] = ['Gulzar K','Gulnoza T'];
                $arrs12[2] = ['Xadicha N','Aziza N'];
                $arrs12[1] = ['Marhabo G',''];

                $arrs12s[0] = ['1200','1200'];
                $arrs12s[1] = ['600','600'];
                $arrs12s[2] = ['400','400'];
            @endphp

            @foreach ($arrs1 as $key => $item)
                
                <div class="col-12 mb-2">
                    <div class="card border-0 mb-1">
                        <div class="card-body" style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                            <div class="row align-items-center pr-3">
                                <div class="col-2 pl-2">
                                    <button type="button" class="btn-sm btn-secondary supercell p-0" 
                                    @if ($key == 0)
                                        style="-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#f3e48d,#ffd20f,#c39008);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fff0a8;;width: 45px;height: 35px;"
                                    @elseif($key == 1)
                                    style="-webkit-text-stroke: 1px #36393a !important;
                                    background-image: linear-gradient(to bottom left,#a1aab8,#d4d9e0,#767c81);
                                    border: 1px solid #c8b7b7;
                                    box-shadow: 0px 0px 0px 2px #e7eae8;
                                    width: 45px;
                                    height: 35px;"
                                    @else
                                        style="    -webkit-text-stroke: 1px #36393a !important;
                                        background-image: linear-gradient(to bottom left,#c7854d,#d89d6e,#946c48);
                                        border: 1px solid #c8b7b7;
                                        box-shadow: 0px 0px 0px 2px #fbe2c4;
                                        width: 45px;
                                        height: 35px;"
                                    @endif
                                    >
                                            <span style="font-size: 16px;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                            {{$key+1}}</span>
                                    </button>
                                </div>
                                {{-- <div class="col-1 text-center p-0" style="border-left:1px solid #959690">
                                    <img style="width:40px;padding-left:4px" src="http://127.0.0.1:8000/mobile/regions/11.png" alt="">
                                </div> --}}
                                <div class="col-4 pr-0 pl-3">
                                    {{-- <span class="mb-1 supercell" style="color: #272730;font-size:12px">
                                        {{$item[0]}}
                                        {{$item[1]}}
                                    </span> --}}

                                    <span class="mb-1 supercell"
                                            style="color: #272730;font-size:11px">
                                            {{$item[0]}}
                                        </span>
                                        <p style="color: #272730;font-size:11px;color:#272730;" class="supercell">
                                            {{$item[1]}}
                                        </p>
                                </div>
                                {{-- <div class="col-2 text-center p-0" style="padding-right: 4px !important;">
                                    <div style="font-size:12px;font-weight:600">Elchilar</div>
                                    <div style="font-size:15px;font-weight:800">15</div>
                                </div> --}}
                                <div class="col-3 p-0" style="padding-left: 4px !important;">
                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                        <div class="d-flex align-items-center">
                                            <span style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                                                                            {{$arrs1s[$key][0]}}
                                                                                                    </span>
                                            <img src="{{asset('mobile/crys.png')}}" width="23px;" style="padding-left:3px">
                                        </div>
                                    </button>
                                </div>
                                <div class="col-3 p-0" style="padding-left: 4px !important;">
                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                        <div class="d-flex align-items-center">
                                            <span style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                {{$arrs1s[$key][1]}}
                                                                                                            
                                                                                                    </span>
                                            <img src="{{asset('mobile/kb.png')}}" width="23px;" style="padding-left:3px">
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        
        </div>

        <div class="card m-3" style="background: linear-gradient(45deg, #ef9d19, transparent);">
        
            <div class="col-12 mb-3">
                <img width="100%" style="margin-top:15px;border-radius:10px;" src="{{ asset('mobile/turnir/gulzar.jpg') }}">
            </div>

            

            @foreach ($arrs12 as $key => $item)
                
                <div class="col-12">
                    <div class="card border-0 mb-1">
                        <div class="card-body" style="background-image: linear-gradient(to bottom,#ced0c6,#d9dbd5,#c7c9c1);border-radius: 7px;border: 1px solid #9c9191;">
                            <div class="row align-items-center pr-3">
                                <div class="col-2 pl-2">
                                    <button type="button" class="btn-sm btn-secondary supercell p-0" 
                                    @if ($key == 0)
                                        style="-webkit-text-stroke: 1px #36393a !important;background-image: linear-gradient(to bottom left,#f3e48d,#ffd20f,#c39008);border: 1px solid #c8b7b7;box-shadow: 0px 0px 0px 2px #fff0a8;;width: 45px;height: 35px;"
                                    @elseif($key == 1)
                                    style="-webkit-text-stroke: 1px #36393a !important;
                                    background-image: linear-gradient(to bottom left,#a1aab8,#d4d9e0,#767c81);
                                    border: 1px solid #c8b7b7;
                                    box-shadow: 0px 0px 0px 2px #e7eae8;
                                    width: 45px;
                                    height: 35px;"
                                    @else
                                        style="    -webkit-text-stroke: 1px #36393a !important;
                                        background-image: linear-gradient(to bottom left,#c7854d,#d89d6e,#946c48);
                                        border: 1px solid #c8b7b7;
                                        box-shadow: 0px 0px 0px 2px #fbe2c4;
                                        width: 45px;
                                        height: 35px;"
                                    @endif
                                    >
                                            <span style="font-size: 16px;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                            {{$key+1}}</span>
                                    </button>
                                </div>
                                {{-- <div class="col-1 text-center p-0" style="border-left:1px solid #959690">
                                    <img style="width:40px;padding-left:4px" src="http://127.0.0.1:8000/mobile/regions/11.png" alt="">
                                </div> --}}
                                <div class="col-4 pr-0 pl-3">
                                    {{-- <span class="mb-1 supercell" style="color: #272730;font-size:12px">
                                        {{$item[0]}}
                                        {{$item[1]}}
                                    </span> --}}

                                    <span class="mb-1 supercell"
                                            style="color: #272730;font-size:11px">
                                            {{$item[0]}}
                                        </span>
                                        <p style="color: #272730;font-size:11px;color:#272730;" class="supercell">
                                            {{$item[1]}}
                                        </p>
                                </div>
                                {{-- <div class="col-2 text-center p-0" style="padding-right: 4px !important;">
                                    <div style="font-size:12px;font-weight:600">Elchilar</div>
                                    <div style="font-size:15px;font-weight:800">15</div>
                                </div> --}}
                                <div class="col-3 p-0" style="padding-left: 4px !important;">
                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                        <div class="d-flex align-items-center">
                                            <span style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                                                                            {{$arrs12s[$key][0]}}
                                                                                                    </span>
                                            <img src="{{asset('mobile/crys.png')}}" width="23px;" style="padding-left:3px">
                                        </div>
                                    </button>
                                </div>
                                <div class="col-3 p-0" style="padding-left: 4px !important;">
                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                        <div class="d-flex align-items-center">
                                            <span style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                {{$arrs12s[$key][1]}}
                                                                                                            
                                                                                                    </span>
                                            <img src="{{asset('mobile/kb.png')}}" width="23px;" style="padding-left:3px">
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>


        {{-- <div class="col-12 mb-3">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/slavi2.webp') }}">
        </div> --}}
        <div>
    </div>
    </div>
</div>

    </div>
</div>