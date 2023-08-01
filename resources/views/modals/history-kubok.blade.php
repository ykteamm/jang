<div class="modal fade" id="history-kubok" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="container">
                            <img src="{{asset('mobile/kh.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                                <img src="{{asset('mobile/xclose.png')}}" width="30px">
                            </button>
                        </div>
                        <div class="card mb-3 mt-3">
                            @isset($all_battle)
                                @foreach ($all_battle as $item)
                                    @if(strtotime($item->end_day) < strtotime(date('Y-m-d')))
                                    @if ($item->ends == 1)
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
                                        @endphp
                                        <div class="col-12 ">
                                            <div class="card border-0 mb-1">
                                                <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;">
                                                    <div class="row supercell align-items-center" style="font-size:13px;">
                                                        <div class="col text-right">
                                                            <span class="mb-1">{{date('d.m.Y',strtotime($item->start_day))}}-{{date('d.m.Y',strtotime($item->end_day))}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center supercell" style="font-size:13px;">
                                                        <div class="col pr-0">
                                                            <img src="{{asset('mobile/kb.png')}}" width="23px;">
                                                            @if ($sum1 > 0)
                                                                +{{$sum1}}
                                                            @else
                                                                {{$sum1}}
                                                            @endif
                                                        </div>
                                                        <div class="col-auto text-right">
                                                            @if ($sum1 > 0)
                                                                <span class="mb-1 text-primary">
                                                                    G'alaba uchun
                                                                </span>
                                                            @else
                                                                <span class="mb-1 text-danger">
                                                                    Mag'lubiyat uchun
                                                                </span>
                                                            @endif
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endif
                                @endforeach
                            @endisset
                        </div>
                    </div>
            </div>
    </div>
</div>