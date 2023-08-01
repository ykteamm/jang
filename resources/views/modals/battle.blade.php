<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content" style="background: #5f687c;">
            <div class="modal-header">
                <img src="{{asset('mobile/jr.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                                <img src="{{asset('mobile/xclose.png')}}" width="30px">
                            </button>
                <button style="position: absolute;top:11px;left:0px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
                    type="button" class="rounded d-flex align-items-center justify-content-center"
                    data-toggle="popover" title="Natijalar"
                    data-content="Natijalar tarixi"
                    data-placement="left">
                    <img width="20" class="instruksiya" src="{{ asset('mobile/instruksiya.png') }}" alt="Instruksiya">
                </button>
            </div>
            <div class="modal-body p-0">
                <div style="background: #e1edf1;border-radius:15px;" class="m-1 pt-3 pb-3">
                    @isset($all_battle)
                        @foreach ($all_battle as $item)
                        @php
                                        if($item->u1id == Auth::user()->id)
                                            {
                                                if($item->win == Auth::user()->id)
                                                    {
                                                        $sum1 = $item->ball1;
                                                        $sum2 = -1*$item->ball2;
                                                    }else{
                                                        $sum1 = -1*$item->ball2;
                                                        $sum2 = $item->ball1;
                                                    }
                                            }else{
                                                if($item->win == Auth::user()->id)
                                                    {
                                                        $sum1 =  $item->ball2;
                                                        $sum2 =  -1*$item->ball1;
                                                    }else{
                                                        $sum1 = -1*$item->ball2;
                                                        $sum2 =  $item->ball1;
                                                    }
                                            }
                                        $prices1 = 0;
                                        $prices2 = 0;
                                            foreach($item->battle_elchi as $b)
                                            {
                                                if($b->u1id == Auth::user()->id)
                                                {
                                                    $prices1 = $prices1 + $b->sold1;
                                                    $prices2 = $prices2 + $b->sold2;
                                                }else{
                                                    $prices1 = $prices1 + $b->sold2;
                                                    $prices2 = $prices2 + $b->sold1;
                                                }
                                            }
                        @endphp
                        <div class="mb-3">
                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="card-body" style="background: #898989;border-radius:15px;padding:20px;padding-bottom:5px !important;padding-top:5px !important">
                                        
                                        <div class="row  supercell" style="background: #ffffff;border-radius:15px;">
                                            <div class="row supercell ml-0 mr-0 pl-2 pr-2 pt-1 pb-0" style="font-size:10px;background: #e8b331;border-top-left-radius:15px;border-top-right-radius:15px;width:100%;height:3.4em;">
                                                <div class="col pl-0">
                                                    <h6 class="subtitle mb-3" >
                                                        @if (strtotime($item->start_day) <= strtotime(date('Y-m-d')) && strtotime($item->end_day) >= strtotime(date('Y-m-d')))
                                                            <span style="-webkit-text-stroke: 1px #040c10;color:#0bc22a;">HOZIR</span>
                                                        @elseif(strtotime($item->start_day) > strtotime(date('Y-m-d')))
                                                            <span style="-webkit-text-stroke: 1px #040c10;color:#0c08fe;">KEYINGI</span>
                                                        @else
                                                            @if ($sum1 > $sum2)
                                                            <span style="-webkit-text-stroke: 1px #040c10;color:#60adff;">G'OLIB</span>
                                                            @elseif($sum1 < $sum2)
                                                            <span style="-webkit-text-stroke: 1px #040c10;color:#f56774">MAG'LUB</span>
                                                            @else
                                                            <span style="-webkit-text-stroke: 1px #040c10;color:#0bc22a;">DURRANG</span>
                                                            @endif
                                                        @endif
                                                        
                                                    </h6>
                                                </div>
                                                <div class="col-auto pr-0"><a href="" style="font-size:13px;-webkit-text-stroke: 1px #363b3d;color:#ffffff;">{{date('d.m',strtotime($item->start_day))}} - {{date('d.m',strtotime($item->end_day))}}</a></div>
                                            </div>  
                                            {{-- <div class="pl-2 pr-2 pb-2"> --}}
                                            <div class="col-5 mt-2">
                                                    <div class="rounded-circle mb-1 bg-default-light text-default" style="width: 85px">
                                                        @if (Auth::user()->id == $item->u1ids->id)
                                                            @if (isset($item->u1ids->image_url))
                                                            <img src="{{$item->u1ids->image_url}}" height="85px" alt="" style="border-radius: 50%;">
                                                            @else
                                                            <img src="https://api.multiavatar.com/kathrin.svg" height="85px" alt="">
                                                            @endif
                                                        @else
                                                            @if (isset($item->u2ids->image_url))
                                                            <img src="{{$item->u2ids->image_url}}" height="85px" alt="" style="border-radius: 50%;">
                                                            @else
                                                            <img src="https://api.multiavatar.com/kathrin.svg" height="85px" alt="">
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <p class="text-dark mb-1" style="font-size:14px;">
                                                        @if (Auth::user()->id == $item->u1ids->id)
                                                        {{$item->u1ids->first_name}} {{substr($item->u1ids->last_name,0,1)}}
                                                        @else
                                                            {{$item->u2ids->first_name}} {{substr($item->u2ids->last_name,0,1)}}
                                                        @endif
                                                    </p>
                                                    <button style="font-size:11px;background: #0c2237;" class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                        {{number_format($prices1,0,'',' ')}}
                                                    </button>
                                                    @if (strtotime($item->start_day) <= strtotime(date('Y-m-d')) && strtotime($item->end_day) >= strtotime(date('Y-m-d')))
                                                            {{-- <span style="-webkit-text-stroke: 1px #040c10;color:#78a9dd;">HOZIR</span> --}}
                                                            @elseif(strtotime($item->start_day) > strtotime(date('Y-m-d')))
                                                    
                                                            @else
                                                    <div>

                                                        <img src="{{asset('mobile/kb.png')}}" width="23px">

                                                        @if ($sum1 > 0)
                                                        <span style="font-size:14px;-webkit-text-stroke: 1px #040c10;color:#60adff;">+{{$sum1}}</span>
                                                        @else
                                                            <span style="font-size:14px;-webkit-text-stroke: 1px #040c10;color:#f56774">{{$sum1}}</span>
                                                        @endif
                                                    </div>
                                                    @endif
                                                        @if (Auth::user()->id == $item->u1ids->id)
                                                            @php
                                                                $ele = getBattleElexir($item->u1ids->id,$item->start_day,$item->end_day);
                                                            @endphp
                                                            @if (count($ele) > 0)
                                                            <div>
                                                                <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="23px">
                                                                <span style="font-size:14px;-webkit-text-stroke: 1px #040c10;color:#60adff;">+{{$ele[0]->elexir}}</span>
                                                            </div>
                                                            @endif
                                                        @else
                                                            @php
                                                            $ele = getBattleElexir($item->u2ids->id,$item->start_day,$item->end_day);
                                                            @endphp
                                                            @if (count($ele) > 0)
                                                            <div>
                                                                <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="23px">
                                                                <span style="font-size:14px;-webkit-text-stroke: 1px #040c10;color:#60adff;">+{{$ele[0]->elexir}}</span>
                                                            </div>
                                                            @endif
                                                        @endif
                                                </div>
                                                <div class="col-2 col-md-2 text-center pt-4 mt-2" style="padding-left: 31px !important">
                                                    <img src="{{asset('mobile/vs.png')}}" width="50px" style="border-radius:15px;margin-left: -28px;margin-top:-5px;">
                                                </div>
                                                <div class="col-5 text-right mt-2">
                                                    <div class="rounded-circle mb-1 bg-default-light text-default" style="width: 85px;margin-left:1.5em !important">
                                                        @if (Auth::user()->id != $item->u1ids->id)
                                                            @if (isset($item->u1ids->image_url))
                                                            <img src="{{$item->u1ids->image_url}}" height="85px" alt="" style="border-radius: 50%;">
                                                            @else
                                                            <img src="https://api.multiavatar.com/kathrin.svg" height="85px" alt="">
                                                            @endif
                                                        @else
                                                            @if (isset($item->u2ids->image_url))
                                                            <img src="{{$item->u2ids->image_url}}" height="85px" alt="" style="border-radius: 50%;">
                                                            @else
                                                            <img src="https://api.multiavatar.com/kathrin.svg" height="85px" alt="">
                                                            @endif
                                                        @endif
                                                    </div>
                                                        <p class="text-dark mb-1" style="font-size:14px;">
                                                            @if (Auth::user()->id != $item->u1ids->id)
                                                                {{$item->u1ids->first_name}} {{substr($item->u1ids->last_name,0,1)}}
                                                            @else
                                                                {{$item->u2ids->first_name}} {{substr($item->u2ids->last_name,0,1)}}
                                                            @endif
                                                        </p>
                                                    <button style="font-size:11px;background: #0c2237;" class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                        {{number_format($prices2,0,'',' ')}}
                                                    </button>
                                                    @if (strtotime($item->start_day) <= strtotime(date('Y-m-d')) && strtotime($item->end_day) >= strtotime(date('Y-m-d')))
                                                    {{-- <span style="-webkit-text-stroke: 1px #040c10;color:#78a9dd;">HOZIR</span> --}}
                                                    @elseif(strtotime($item->start_day) > strtotime(date('Y-m-d')))

                                                    @else
                                                        <div>

                                                        @if ($sum2 > 0)
                                                        <span style="font-size:14px;-webkit-text-stroke: 1px #040c10;color:#60adff;">+{{$sum2}}</span>
                                                        @else
                                                            <span style="font-size:14px;-webkit-text-stroke: 1px #040c10;color:#f56774">{{$sum2}}</span>
                                                        @endif
                                                        <img src="{{asset('mobile/kb.png')}}" width="23px">
                                                        </div>
                                                    @endif

                                                    @if (Auth::user()->id != $item->u1ids->id)
                                                        @php
                                                            $ele = getBattleElexir($item->u1ids->id,$item->start_day,$item->end_day);
                                                        @endphp
                                                        @if (count($ele) > 0)
                                                        <div>
                                                            <span style="font-size:14px;-webkit-text-stroke: 1px #040c10;color:#60adff;">+{{$ele[0]->elexir}}</span>
                                                            <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="23px">
                                                        </div>
                                                        @endif
                                                    @else
                                                        @php
                                                        $ele = getBattleElexir($item->u2ids->id,$item->start_day,$item->end_day);
                                                        @endphp
                                                        @if (count($ele) > 0)
                                                        <div>
                                                            <span style="font-size:14px;-webkit-text-stroke: 1px #040c10;color:#60adff;">+{{$ele[0]->elexir}}</span>
                                                            <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="23px">
                                                        </div>
                                                        @endif
                                                    @endif

                                                </div>
                                                <div class="col-12 mt-2 mb-2 text-right">
                                                    <button style="box-shadow: 1px 1px 3px 1px #8e8989" type="button" style="background: #2cc445" class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#kunlik{{$item->id}}">
                                                        <span style="-webkit-text-stroke: 1px #000000;">Kunlik janglar</span>
                                                    </button>
                                                </div>
                                            {{-- </div>   --}}

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
</div>