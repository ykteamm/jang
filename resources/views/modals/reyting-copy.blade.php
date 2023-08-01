<div class="modal fade" id="reyting" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                    <li class="nav-item active new-reyting-tab-active reyting-tab1 reyting-tab-class mr-2" onclick="changeReytingTab(1)">
                      <a class="supercel-text-stroke text-center align-items-center" id="home-tabw" data-toggle="tab" href="#homew" role="tab" aria-controls="homew" aria-selected="true">Sotuv</a>
                    </li>
                    <li class="nav-item new-reyting-tab reyting-tab2 reyting-tab-class" onclick="changeReytingTab(2)">
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

                            <div class="col-12  supercell">
                                <div class="card border-0 mb-1">
                                    <div class="card-body" class="pr-0" style="background-image: linear-gradient(to bottom,#867eb9,#5f5699,#474180);border-radius:9px;border:2px solid #342e5b;">
                                        <div class="row align-items-center">
                                            <div class="col-4 pr-0">
                                                <img src="{{asset('mobile/ligabronza.webp')}}" width="85%;">

                                            </div>
                                            <div class="col-8 pl-0" style="color:white;font-size:13px;">
                                                @php
                                                    $fff = [1,2,3];
                                                @endphp
                                                @foreach ($fff as $key => $item)
                                                    <p class="m-1" style="border-bottom:1px solid white;">{{($key+1).')'}} Salomova S
                                                        <span class="ml-2">
                                                    <img src="{{asset('mobile/oltin.png')}}" width="23px;">

                                                            3M</span>
                                                    </p>
                                                @endforeach
                                                {{-- <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                   <span style="font-size:11px;">3232323</span>
                                                </button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach (daySold() as $key => $item)
                            @php
                                if ($key == 0) { $color = 'ecbb07'; }
                                if ($key ==1) { $color = 'abb3bf'; }
                                if ($key == 2) { $color = 'ce8d58'; }
                                if (!in_array($key,[0,1,2])) { $color = 'c1c4b9'; }
                            @endphp
                                <div class="col-12  supercell">
                                    <div class="card border-0 mb-1">
                                        <div class="card-body" class="pr-0" style="background: #cacdc4;border-radius:15px;">
                                            <div class="row align-items-center">
                                                <div class="col-2 pl-2">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #{{$color}};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);width: 40px;height: 40px;">
                                                        {{$key+1}}
                                                    </button>
                                                </div>
                                                <div class="col-6 pr-0" style="border-left:1px solid #959690">
                                                    <span class="mb-1" style="color: #272730;font-size:12px">{{$item->first_name}} {{substr($item->last_name,0,1)}}</span>
                                                    <p style="color: #272730;font-size:10px;color:#6c757d;">
                                                        {{setRegionTosh($item->t)}}
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                                       {{-- <span style="font-size:11px;">{{number_format($item->allprice,0,',',' ')}}</span> --}}
                                                       <span style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;">2M</span>
                                                    <img src="{{asset('mobile/oltin.png')}}" width="23px;" style="filter: drop-shadow(0px 0px 2px black);">

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profilew" role="tabpanel" aria-labelledby="profile-tabw" style="background: #677e97">
                        <div class="mb-3 pt-3">
                            @foreach (kuboks() as $key => $item)
                             @php
                                if ($key == 0) { $color = 'e0aa2c'; }
                                if ($key ==1) { $color = 'bdccdb'; }
                                if ($key == 2) { $color = 'cc8448'; }
                                if (!in_array($key,[0,1,2])) { $color = '8d9eb8'; }
                            @endphp
                                <div class="col-12  supercell">
                                    <div class="card border-0 mb-1">
                                        <div class="card-body" class="pr-0" style="background:  @if($item->user->id == Auth::id()) #a6e693 @else #c8d7ec @endif;border-radius:15px;">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #{{$color}};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        {{$key+1}}
                                                    </button>
                                                </div>
                                                <div class="col-5 pr-0">
                                                    <span class="mb-1" style="color: #272730;font-size:12px">{{$item->user->first_name}} {{substr($item->user->last_name,0,1)}}</span>
                                                </div>
                                                <div class="col-2 pl-0 pr-1 text-right">
                                                    <img src="{{asset('mobile/kb.png')}}" width="23px;">
                                                </div>
                                                <div class="col-3 pl-0 text-left">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        {{$item->ball}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile2w" role="tabpanel" aria-labelledby="profile-tab2w" style="background: #677e97">
                        <div class="mb-3 pt-3">
                            @foreach (regionSold() as $key => $item)
                            @php
                                if ($key == 0) { $color = 'e0aa2c'; }
                                if ($key ==1) { $color = 'bdccdb'; }
                                if ($key == 2) { $color = 'cc8448'; }
                                if (!in_array($key,[0,1,2])) { $color = '8d9eb8'; }
                            @endphp
                                <div class="col-12  supercell">
                                    <div class="card border-0 mb-1">
                                        <div class="card-body" class="pr-0" style="background: #c8d7ec ;border-radius:15px;">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #{{$color}};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        {{$key+1}}
                                                    </button>
                                                </div>
                                                <div class="col-4 p-0">
                                                    @if (regionStrikeDay()[0] != $item['id'] && regionStrikeDayBad()[0] != $item['id'])
                                                        <span class="mb-1" style="color: #272730;font-size:13px">
                                                            {{setRegionTosh($item['name'])}}

                                                        </span>
                                                    @else
                                                        @if(regionStrikeDay()[0] == $item['id'])
                                                        <span class="mb-1" style="color: #272730;font-size:13px">
                                                            {{setRegionTosh($item['name'])}}

                                                            <button type="button" class="btn btn-sm btn-secondary supercell" style="font-size:11px;background: #12a80f8a;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                                <span>Strike + {{count(regionStrikeDay())}}
                                                                    <span style="font-size:20px;">🔥</span>
                                                                </span>
                                                            </button>
                                                        </span>
                                                        @endif
                                                        @if(regionStrikeDayBad()[0] == $item['id'])
                                                        <span class="mb-1" style="color: #272730;font-size:13px">
                                                            {{setRegionTosh($item['name'])}}
                                                            <button type="button" class="btn btn-sm btn-secondary supercell" style="font-size:11px;background: #de14148a;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                                <span>Strike - {{count(regionStrikeDayBad())}}
                                                                    <span style="font-size:13px;">💩</span>
                                                                </span>
                                                            </button>
                                                        </span>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="col-2 pr-1 pl-0 text-right">
                                                    <img src="{{asset('mobile/oltin.png')}}" width="23px;">
                                                </div>
                                                <div class="col-4 pl-0 text-left">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="font-size:13px;background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        {{-- {{number_format($item->allprice,0,',',' ')}}</span> --}}
                                                       <span style="font-size:10px;">{{number_format($item['allprice'],0,',',' ')}}</span>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
