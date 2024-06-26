<div class="modal fade" id="onemonth" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('mobile/vil.webp') }}" width="111%"
                    style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="opacity: 5;position:absolute;top:8px;right:10px;">
                    <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                </button>
                <button style="position: absolute;top:47px;right:10px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
                    type="button" class="rounded d-flex align-items-center justify-content-center"
                    data-toggle="popover" title="Sinov"
                    data-content="Sinov davri 2 oy. Plan: 12 000 000"
                    data-placement="left">
                    <img width="20" class="instruksiya" src="{{ asset('mobile/instruksiya.png') }}" alt="Instruksiya">
                </button>
            </div>
            <div class="modal-body p-0">

                <div class="container p-0">
                    <div class="mb-3 pt-3">
                        @php
                            $sinovoyi = getSinovUser(Auth::id());
                        @endphp
                        @if ($sinovoyi != 0)
                            @php
                                $sum = 0;
                                $plan = 0;
                                foreach ($sinovoyi as $key => $itemu) {
                                    $sum += $itemu['make'];
                                    $plan += $itemu['plan'];
                                }
                            @endphp
                            <div class="col-12   pl-0 pr-0">
                                <div class="card border-0 m-2">
                                    <div class="pb-1 text-center"
                                        style="background: #dfe7f2;border-radius:15px;border:1px solid #666464">
                                        <div class="card-header" style="padding: 5px 25px;background:#14dc41;">
                                            <div
                                                class="d-flex align-items-center justify-content-between text-blue-800">
                                                <div style="font-weight:500">Sinov oyi</div>
                                                <div style="font-weight:500">
                                                    {{ date('d.m', strtotime($sinovoyi[0]['start'])) }} -
                                                    {{ date('d.m', strtotime($sinovoyi[3]['end'])) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between pr-3 pl-3 mt-2">
                                            <div style="font-weight:500">Oylik plan</div>
                                            <div style="font-weight:500">
                                                {{ number_format($plan, 0, ',', ' ') }} so'm
                                            </div>
                                        </div>
                                        <hr class="m2">
                                        <div
                                            class="d-flex align-items-center justify-content-between pr-3 pl-3 mb-2">
                                            <div style="font-weight:500">Bajarildi</div>
                                            <div style="font-weight:500">
                                                {{ number_format($sum, 0, ',', ' ') }} so'm
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @foreach ($sinovoyi as $key => $itemrr)
                                <div class="col-12   pl-0 pr-0">
                                    <div class="card border-0 m-2">
                                        <div class="pb-1 text-center"
                                            style="background: #dfe7f2;border-radius:15px;border:1px solid #666464">
                                            <div class="card-header" style="padding: 5px 25px;background:#20caf4;">
                                                <div
                                                    class="d-flex align-items-center justify-content-between text-blue-800">
                                                    <div style="font-weight:500">{{ $key + 1 }} - hafta</div>
                                                    <div style="font-weight:500">
                                                        {{ date('d.m', strtotime($itemrr['start'])) }} -
                                                        {{ date('d.m', strtotime($itemrr['end'])) }}
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($itemrr['red_day'] == 0)
                                                <div class="d-flex align-items-center justify-content-between pr-3 pl-3 mt-2 mr-2 ml-2" style="background: #ec6060;
                                                border-radius: 10px;">
                                                    <h6> 
                                                        Sizning sotuvingiz past bu xolatda planga erisha olmaysiz.Sizga ustozingiz 
                                                        {{ date('d.m.Y',(strtotime ( '+3 day' , strtotime ( $itemrr['start']) ) )) }} sanada
                                                        yarim smenaga yordamga keladi.
                                                    </h6>
                                                </div>
                                            @endif
                                            <div
                                                class="d-flex align-items-center justify-content-between pr-3 pl-3 mt-2">
                                                <div style="font-weight:500">Plan</div>
                                                <div style="font-weight:500">
                                                    {{ number_format($itemrr['plan'], 0, ',', ' ') }} so'm
                                                </div>
                                            </div>
                                            <hr class="m2">
                                            <div
                                                class="d-flex align-items-center justify-content-between pr-3 pl-3 mb-2">
                                                <div style="font-weight:500">Bajarildi</div>
                                                <div style="font-weight:500">
                                                    {{ number_format($itemrr['make'], 0, ',', ' ') }} so'm
                                                </div>
                                            </div>
                                            <div id="accordion">
                                                <div class="">
                                                    <div class="card-body pt-0 pb-0">
                                                        <div id="collapseTwo{{$key}}" class="collapse"
                                                            aria-labelledby="headingTwo{{$key}}"
                                                            data-parent="#accordion" style="background: #b6ccdf;
                                                            padding: 10px 10px;
                                                            border-radius: 8px;">
                                                            @php
                                                            $arr_date = [];
                                                                $Variable1 = strtotime($itemrr['start']);
                                                                $Variable2 = strtotime($itemrr['end']);
                                                                $sum = 0;
                                                                for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400)) 
                                                                {   

                                                                        $date = date('Y-m-d', $currentDate);
                                                                        $arr_date[] = $date;
                                                                        
                                                                }
                                                            @endphp
                                                            @foreach ($arr_date as $itemf)
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <div style="font-weight:500">{{date('d.m.Y',strtotime($itemf))}}</div>
                                                                    <div style="font-weight:500">
                                                                        savdo: {{getSavdo(Auth::id(),$itemf)}} so'm
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="p-0 text-center"
                                                        id="headingTwo{{$key}}">
                                                        <button class="btn btn collapsed dropdown-toggle"
                                                            data-toggle="collapse"
                                                            data-target="#collapseTwo{{$key}}"
                                                            aria-expanded="false"
                                                            aria-controls="collapseTwo{{$key}}"
                                                            style="font-size:16px;font-weight:600">
                                                            Batafsil
                                                        </button>
                                                    </div>
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
        </div>
    </div>
</div>
