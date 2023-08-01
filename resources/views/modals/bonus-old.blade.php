<div class="modal fade" id="bonus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background: #9db2bf;">
            <div class="modal-header p-0 pb-4" style="background: #a4adb8">
                <div class="container p-0" style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
                    <span class="supercell text-white pl-3" style="font-size:25px;">MARKET</span>
                </div>
                {{-- <img src="{{asset('mobile/ks.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative"> --}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                                <img src="{{asset('mobile/xclose.png')}}" width="30px">
                            </button>
            </div>
            <div class="modal-body p-0">
                {{-- <div class="container">
                    <img src="{{asset('mobile/intop.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
                </div> --}}
                <div class="container p-0">
                
                    <ul class="nav nav-tabs mr-2 ml-2" id="myTab" role="tablist">
                        <li class="nav-item active reyting-tab-active23 reyting-tab1 reyting-tab-class23" onclick="changeReytingTab23(1)">
                          <a class="supercel-text-stroke text-center align-items-center" id="home-tabw223" data-toggle="tab" href="#homew223" role="tab" aria-controls="homew223" aria-selected="true">Ichki Market</a>
                        </li>
                        {{-- <li class="nav-item reyting-tab reyting-tab2 reyting-tab-class23" onclick="changeReytingTab23(2)">
                          <a class="supercel-text-stroke text-center align-items-center" id="profile-tabw223" data-toggle="tab" href="#profilew223" role="tab" aria-controls="profilew223" aria-selected="false">Tashqi Market</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
    
                        <div class="tab-pane fade show active" id="homew223" role="tabpanel" aria-labelledby="home-tabw223" style="background: #677e97">
                            <div class="m-1 p-3">
                                <div class="row">
                                    @foreach ($producte as $item)
                                    <div class="col-6">
                                        <div class="card border-0 mb-1 overflow-hidden" >
                                            <div class="card-header" style="border:2px solid rgb(202, 215, 26);background:rgb(91, 91, 243)">
                                                <p class="mb-1 supercell" style="font-size:11px;color: white">{{$item->name}}</p>
                                                <div class="text-center mb-1">
                                                    <img src="{{asset('product/'. $item->img)}}" width="100px" alt="">
                                                </div>
                                                <div class="text-center">
                                                    {{-- <a type="button" href="{{route('shop',$item->id)}}" class="btn" style="background: #5e9ff2;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;">
                                                        {{number_format($item->elixir,0,',',' ')}} <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px">
                                                    </a> --}}
                                                    <span class="btn" style="background: #5e9ff2;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;">
                                                        {{number_format($item->elixir,0,',',' ')}} <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px">
                                                    </span>
                                                </div>
                                            </div>
                                            {{-- <div class="card-body h-150 position-relative">
                                                <a href="#" class="background">
                                                    <img src="{{asset('product/'. $item->img)}}" alt="">
                                                </a>
                                            </div> --}}
                                            {{-- <div class="card-body ">
                                                <a type="button" href="{{route('shop',$item->id)}}" class="btn" style="background: #d9e6f7;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;-webkit-text-stroke: 1px #040c10">
                                                    {{number_format($item->elixir,0,',',' ')}} <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px">
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
    
                        </div>
                        {{-- <div class="tab-pane fade" id="profilew223" role="tabpanel" aria-labelledby="profile-223" style="background: #677e97">
                            
                            <div class="text-center supercell text-white pt-2" ><img src="{{asset('mobile/cristal234.png')}}" width="20px"> Crystal : 369</div>

                            <div class="m-1 p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card border-0 mb-1 overflow-hidden" >
                                            <div class="card-header" style="border:2px solid rgb(95, 199, 77);background:#393c60ad">
                                                <p class="mb-1 supercell" style="font-size:11px;color: white">Umraga 2ta chipta</p>
                                                <div class="text-center mb-1">
                                                    <img src="{{asset('mobile/tmumra.png')}}" width="100px" height="100px" alt="">
                                                </div>
                                                <div class="text-center">
                                                    <span class="btn" style="background: #5e9ff2;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;">
                                                        13500 <img src="{{asset('mobile/cristal234.png')}}" width="20px">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card border-0 mb-1 overflow-hidden" >
                                            <div class="card-header" style="border:2px solid rgb(95, 199, 77);background:#393c60ad">
                                                <p class="mb-1 supercell" style="font-size:11px;color: white">Dubayga sayohat</p>
                                                <div class="text-center mb-1">
                                                    <img src="{{asset('mobile/tmdubay.png')}}" width="100px" height="100px" alt="">
                                                </div>
                                                <div class="text-center">
                                                    <span class="btn" style="background: #5e9ff2;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;">
                                                        4900 <img src="{{asset('mobile/cristal234.png')}}" width="20px">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card border-0 mb-1 overflow-hidden" >
                                            <div class="card-header" style="border:2px solid rgb(95, 199, 77);background:#393c60ad">
                                                <p class="mb-1 supercell" style="font-size:11px;color: white">Turkiyaga sayohat</p>
                                                <div class="text-center mb-1">
                                                    <img src="{{asset('mobile/tmturkey.png')}}" width="100px" height="100px" alt="">
                                                </div>
                                                <div class="text-center">
                                                    <span class="btn" style="background: #5e9ff2;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;">
                                                        4000 <img src="{{asset('mobile/cristal234.png')}}" width="20px">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card border-0 mb-1 overflow-hidden" >
                                            <div class="card-header" style="border:2px solid rgb(95, 199, 77);background:#393c60ad">
                                                <p class="mb-1 supercell" style="font-size:11px;color: white">Misrga 1ta chipta</p>
                                                <div class="text-center mb-1">
                                                    <img src="{{asset('mobile/tmmisr.png')}}" width="100px" height="100px" alt="">
                                                </div>
                                                <div class="text-center">
                                                    <span class="btn" style="background: #5e9ff2;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;">
                                                        5200 <img src="{{asset('mobile/cristal234.png')}}" width="20px">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card border-0 mb-1 overflow-hidden" >
                                            <div class="card-header" style="border:2px solid rgb(95, 199, 77);background:#393c60ad">
                                                <p class="mb-1 supercell" style="font-size:11px;color: white">Iphone 13 Pro Max</p>
                                                <div class="text-center mb-1">
                                                    <img src="{{asset('mobile/tmiphone.png')}}" width="100px" height="100px" alt="">
                                                </div>
                                                <div class="text-center">
                                                    <span class="btn" style="background: #5e9ff2;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;">
                                                        3000 <img src="{{asset('mobile/cristal234.png')}}" width="20px">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card border-0 mb-1 overflow-hidden" >
                                            <div class="card-header" style="border:2px solid rgb(95, 199, 77);background:#393c60ad">
                                                <p class="mb-1 supercell" style="font-size:11px;color: white">Samsung S22 Ultra</p>
                                                <div class="text-center mb-1">
                                                    <img src="{{asset('mobile/tmsamsung.png')}}" width="100px" height="100px" alt="">
                                                </div>
                                                <div class="text-center">
                                                    <span class="btn" style="background: #5e9ff2;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;">
                                                        3200 <img src="{{asset('mobile/cristal234.png')}}" width="20px">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                {{-- <p class="mb-0 text-center">
                    <button class="btn btn-primary supercell" type="button">
                        Ichki market
                    </button>
                    <button class="btn btn-primary supercell" type="button">
                        Tashqi market
                    </button>
                </p> --}}
                

            </div>
        </div>
    </div>
</div>
