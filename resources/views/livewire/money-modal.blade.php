<div class="carousel-inner">

    @if($resime == 2)
    
    @foreach (getMonthM(2) as $key => $item)
    <div class="carousel-item @if($key == 0) active @endif">

            <div class="w-100 zigzak p-3">
                <h3 class="mb-3 supercell pt-2" style="text-align:center">
                    {{ getMonthName($item['month_name']) }}</h3>
                <div style="border-bottom:2px dashed rgba(19, 4, 4, 0.647)" class="mb-3">
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h5>
                        Savdo:
                    </h5>
                    <h5>
                        {{ number_format($item['summa'], 0, ',', ' ') }}
                        <span style="font-size:14px">so'm</span>
                    </h5>
                </div>
                <div class="d-flex justify-content-between align-items-center row">
                    <h5 class="col-6">
                        Savdoga ko'ra maosh:
                    </h5>
                    <h5 class="col-6 d-flex justify-content-end align-items-end">
                        <span class="pr-1">{{ number_format($item['maosh'], 0, ',', ' ')." " }}</span>
                        <span style="font-size:14px">so'm</span>
                    </h5>
                </div>
                <div class="d-flex justify-content-between align-items-center row">
                    <h5 class="col-6">
                        Daromad kamayishi:
                    </h5>
                    <h5 class="col-6 d-flex justify-content-end align-items-end">
                        <span class="pr-1">{{ number_format($item['jarima'], 0, ',', ' ')." " }}</span>

                        {{-- <span class="pr-1">{{ number_format($item['time'], 0, ',', ' ')." " }}</span> --}}
                        <span style="font-size:14px">so'm</span>
                    </h5>
                </div>
                @php
                    $getPremya = getPremya($item['date_begin'],$item['date_end']);
                    $getPremyaDefault = getPremyaDefault($item['date_begin'],$item['date_end']);
                    $getShtrafDefault = getShtrafDefault($item['date_begin'],$item['date_end']);
                    $getP = 0;
                    $getPD = 0;
                    $getSH = 0;
                @endphp

                @if (count($getPremya) > 0 || count($getPremyaDefault) >0)

                <div id="collapseTwob" class="collapse mt-3"
                                    aria-labelledby="headingTwob"
                                    data-parent="#accordion">

                                        @foreach ($getPremya as $gp)
                                        @php
                                            $getP = $getP + $gp->premya->premya;
                                        @endphp
                                            <div class="align-items-center text-center justify-content-between mt-1"
                                            style="border:1px solid blue;border-raidus:10px;padding:5px 3px;">
                                                Bir kunda savdoni {{$gp->premya->task}} so'mdan oshirganligi uchun
                                                {{$gp->premya->premya}} so'm premya
                                            </div>
                                        @endforeach

                                        @foreach ($getPremyaDefault as $gp)
                                            @php
                                                $getPD = $getP + $gp->price;
                                            @endphp
                                            <div class="align-items-center text-center justify-content-between mt-1"
                                            style="border:1px solid blue;border-raidus:10px;padding:5px 3px;">
                                                {{$gp->message}}
                                            </div>
                                        @endforeach

                </div>
                <div style="background-color:#5ddb4ddb" class="card-footer border p-0 text-center mt-3"
                                id="headingTwob">
                                <button class="btn btn collapsed dropdown-toggle"
                                    data-toggle="collapse"
                                    data-target="#collapseTwob"
                                    aria-expanded="false"
                                    aria-controls="collapseTwob"
                                    style="font-size:16px;font-weight:600">
                                    Premya
                                </button>
                </div>



                @endif
                <div id="collapseTwob2" class="collapse mt-3"
                                    aria-labelledby="headingTwob2"
                                    data-parent="#accordion">

                                        @foreach ($getShtrafDefault as $gp)
                                            @php
                                                $getSH = $getSH + $gp->price;
                                            @endphp
                                            <div class="align-items-center text-center justify-content-between mt-1"
                                            style="border:1px solid blue;border-raidus:10px;padding:5px 3px;">
                                                {{date('d.m.Y',strtotime($gp->date))}} kuniga {{$gp->price}}.
                                                Sababi: {{$gp->message}}
                                            </div>
                                        @endforeach

                </div>
                @if (count($getShtrafDefault) > 0)

                <div style="background-color:#e74c41db" class="card-footer border p-0 text-center mt-3"
                                id="headingTwob2">
                                <button class="btn btn collapsed dropdown-toggle"
                                    data-toggle="collapse"
                                    data-target="#collapseTwob2"
                                    aria-expanded="false"
                                    aria-controls="collapseTwob2"
                                    style="font-size:16px;font-weight:600">
                                    Shtraf
                                </button>
                </div>
                @endif

                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>
                            Maosh:
                        </h5>
                        <h5 style="font-weight:700">
                            {{ number_format($item['maosh'] - $item['jarima'] + $getPD + $getP - $getSH, 0, ',', ' ') }} <span
                                style="font-size:14px">so'm</span></h5>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-footer">
                    <div class="row mb-4">
                        <div class="col p-0">
                            <div id="accordion">
                                @foreach (fff($item['date_begin'],$item['date_end']) as $key => $item)
                                    @if (date('w', strtotime($key)) >= 0)
                                        <div class="card mb-3" style="
                                        @if ($item['last_month'] == 1)
                                        @else
                                            @if (!$item['open_date'] && (strtotime($key)-strtotime(date('Y-m-d'))) < 0 && date('w', strtotime($key)) > 0)
                                                background:#ff6464;
                                            @endif
                                        @endif
                                        border:1px solid #000 !important">
                                             <div style="background-color:#ccd4ee69" class="card-header border border-black text-center p-1"
                                                id="headingTwo{{ $key }}">
                                                <div style="font-size:16px;font-weight:600">
                                                    {{ (strpos(date('d', strtotime($key)), '0') == 'false'
                                                        ? substr(date('d', strtotime($key)), 1)
                                                        : date('d', strtotime($key))) .
                                                        ('-' . getMonthName(date('F', strtotime($key))) . '. ' . $weekDays[date('w', strtotime($key))]) }}
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div style="font-weight:500">Savdo:</div>
                                                    <div style="font-weight:500">
                                                        {{ number_format($item['fact'], 0, '', ' ') }} so'm</div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div style="font-weight:500">Daromad:</div>
                                                    <div style="font-weight:500">
                                                        @if ($item['maosh'] - $item['jarima'] > 0)
                                                            {{ number_format($item['maosh'], 0, ',', ' ') }}
                                                        @else
                                                            0
                                                        @endif
                                                        so'm
                                                    </div>
                                                </div>

                                                <div id="collapseTwo{{ $key }}" class="collapse"


                                                    aria-labelledby="headingTwo{{ $key }}"
                                                    data-parent="#accordion">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div style="font-weight:500">Smena:</div>
                                                        <div style="font-weight:500">
                                                            @if ($item['open_date'])
                                                                {{ date('H:i', strtotime($item['open_date'])) }}
                                                            @else
                                                                Ochilmagan
                                                            @endif
                                                            -
                                                            @if ($item['close_date'])
                                                                {{ date('H:i', strtotime($item['close_date'])) }}
                                                            @else
                                                                Yopilmagan
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div style="font-weight:500">Ish rejimi:</div>
                                                        <div style="font-weight:500">
                                                            @if ($item['start_work'])
                                                                {{ date('H:i', strtotime($item['start_work'])) }}
                                                            @else
                                                                Belgilanmagan
                                                            @endif
                                                            -
                                                            @if ($item['finish_work'])
                                                                {{ date('H:i', strtotime($item['finish_work'])) }}
                                                            @else
                                                                Belgilanmagan
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if (date('Y-m-d', strtotime($key)) != date("Y-m-d"))
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div style="font-weight:500">Aptekada bo'lmagan vaqt:</div>
                                                            @if ($item['minut'] == 123123)
                                                                @php
                                                                $soat = 0;
                                                                $minut = 0;
                                                                @endphp
                                                            @else
                                                                @php
                                                                $soat = floor($item['minut'] / 60);
                                                                $minut = $item['minut'] % 60;
                                                                @endphp
                                                            @endif

                                                            <div style="font-weight:500">
                                                                @if ($soat > 0)
                                                                <span>{{ $soat }} soat</span>
                                                                @endif
                                                                @if ($minut > 0)
                                                                    <span>{{ $minut }} minut</span>
                                                                @endif
                                                                @if ($soat <= 0 && $minut <= 0)
                                                                    <span>0</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div style="font-weight:500">Daromad kamayishi:</div>
                                                        <div style="font-weight:500">

                                                            @if ($item['last_month'] == 1)
                                                                {{ number_format($item['jarima'], 0, ',', ' ') }}
                                                                so'm ga
                                                            @else
                                                                @if (!$item['open_date'] && (strtotime($key)-strtotime(date('Y-m-d'))) < 0 && date('w', strtotime($key)) > 0)
                                                                Oy oxirida hisoblanadi
                                                                @else
                                                                    {{ number_format($item['jarima'], 0, ',', ' ') }}
                                                                    so'm ga
                                                                @endif
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="background-color:#ccd4ee69" class="card-footer border p-0 text-center"
                                                id="headingTwo{{ $key }}">
                                                <button class="btn btn collapsed dropdown-toggle"
                                                    data-toggle="collapse"
                                                    data-target="#collapseTwo{{ $key }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseTwo{{ $key }}"
                                                    style="font-size:16px;font-weight:600">
                                                    Batafsil
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    @endforeach

    @endif
    
</div>