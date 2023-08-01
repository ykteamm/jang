<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
                <img src="{{asset('mobile/vil.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
        </div>
        @if ($resime == 2)
            
            <div class="modal-body p-0">

                <div class="container p-0">
                    <div class="mb-3 pt-3">
                        @foreach (getShogirdUser() as $key => $item)
                                
                            <div class="col-12  ">
                                @php
                                $shogird_day = getShogirdDay($item->id);
                                @endphp
                            <div class="container p-1" style="background:#3ad1717d;border-radius:13px;" data-toggle="modal" data-target="#new-elchi">
                                <div class="border-0 mb-1">
                                    <div class="card-body" style="border-radius:15px;">
                                        <div class="row align-items-center">
                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-secondary " style="background: #e0aa2c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                    {{$key+1}}
                                                </button>
                                            </div>
                                            <div class="col-auto ml-auto mr-3">
                                                <span class="mb-1" style="color: #272730;font-size:12px">{{$item->last_name}} {{$item->first_name}}</span>
                                            </div>
                                            
                                        </div>
                                        @if ($item->status == 4)
                                            <div class="align-items-center mt-2">
                                                <h6 class="text-center" style="color:red">Haftalik plan bajarilmagani uchun shogirdni profili bloklandi</h6>
                                            </div>
                                        @endif
                                        @if ($item->status == 1)
                                            <div class="align-items-center mt-2">
                                                <h6 class="text-center" style="color:#0f2f89">
                                                    Shogirdingiz haftalik planni bajardi va ishga qabul qilindi.Sizga esa 200 000 so'm pul mukofoti.
                                                </h6>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div data-toggle="modal" data-target="#myshogirdin{{$item->id}}" class="p-2" style="background: #97c8dc;border-radius: 10px;">

                                    <h5 class="text-center">O'quv haftasi</h5>
                                    @if ($item->status != 1)
                                        @if (count($shogird_day) != 0)
                                        <h5 class="text-center">{{count($shogird_day)}} - kun</h5>
                                        @endif
                                    @endif
                                    <div class="card-body" style="padding: 5px 25px;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div style="font-weight:500">Plan:</div>
                                            <div style="font-weight:500">
                                                {{number_format(getShogirdPlan(),0,',',' ')}} so'm
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div style="font-weight:500">Bajarildi:</div>
                                            <div style="font-weight:500">
                                                {{number_format(getShogirdFact($item->id),0,',',' ')}} so'm
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="{{asset('mobile/target.webp')}}" width="30px" alt="">
                                            </div>
                                            <div class="col-9 mt-2 pl-0 pr-0">
                                                <div class="row">
                                                    
                                                    @for ($i = 1; $i <= 7; $i++)
                                                    {{-- @if ($i == 5)
                                                        
                                                        <div style="width:12%;height:15px;border: 1px solid #4e34da;border-radius:13px;@if ($i <= count($shogird_day))
                                                        background:orange;
                                                    @endif">
                                                            <span style="display: block;font-size:10px;">{{count($shogird_day)}}/7</span>
                                                        </div>
                                                    @endif --}}
                                                    @php
                                                        if ($i <= count($shogird_day))
                                                        {
                                                            $sum = getShogirdDay($item->id);
                                                            $all_sum = $sum[$i]['make'] + $sum[$i]['make_other'];
                                                            if($all_sum >= 250000)
                                                            {
                                                                $color = 'green';
                                                            }else{
                                                                $color = 'orange';

                                                            }
                                                        }else{
                                                            $color = 'orange';

                                                        }
                                                        
                                                    @endphp
                                                        <div style="width:11%;height:15px;border: 1px solid #4e34da;border-radius:13px;@if ($i <= count($shogird_day))
                                                        background:{{$color}};
                                                    @endif ">
                
                                                        </div>
                                                    @endfor
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                @if ($item->status == 1)
                                    <div data-toggle="modal" data-target="#onemonthin{{$item->id}}" class="p-2 mt-3" style="background: #97c8dc;border-radius: 10px;">
                                        @php
                                            $sum = 0;
                                            $plan = 0;
                                            $sinovoyi = getSinovUser($item->id);
                                            if($sinovoyi > 0 && is_array($sinovoyi)) {
                                                foreach ($sinovoyi as $key => $item) {
                                                    $sum += $item['make'];
                                                    $plan += $item['plan'];
                                                }
                                            }
                                        @endphp
                                        <h5 class="text-center">Sinov oyi</h5>
                                        <div class="card-body" style="padding: 5px 25px;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div style="font-weight:500">Plan:</div>
                                                <div style="font-weight:500">
                                                    {{number_format($plan,0,',',' ')}} so'm
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div style="font-weight:500">Bajarildi:</div>
                                                <div style="font-weight:500">
                                                    {{number_format($sum,0,',',' ')}} so'm
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                                
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        @endif

    </div>
</div>