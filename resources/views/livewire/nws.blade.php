@case('king')
    @isset($nwDetail)
        @foreach ($nwDetail as $ligaImage => $ligaItems)
            <div class="m-0 mt-3">
                <img src="{{ asset("mobile/king/$ligaImage.png") }}" width="105%"
                    style="border-radius:15px;margin-left: -9px;margin-top:-2px;position:relative">
            </div>
            @php
                $i = 0;
            @endphp
            @foreach ($ligaItems as $key => $item)
                @php
                    if ($i == 0) {
                        $color = 'e0aa2c';
                    }
                    if ($i == 1) {
                        $color = 'bdccdb';
                    }
                    if ($i == 2) {
                        $color = 'cc8448';
                    }
                    if (!in_array($i, [0, 1, 2])) {
                        $color = '8d9eb8';
                    }
                @endphp
                <div class="col-12  supercell">
                    <div class="card border-0 mb-1">
                        <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;">
                            <div class="row align-items-center m-0 p-0">
                                <div class="col-2 pl-0">
                                    <button type="button" class="btn btn-sm btn-secondary supercell"
                                        style="background: #{{ $color }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                        {{ $i + 1 }}
                                    </button>
                                </div>
                                <div class="col-4 pl-0">
                                    <span class="mb-1" style="color: #272730;font-size:11px">{{ $item->f }}
                                        {{ substr($item->l, 0, 1) }}</span>
                                    <p style="color: #272730;font-size:10px;color:#6c757d;">
                                        {{ setRegionTosh($item->r) }}
                                    </p>
                                </div>
                                <div class="col-1 pl-0 pr-1 text-right">

                                    @if ($item->id != Auth::id() && !in_array($item->id, getKSBId()) && !in_array(Auth::id(), getKSBId()))
                                        <button style="background: transparent;border:none" data-toggle="modal"
                                            data-target="#ksb{{ $item->id }}">
                                            <img src="{{ asset('mobile/king/bat.png') }}" width="30px;">
                                        </button>
                                    @endif
                                </div>
                                <div class="col-5 pl-2 pr-0">
                                    <div class="d-flex align-items-center justify-content-between supercell text-white btn px-1 ml-3"
                                        style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                        <div>
                                            <img src="{{ asset('mobile/king-sold.webp') }}" width="23px;">
                                        </div>
                                        <div>
                                            {{ $item->count }}@if (isset($get_ksb_bonus[$item->id]))
                                                +{{ $get_ksb_bonus[$item->id] }}
                                            @endif
                                        </div>

                                        @if (json_decode($nw['info'])->weekStartDate >= '2023-03-04')
                                            <div>
                                                <a
                                                    href="{{ route('view.check', ['user_id' => $item->id, 'date_begin' => json_decode($nw['info'])->weekStartDate, 'date_end' => json_decode($nw['info'])->weekEndDate]) }}">
                                                    <span aria-hidden="true">
                                                        <i class="material-icons"
                                                            style="color:#107a0e;font-size:20px;">visibility</i>
                                                    </span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $i = $i + 1;
                @endphp
            @endforeach
        @endforeach
    @endisset
@break

@case('team')
    @isset($nwDetail)
        <div class="container" id="usersAccordion">
            @foreach ($nwDetail as $key => $item)
                <div class="col-12  p-0">
                    <div class="card mb-3 " style="border:1px solid #000">
                        <div class="card-header text-white text-center py-1" style="background: #476edb" data-toggle="collapse"
                            data-target="#usersTeam{{ $key }}" aria-expanded="false"
                            aria-controls="usersTeam{{ $key }}">
                            <div class="supercell" style="font-size:11px">
                                {{ $item['round'] }} - round
                            </div>
                        </div>
                        <div class="card-body pt-0 bg-light">
                            @php
                                if ($item['team1']['sum'] > $item['team2']['sum']) {
                                    $win = '#20a90fe0';
                                    $lose = '#b32d39de';
                                } else {
                                    $lose = '#20a90fe0';
                                    $win = '#b32d39de';
                                }
                            @endphp
                            <div class="row py-2">
                                <div class="col-5 align-items-center pr-0">
                                    <div class="supercell" style="font-size:10px">
                                        {{ $item['team1']['name'] }}</div>
                                    <div class="mt-1 w-100">
                                        <button class="w-100 btn btn-sm supercell text-white"
                                            style="font-size:10px;background: {{ $win }}">{{ number_format($item['team1']['sum'], 0, ',', ' ') }}</button>
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center ">
                                    <img src="{{ asset('mobile/king/bat.png') }}" alt="Image" width="30">
                                </div>
                                <div class="col-5 align-items-center pl-0">
                                    <div class="supercell" style="font-size:10px;text-align:end">
                                        {{ $item['team2']['name'] }}</div>
                                    <div class="mt-1 w-100">
                                        <button class="w-100 btn btn-sm supercell text-white"
                                            style="font-size:10px;background: {{ $lose }}">{{ number_format($item['team2']['sum'], 0, ',', ' ') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div id="usersTeam{{ $key }}" class="collapse"
                                aria-labelledby="usersTeam{{ $key }}" data-parent="#usersAccordion">
                                <div class="row py-2">
                                    <div class="col-5 align-items-center pr-0">
                                        <div class="row">
                                            @foreach ($item['team1']['members'] as $user)
                                                <div class="col-6 px-1 py-1">
                                                    <div style="border-radius:50%;overflow:hidden;width:50px;height:50px">
                                                        <img src="{{ $user->i }}" alt="Image" width="50">
                                                    </div>
                                                    <div class="supercell" style="font-size:8px">
                                                        {{ $user->f }}</div>
                                                    <div><button class="btn btn-sm w-100 p-0 text-white"
                                                            style="font-size:10px;background: {{ $win }}">{{ number_format($user->allprice, 0, '', ' ') }}</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex align-items-center ">

                                    </div>
                                    <div class="col-5 align-items-center pl-0">
                                        <div class="row">
                                            @foreach ($item['team2']['members'] as $user)
                                                <div class="col-6 px-1 py-1">
                                                    <div style="border-radius:50%;overflow:hidden;width:50px;height:50px">
                                                        <img src="{{ $user->i }}" alt="Image" width="50">
                                                    </div>
                                                    <div class="supercell" style="font-size:8px">
                                                        {{ $user->f }}</div>
                                                    <div><button class="btn btn-sm w-100 p-0 text-white"
                                                            style="font-size:10px;background: {{ $lose }}">{{ number_format($user->allprice, 0, '', ' ') }}</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border p-0 text-center">
                            <button class="btn btn collapsed dropdown-toggle" data-toggle="collapse"
                                data-target="#usersTeam{{ $key }}" aria-expanded="false"
                                aria-controls="usersTeam{{ $key }}" style="font-size:16px;font-weight:600">
                                Elchilar
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset
@break
