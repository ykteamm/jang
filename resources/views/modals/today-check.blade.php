<div class="modal fade" id="todaycheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header p-0 pb-4" style="background: #a4adb8">
                <div class="container p-0"
                    style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
                    <span class="supercell text-white pl-3" style="font-size:25px;">SHOH YURISH {{ 9 + getKSN() }}</span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="opacity: 5;position:absolute;top:8px;right:10px;">
                    <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="container p-0" style="background: #a4adb8">
                    <div class="container">
                        @isset($all_sold)
                
                        <div class="row mb-3">
                            <div class="col">
                                <h6 class="subtitle mb-0 text-center">Bugungi cheklar</h6>
                            </div>
                        </div>
                        @endisset
                        <div class="row overflow-auto" style="height: 450px;">
                            @isset($all_sold)
                                @foreach ($all_sold as $sold)
                                    @php
                                    $sum=0;
                                    $category=0;
                                    $categoryTea=0;$category=0;
                                    $categoryTea=0;
                                        foreach ($sold->sold as $key => $value) {
                                            $sum += $value->price_product*$value->number;
                                            if(in_array($value->medicine->category_id,getCategoryId()))
                                            {
                                                $category += $value->number;
                                            }
                                            if(in_array($value->medicine->category_id,getCategoryTeaId()))
                                            {
                                                $categoryTea += $value->number;
                                            }
                                        }
                                    @endphp
                                    <div class="col-12  mb-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="mb-1 text-secondary text-left">{{number_format($sum,0,',',' ')}}
                                                        </h5>
                                                        <p class="text-secondary text-left mb-0">{{date('d.m.Y H:i',strtotime($sold->created_at))}}</p>
                                                        @if ($sum >= 200000 || ($category >= 1 && $categoryTea >= 2) || ($categoryTea >= 4))
                                                            <p class="text-secondary text-left"><span class="badge badge-success badge-pill">shox yurish</span></p>
                                                        @endif
                                                    </div>
                                                    <div class="col-auto pl-0 @if($sum >= 200000 || ($category >= 1 && $categoryTea >= 2) || ($categoryTea >= 4)) mt-3 @else mt-1 @endif">
                                                        <button class="btn bg-info rounded text-white" id="opencheck{{$sold->id}}" data-toggle="modal" data-target="#check{{$sold->id}}">
                                                            Ko'rish
                                                        </button>
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
        
    </div>
</div>