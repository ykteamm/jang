<div class="modal-body pt-0">
    @if ($resime == 2)

        <div>
            <img src="{{ asset('mobile/roundlar.png') }}" alt="Image" width="111%"
                style="margin-left: -20px">
        </div>
        <div class="card mb-3">
            <div class="card-footer">
                <div class="row mb-4">
                    <div class="col p-0">
                        @foreach ($myTeamBattle as $month => $info)
                            <div class="card rounded rounded-1 mb-3" style="background: #8952c7 !important">
                                <div class="card-header p-0">
                                    <div class="w-100 supercell text-center text-white pt-2">
                                        {{ getMonthName($month) }}
                                        @if (isset($info['battles'][0]['year']))
                                            {{ $info['battles'][0]['year'] }}
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-white py-0 px-2">
                                    @php
                                        if ($info['info']['team1']['sum'] > $info['info']['team2']['sum']) {
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
                                                {{ $info['info']['team1']['name'] }}</div>
                                            <div class="mt-1 w-100">
                                                <button
                                                    class="w-100 btn btn-sm supercell text-white"
                                                    style="font-size:10px;background: {{ $win }}">{{ number_format($info['info']['team1']['sum'] , 0, ',', ' ') }}</button>
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-center ">
                                            <img src="{{ asset('mobile/king/bat.png') }}"
                                                alt="Image" width="30">
                                        </div>
                                        <div class="col-5 align-items-center pl-0">
                                            <div class="supercell"
                                                style="font-size:10px;text-align:end">
                                                {{ $info['info']['team2']['name'] }}</div>
                                            <div class="mt-1 w-100">
                                                <button
                                                    class="w-100 btn btn-sm supercell text-white"
                                                    style="font-size:10px;background: {{ $lose }}">{{ number_format($info['info']['team2']['sum'] , 0, ',', ' ') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0"></div>
                            </div>
                            <div id="usersAccordion">
                                @foreach ($info['battles'] as $key => $item)
                                    <div class="col-12 p-0">
                                        <div class="card mb-3 " style="border:1px solid #000">
                                            <div class="card-header text-white text-center py-1"
                                                style="background: #7a51ac" data-toggle="collapse"
                                                data-target="#usersTeam{{ $key }}"
                                                aria-expanded="false"
                                                aria-controls="usersTeam{{ $key }}">
                                                <div class="supercell" style="font-size:11px">
                                                    {{ $item['round'] }} - round
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 bg-light">
                                                @php
                                                    if ($item['team1_sum'] > $item['team2_sum']) {
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
                                                            {{ $item['team1_name'] }}</div>
                                                        <div class="mt-1 w-100">
                                                            <button
                                                                class="w-100 btn btn-sm supercell text-white"
                                                                style="font-size:10px;background: {{ $win }}">{{ number_format($item['team1_sum'], 0, ',', ' ') }}</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 d-flex align-items-center ">
                                                        <img src="{{ asset('mobile/king/bat.png') }}"
                                                            alt="Image" width="30">
                                                    </div>
                                                    <div class="col-5 align-items-center pl-0">
                                                        <div class="supercell"
                                                            style="font-size:10px;text-align:end">
                                                            {{ $item['team2_name'] }}</div>
                                                        <div class="mt-1 w-100">
                                                            <button
                                                                class="w-100 btn btn-sm supercell text-white"
                                                                style="font-size:10px;background: {{ $lose }}">{{ number_format($item['team2_sum'], 0, ',', ' ') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="usersTeam{{ $key }}" class="collapse"
                                                    aria-labelledby="usersTeam{{ $key }}"
                                                    data-parent="#usersAccordion">
                                                    <div class="row py-2">
                                                        <div class="col-5 align-items-center pr-0">
                                                            <div class="row">
                                                                @foreach ($item['team1_users'] as $user)
                                                                    <div class="col-6 px-1 py-1">
                                                                        <div
                                                                            style="border-radius:50%;overflow:hidden;width:50px;height:50px">
                                                                            <img src="{{ $user->i }}"
                                                                                alt="Image" width="50">
                                                                        </div>
                                                                        <div class="supercell"
                                                                            style="font-size:8px">
                                                                            {{ $user->f }}</div>
                                                                        <div><button
                                                                                class="btn btn-sm text-white w-100 p-0"
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
                                                                @foreach ($item['team2_users'] as $user)
                                                                    <div class="col-6 px-1 py-1">
                                                                        <div
                                                                            style="border-radius:50%;overflow:hidden;width:50px;height:50px">
                                                                            <img src="{{ $user->i }}"
                                                                                alt="Image" width="50">
                                                                        </div>
                                                                        <div class="supercell"
                                                                            style="font-size:8px">
                                                                            {{ $user->f }}</div>
                                                                        <div><button
                                                                                class="btn btn-sm text-white w-100 p-0"
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
                                                <button class="btn btn collapsed dropdown-toggle"
                                                    data-toggle="collapse"
                                                    data-target="#usersTeam{{ $key }}"
                                                    aria-expanded="false"
                                                    aria-controls="usersTeam{{ $key }}"
                                                    style="font-size:16px;font-weight:600">
                                                    Elchilar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>
