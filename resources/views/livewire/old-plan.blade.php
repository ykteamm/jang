<div>
    <div class="row m-0">
        <div class="col-12 text-center p-0">
            <button type="button" class="mb-2 btn btn-sm deletecolor btn-info" wire:click="$emit('planDate','day')"
                onclick="showChart('day')">
                <span class="supercel-text-stroke">Kunlik</span>
            </button>
            <button type="button" class="mb-2 btn btn-sm deletecolor btn-info" wire:click="$emit('planDate','week')"
                onclick="showChart('week')">
                <span class="supercel-text-stroke">Haftalik</span>
            </button>
            <button type="button" class="mb-2 btn btn-sm deletecolor btn-info" wire:click="$emit('planDate','month')"
                onclick="showChart('month')">
                <span class="supercel-text-stroke">Oylik</span>
            </button>
        </div>
            <div class="container mt-2 pt-2 pb-2" style="background:#a5cae3;border-radius:15px;">
                <div class="row justify-content-center">
                    {{-- @if ($date == 'week')
                        <div class="col-12 ">
                            <div class="card mb-1"
                                style="background:#009d70;border-radius:15px;border:3px solid #00e8b6;">
                                <div class="card-body p-2 pl-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="p-1">
                                                <h3 class="text-center gilroy"
                                                    style="color:#ffffff;-webkit-text-stroke: 1px #040c10">
                                                    @if (count($money_array) == 7)
                                                        Haftalik
                                                    @else
                                                        {{ count($money_array) }} kunlik
                                                    @endif Plan
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-around align-items-center my-3">
                                            <div>
                                                <div class="d-flex justify-content-center align-items-center my-3">
                                                    <span
                                                        style="width:10px;height:10px;border-radius:50%;background:rgb(225, 217, 48)"></span>
                                                    <div class="ml-1 supercell" style="color:#fff;font-size:15px">Plan
                                                    </div>
                                                </div>
                                                <div
                                                    style="font-family: monospace;font-size:13px;color:#fff;font-weight:700">
                                                    {{ number_format($plan) }} so'm</div>
                                            </div>
                                            <div>
                                                <div class="d-flex justify-content-center align-items-center my-3">
                                                    <span
                                                        style="width:10px;height:10px;border-radius:50%;background:rgb(93, 200, 93)"></span>
                                                    <div class="ml-1 supercell" style="color:#fff;font-size:15px">
                                                        Bajarildi
                                                    </div>
                                                </div>
                                                <div
                                                    style="font-family: monospace;font-size:13px;color:#fff;font-weight:700">
                                                    {{ number_format($make) }} so'm</div>
                                            </div>
                                            <div>
                                                @if ($plan_days - $plan_make > 0)
                                                    <div class="d-flex justify-content-center align-items-center my-3">
                                                        <span
                                                            style="width:10px;height:10px;border-radius:50%;background:rgb(217, 70, 70)"></span>
                                                        <div class="ml-1 supercell" style="color:#fff;font-size:15px">
                                                            Qoldi
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="font-family: monospace;font-size:13px;color:#fff;font-weight:700">
                                                        {{ number_format($plan - $make) }} so'm</div>
                                                @else
                                                    <div class="d-flex justify-content-center align-items-center my-3">
                                                        <span
                                                            style="width:10px;height:10px;border-radius:50%;background:rgb(102, 93, 200)"></span>
                                                        <div class="ml-1 supercell" style="color:#fff;font-size:15px">
                                                            Oshdi
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="font-family: monospace;font-size:13px;color:#fff;font-weight:700">
                                                        {{ number_format($make - $plan) }} so'm</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="plans">
                                                <span class="difference">
                                                    <span id="difSum"></span>
                                                </span>
                                                <div class="planDaily">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="row pl-2">
                                                <div class="col-8">
                                                    <div class="row">
                                                        @foreach ($money_array as $key => $item)
                                                            <div class="col-1"
                                                                style="flex: 0 0 14.271%;max-width: 14.271%;padding-right:0px;padding-left:1px;">
                                                                <div class="card-body p-1"
                                                                    style="background: #79a2fe;border-radius:7px;">
                                                                    @if (strtotime(date('Y-m-d')) < strtotime($item['date']))
                                                                        <div
                                                                            style="background: #d9e6f7;border-radius:5px;">
                                                                            <i class="material-icons"
                                                                                style="color:#00d0ff;font-size:14px;-webkit-text-stroke: 1px #00d0ff;">schedule</i>
                                                                        </div>
                                                                    @else
                                                                        @if ($item['sold'] >= $item['day_money'])
                                                                            <div
                                                                                style="background: #d9e6f7;border-radius:5px;">
                                                                                <i class="material-icons"
                                                                                    style="color:#03a403;font-size:14px;-webkit-text-stroke: 3px #03a403;">done</i>
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                style="background: #d9e6f7;border-radius:5px;">
                                                                                <i class="material-icons"
                                                                                    style="color:#ff0207;font-size:14px;-webkit-text-stroke: 3px #ff0207;">close</i>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    <div>
                                                                        <div>
                                                                            <span
                                                                                class="text-white">{{ date('d', strtotime($item['date'])) }}</span>
                                                                        </div>
                                                                        <div>
                                                                            <span style="font-size:11px"
                                                                                class="text-white">{{ date('M', strtotime($item['date'])) }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    @if ($make >= $plan)
                                                        <div>
                                                            <button type="button" class="btn pt-2 pb-2 pl-1 pr-1"
                                                                style="background: #43dc48;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                                <i class="material-icons"
                                                                    style="color:#ffffff;font-size:35px;-webkit-text-stroke: 3px #ffffff;">done</i>
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <span style="font-size:11px" class="text-white">
                                                                Plan bajarilmoqda
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <button type="button" class="btn pt-2 pb-2"
                                                                style="background: #dd1811;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                                <i class="material-icons"
                                                                    style="color:#ffffff;font-size:35px;-webkit-text-stroke: 3px #ffffff;">close</i>
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <span style="font-size:11px" class="text-white">
                                                                Plan bajarilmayapdi
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif --}}
                    {{-- @if ($date == 'day')
                        @if ($plan_days > 0)
                        @endif
                    @endif --}}
                    <div class="card mb-1"
                        style="background:#009d70;border-radius:15px;border:3px solid #00e8b6;">
                        <div class="card-body p-2 pl-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-1">
                                        <h2 class="text-center gilroy"
                                            style="color:#82c0cf;-webkit-text-stroke: 1px #040c10">
                                            @switch($date)
                                                @case('day')
                                                    Bugun
                                                    @break
                                                @case('week')
                                                    Hafta
                                                    @break
                                                @default
                                                    Oy
                                            @endswitch
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-around align-items-center my-3">
                                    <div>
                                        <div class="d-flex justify-content-center align-items-center my-3">
                                            <span
                                                style="width:10px;height:10px;border-radius:50%;background:rgb(225, 217, 48)"></span>
                                            <div class="ml-1 supercell" style="color:#fff;font-size:15px">
                                                Plan
                                            </div>
                                        </div>
                                        <div
                                            style="font-family: monospace;font-size:13px;color:#fff;font-weight:700">
                                            {{ number_format($plan) }} so'm</div>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-center align-items-center my-3">
                                            <span
                                                style="width:10px;height:10px;border-radius:50%;background:rgb(93, 200, 93)"></span>
                                            <div class="ml-1 supercell" style="color:#fff;font-size:15px">
                                                Bajarildi
                                            </div>
                                        </div>
                                        <div
                                            style="font-family: monospace;font-size:13px;color:#fff;font-weight:700">
                                            {{ number_format($fact) }} so'm</div>
                                    </div>
                                    <div>
                                        @if ($plan - $fact > 0)
                                            <div class="d-flex justify-content-center align-items-center my-3">
                                                <span
                                                    style="width:10px;height:10px;border-radius:50%;background:rgb(217, 70, 70)"></span>
                                                <div class="ml-1 supercell" style="color:#fff;font-size:15px">
                                                    Qoldi
                                                </div>
                                            </div>
                                            <div
                                                style="font-family: monospace;font-size:13px;color:#fff;font-weight:700">
                                                {{ number_format($plan - $fact) }} so'm
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center align-items-center my-3">
                                                <span
                                                    style="width:10px;height:10px;border-radius:50%;background:rgb(102, 93, 200)"></span>
                                                <div class="ml-1 supercell" style="color:#fff;font-size:15px">
                                                    Oshdi
                                                </div>
                                            </div>
                                            <div
                                                style="font-family: monospace;font-size:13px;color:#fff;font-weight:700">
                                                {{ number_format($plan - $fact) }} so'm
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="plans">
                                        <span class="difference">
                                            @if ($plan == $fact)
                                                <span id="difSum" style="background: rgb(102, 93, 200)">
                                                    0
                                                </span>
                                            @else
                                                @if ($plan < $fact)
                                                    <span id="difSum" style="background:rgb(102, 93, 200)">
                                                        {{ number_format(($fact - $plan), 0, '', ' ') }}
                                                    </span>
                                                @else
                                                    <span id="difSum" style="background:rgb(217, 70, 70)">
                                                        -{{ number_format(($plan - $fact), 0, '', ' ') }}
                                                    </span>
                                                @endif
                                            @endif
                                        </span>
                                        <div class="planChart">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @foreach ($medicines as $medicine)
        <div class="col-12 ">
            <div class="card border-0 mb-1">
                <div class="card-body p-1" style="background: #c8d7ec;border-radius:15px;">
                    <div class="row align-items-center">
                        <div class="col-8 pl-4">
                            <span class="mb-1" style="color: #272730;font-size:12px">{{ $medicine->name }}</span>
                        </div>
                        <div class="col-4 pl-4">
                            <button type="button" class="btn btn-sm btn-secondary"
                                style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                {{ $medicine->fact }}/{{ $medicine->plan }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
