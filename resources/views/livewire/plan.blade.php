<div>
    @if ($resime == 2)
        
        <div style="background:#eeeeee;margin:10px 0;border-radius:10px;padding:20px 0;color:#000">
            <div class="col-12 text-center p-0">
                <div class="col-12 pt-2">
                    <ul class="nav nav-pills planscrollbar" style="flex-wrap: nowrap; overflow:scroll">
                        @foreach ($dates as $d)
                            @switch($d)
                                @case('day')
                                    <li class="nav-item" style="margin-right:7px" wire:click="$emit('planDate', 'day')">
                                        <a class="nav-link @if ($date == $d) active @endif"
                                            style="min-width:40px;border: 1px solid #E4DFDF;border-radius: 15px;@if ($date != $d) background:#ffffff;color:#000 @endif">
                                            Bugun
                                        </a>
                                    </li>
                                @break

                                @case('week')
                                    <li class="nav-item" style="margin-right:7px" wire:click="$emit('planDate', 'week')">
                                        <a class="nav-link @if ($date == $d) active @endif"
                                            style="min-width:40px;border: 1px solid #E4DFDF;border-radius: 15px;@if ($date != $d) background:#ffffff;color:#000 @endif">
                                            Hafta
                                        </a>
                                    </li>
                                @break

                                @case('month')
                                    <li class="nav-item" style="margin-right:7px" wire:click="$emit('planDate', 'month')">
                                        <a class="nav-link @if ($date == $d) active @endif"
                                            style="min-width:40px;border: 1px solid #E4DFDF;border-radius: 15px;@if ($date != $d) background:#ffffff;color:#000 @endif">
                                            Oy
                                        </a>
                                    </li>
                                @break

                                @default
                                    <li class="nav-item" style="margin-right:7px"
                                        wire:click="$emit('planDate', {{ $d }})">
                                        <a class="nav-link @if ($date == $d) active @endif"
                                            style="min-width:40px;border: 1px solid #E4DFDF;border-radius: 15px;@if ($date != $d) background:#ffffff;color:#000 @endif">
                                            {{ $d }}
                                        </a>
                                    </li>
                            @endswitch
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 py-3">
                <div class="card" style="background: #ffffff">
                    <div class="col align-self-center">
                        <div style="height:70px" class="d-flex justify-content-between align-items-center">
                            <div>
                                @switch($date)
                                    @case('day')
                                        <div class="mb-1 supercell text-dark" style="font-size:12px;">
                                            Bugun
                                        </div>
                                        <div>
                                            <span class="supercell"
                                                style="color:#272730;font-weight:600;font-size:10px">{{ number_format(round($fact / 1000), 0, '', ' ') }}K</span>
                                            {{ ' / ' }}
                                            <span class="supercell"
                                                style="color:#272730;font-weight:600;font-size:10px">{{ number_format(round($plan / 1000), 0, '', ' ') }}K</span>
                                        </div>
                                    @break

                                    @case('week')
                                        <div class="mb-1 supercell text-dark" style="font-size:12px;">
                                            Bu hafta
                                        </div>
                                        <div>
                                            <span class="supercell"
                                                style="color:#272730;font-weight:600;font-size:10px">{{ round($fact / 1000000) }}M</span>
                                            {{ ' / ' }}
                                            <span class="supercell"
                                                style="color:#272730;font-weight:600;font-size:10px">{{ round($plan / 1000000) }}M</span>
                                        </div>
                                    @break

                                    @case('month')
                                        <div class="mb-1 supercell text-dark" style="font-size:12px;">
                                            Bu oy
                                        </div>
                                        <div>
                                            <span class="supercell"
                                                style="color:#272730;font-weight:600;font-size:10px">{{ round($fact / 1000000) }}M</span>
                                            {{ ' / ' }}
                                            <span class="supercell"
                                                style="color:#272730;font-weight:600;font-size:10px">{{ round($plan / 1000000) }}M</span>
                                        </div>
                                    @break

                                    @default
                                        <div class="mb-1 supercell text-dark" style="font-size:12px;">
                                            {{ $date }} - {{ getMonthName(date('F')) }}
                                        </div>
                                        <div>
                                            <span class="supercell"
                                                style="color:#272730;font-weight:600;font-size:10px">{{ number_format(round($fact / 1000), 0, '', ' ') }}K</span>
                                            {{ ' / ' }}
                                            <span class="supercell"
                                                style="color:#272730;font-weight:600;font-size:10px">{{ number_format(round($plan / 1000), 0, '', ' ') }}K</span>
                                        </div>
                                @endswitch
                            </div>
                            <div>
                                <img width="30" src="{{ asset('mobile/soqqa.png') }}" alt="Image">
                                <span class="supercell">{{ number_format(maosh($fact), 0, '', ' ') }}</span>
                            </div>
                        </div>
                        @if ($plan > 0)
                            <div class="progress mb-3">
                                <div class="progress-bar bg-primary text-white" role="progressbar"
                                    style="width: {{ ($fact * 100) / $plan }}%" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 py-2">
                <ul class="nav planscrollbar" style="flex-wrap: nowrap; overflow:scroll">
                    @switch($date)
                        @case('week')
                            @php
                                $s = 1;
                                if ($fact > 1000000) {
                                    $s = round($fact / 1000000) + 1;
                                }
                            @endphp
                            @for ($i = $s; $i < $s + 6; $i++)
                                <li class="nav-item" style="margin-right:10px">
                                    <div class="card" style="width:160px; padding:15px;background:#ffffff">
                                        <div>
                                            <div class="text-center supercell" style="font-size:12px;font-weight:600">
                                                <img width="20" src="{{ asset('mobile/soqqa.png') }}" alt="Image">
                                                <span>{{ number_format(maosh($i * 1000000), 0, '', ' ') }}</span>
                                            </div>
                                            <div class="text-center supercell" style="font-size:12px;font-weight:600">
                                                <span>Plan: </span><span>{{ number_format($i, 0, '', ' ') }}M</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                        @break

                        @case('month')
                            @php
                                $s = 1;
                                if ($fact > 10000000) {
                                    $s = round($fact / 10000000) + 1;
                                }
                            @endphp
                            @for ($j = $s; $j < $s + 6; $j++)
                                <li class="nav-item" style="margin-right:10px">
                                    <div class="card" style="width:180px; padding:15px;background:#ffffff">
                                        <div>
                                            <div class="text-center supercell" style="font-size:12px;font-weight:600">
                                                <img width="20" src="{{ asset('mobile/soqqa.png') }}" alt="Image">
                                                <span>{{ number_format(maosh($j * 10000000), 0, '', ' ') }}</span>
                                            </div>
                                            <div class="text-center supercell" style="font-size:12px;font-weight:600">
                                                <span>Plan: </span><span>{{ number_format($j * 10, 0, '', ' ') }}M</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                        @break

                        @default
                            @php
                                $s = 1;
                                if ($fact > 100000) {
                                    $s = round($fact / 100000) + 1;
                                }
                            @endphp
                            @for ($k = $s; $k < $s + 6; $k++)
                                <li class="nav-item" style="margin-right:10px">
                                    <div class="card" style="width:150px; padding:15px;background:#ffffff">
                                        <div>
                                            <div class="text-center supercell" style="font-size:12px;font-weight:600">
                                                <img width="20" src="{{ asset('mobile/soqqa.png') }}" alt="Image">
                                                <span>{{ number_format(maosh($k * 100000), 0, '', ' ') }}</span>
                                            </div>
                                            <div class="text-center supercell" style="font-size:12px;font-weight:600">
                                                <span>Plan: </span><span>{{ number_format($k * 100, 0, '', ' ') }}K</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endfor
                    @endswitch
                </ul>
            </div>
        </div>
        @if ($medicineShow)
            <div class="col-12  " style="background:#eeeeee;margin:20px 0;border-radius:10px;">
                <div class="text-center supercell py-3" style="font-size:15px" data-toggle="collapse"
                    data-target="#dorilarHammasi" aria-expanded="true" aria-controls="dorilarHammasi">
                    Dorilar plani
                </div>
                <div id="dorilarHammasi" class="collapse" aria-labelledby="headingThree">
                    <div class="table-responsive" style="background: #fff;border:1px solid #fff">
                        <table class="table border table-bordered table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Preparat</th>
                                    <th>Bajarildi</th>
                                    <th>Plan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicines as $medicine)
                                    <tr>
                                        <td>{{ $medicine->id }}</td>
                                        <td>{{ $medicine->name }}</td>
                                        <td class="text-center">{{ $medicine->fact }}</td>
                                        <td class="text-center">{{ $medicine->plan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    @endif

    <style>
        .planscrollbar::-webkit-scrollbar {
            display: none
        }
    </style>
</div>
