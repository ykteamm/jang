@isset($all_battle)
@foreach ($all_battle as $item)
<div class="modal fade" id="kunlik{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background: #5f687c;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <div class="modal-body p-0">
                <div style="background: #e1edf1;border-radius:15px;" class="m-1 pt-3 pb-3">
                    @isset($all_battle)
                        @foreach ($item->battle_elchi->reverse() as $b)
                        @php
                        $sum1 = 0;
                        $sum2 = 0;
                        $prices1 = 0;
                        $prices2 = 0;
                        if($b->u1id == Auth::user()->id)
                        {
                            
                            $prices1 = $b->sold1;
                            $prices2 = $b->sold2;
                            if($b->win == 0)
                                {
                                    $sum1 = -1*$b->ball1;
                                    $sum2 = $b->ball2;
                                }else{
                                    $sum1 = $b->ball1;
                                    $sum2 = -1*$b->ball2;
                                }
                        }else{
                            $prices1 = $b->sold2;
                            $prices2 = $b->sold1;
                            if($b->lose == 1)
                                {
                                    $sum1 = $b->ball2;
                                    $sum2 = -1*$b->ball1;
                                }else{
                                    $sum1 = -1*$b->ball2;
                                    $sum2 = $b->ball1;
                                }
                        }
                        // if($b->u1id != Auth::user()->id)
                        // {
                        //     $prices2 = $b->price1;
                        //     if($b->win == 1)
                        //         {
                        //             $sum2 = $b->ball1;
                        //         }else{
                        //             $sum2 = -1*$b->ball1;
                        //         }
                        // }else{
                        //     $prices2 = $b->price2;
                        //     if($b->win == 1)
                        //         {
                        //             $sum2 = $b->ball2;
                        //         }else{
                        //             $sum2 = -1*$b->ball2;
                        //         }
                        // }
                                                
                                            
                        @endphp
                        <div class="mb-3">
                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="card-body" style="background: #898989;border-radius:15px;padding:20px;padding-bottom:5px !important">
                                        <div class="row supercell" style="font-size:12px;">
                                            <div class="col pl-0 pr-0">
                                                <h6 class="subtitle mb-3" >
                                                    @if ($prices1 > $prices2)
                                                    <span class="text-primary" style="-webkit-text-stroke: 1px #040c10">G'OLIB</span>
                                                    @elseif($prices2 > $prices1)
                                                    <span class="text-danger" style="-webkit-text-stroke: 1px #040c10   ">MAG'LUB</span>
                                                    @else
                                                    <span class="text-info" style="-webkit-text-stroke: 1px #040c10   ">DURANG</span>
                                                    @endif
                                                </h6>
                                            </div>
                                            <div class="col-auto pl-0 pr-0"><a href="" class="text-white" style="-webkit-text-stroke: 1px #040c10">{{date('d.m.Y',strtotime($b->battle_date))}}</a></div>
                                        </div>
                                        <div class="row p-2 supercell" style="background: #ffffff;border-bottom-left-radius:15px;border-bottom-right-radius:15px;">
                                                <div class="col-5">
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
                                                    <button style="font-size:10px;background: #0c2237;" class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                        {{number_format($prices1,0,'',' ')}}
                                                    </button>

                                                </div>
                                                <div class="col-2 col-md-2 text-center pt-4" style="padding-left: 31px !important">
                                                    <img src="{{asset('mobile/vs.png')}}" width="50px" style="border-radius:15px;margin-left: -28px;margin-top:-5px;">
                                                </div>
                                                <div class="col-5 text-right">
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
                                                    <button style="font-size:10px;background: #0c2237;" class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                        {{number_format($prices2,0,'',' ')}}
                                                    </button>

                                                </div>
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
@endforeach
@endisset