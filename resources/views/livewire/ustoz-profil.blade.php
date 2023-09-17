<div>
    <div class="card p-2" style="background: none">
        <div class="mt-2">
            @if ($resime == 2)

            @php
                $shogird = ustozProfil($ustoz_id);
            @endphp

            <div>
                <div class="card border-0 mb-1">
                    <div class="card-body" style="
                        background: linear-gradient(346deg, #ef3737, #9ce50a, transparent);
                        border-radius: 7px;border: 1px solid #9c9191;">
                        <div class="row align-items-center pr-3">
                            <div class="col-2 text-center p-0">
                                <div class="">
                                    <div class="for-avatar avatar avatar-140 rounded-circle mx-auto" style="width: 30px;height:30px;">
                                        <div class="background" style="background-image: url({{$shogird[0]->image_url}});">

                                        <img src="{{$shogird[0]->image_url}}" height="10px" alt="" style="display: none;">
                                                                                            
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-5 pr-0 pl-3">
                                <span class="mb-1 supercell" style="color: #272730;font-size:12px">
                                    {{$shogird[0]->first_name}} {{substr($shogird[0]->last_name,0,1)}}
                                </span>
                            </div>
                            {{-- <div class="col-2 text-center p-0" style="padding-right: 4px !important;">
                                <div style="font-size:12px;font-weight:600">shogird</div>
                                <div style="font-size:15px;font-weight:800">{{$item['shogird']}}</div>
                            </div> --}}
                            <div class="col-3" style="border-left:1px solid #959690;">
                                <button type="button" class="btn btn-sm btn-secondary supercell" style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                    <div class="d-flex align-items-center">
                                        <span style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                                                                        {{ numb($shogird[1])}}
                                                                                                </span>
                                        <img src="http://127.0.0.1:8000/mobile/oltin.png" width="23px;" style="padding-left:3px">
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($shogird[2] as $item)
                
                
                <div>
                    <div class="card border-0 mb-1">
                        <div class="card-body" style="
                            background: linear-gradient(136deg, #dfddc0, #93bdc1, transparent);
                            border-radius: 7px;border: 1px solid #9c9191;">
                            <div class="row align-items-center pr-3">
                                <div class="col-2 text-center p-0">
                                    <div class="">
                                        <div class="for-avatar avatar avatar-140 rounded-circle mx-auto" style="width: 30px;height:30px;">
                                            <div class="background" style="background-image: url({{$item['user']->image_url}});">
    
                                            <img src="{{$item['user']->image_url}}" height="10px" alt="" style="display: none;">
                                                                                                
                                            </div>
    
    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 pr-0 pl-3">
                                    <span class="mb-1 supercell" style="color: #272730;font-size:12px">
                                        {{$item['user']->first_name}} {{substr($item['user']->last_name,0,1)}}
                                    </span>
                                </div>
                                {{-- <div class="col-2 text-center p-0" style="padding-right: 4px !important;">
                                    <div style="font-size:12px;font-weight:600">shogird</div>
                                    <div style="font-size:15px;font-weight:800">{{$item['shogird']}}</div>
                                </div> --}}
                                <div class="col-3" style="border-left:1px solid #959690;">
                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="background-image: linear-gradient(to bottom,#eed8a7,#f3d791,#f8c953);border-radius: 5px; border: 2px solid #eee7cc;width: 85px;height: 40px;">
                                        <div class="d-flex align-items-center">
                                            <span style="font-size:11px;-webkit-text-stroke: 1px #36393a !important;text-shadow: -1px 1.3px 1px #000, -1px 1px 3px black">
                                                                                                            {{ numb($item['sum'])}}
                                                                                                    </span>
                                            <img src="http://127.0.0.1:8000/mobile/oltin.png" width="23px;" style="padding-left:3px">
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

            @endif

        </div>
    </div>
</div>
