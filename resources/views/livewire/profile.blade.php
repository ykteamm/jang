<div class="container p-0">
    @if($resime == 2)
    <div class="container mt-2 mb-2" style="background: none;">

        <div class="row">
            <div class="col-6">
                <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                    style="background: #083f6694;border-radius: 8px;">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{ asset('mobile/kb.png') }}" width="23px;">
                        </div>
                        <div class="col-9 pl-0 pr-2">
                            <div class="supercell py-1"
                                style="font-size:16px;background: #05223b78;border-radius: 4px;margin-top:2px;">
                                {{ $kubok }}
                            </div>
                        </div>
                    </div>
                </button>
            </div>
            <div class="col-6">
                <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                    style="background: #083f6694;border-radius: 8px;">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{asset('mobile/'.LigasUser(Auth::id())->image)}}" width="23px;">
                        </div>
                        <div class="col-9 pl-0 pr-2">
                            <div class="supercell py-1"
                                style="font-size:16px;background: #05223b78;border-radius: 4px;margin-top:2px;">
                                @php
                                    if (LigasUser(Auth::id())->name == 'Default') {
                                        $liga_name = '---';
                                    }else{
                                        $liga_name = LigasUser(Auth::id())->name;

                                    }
                                @endphp
                                {{ $liga_name }}
                            </div>
                        </div>
                    </div>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                    style="background: #083f6694;border-radius: 8px;">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{ asset('mobile/king-sold.webp') }}" width="23px;">
                        </div>
                        <div class="col-9 pl-0 pr-2">
                            <div class="supercell py-1"
                                style="font-size:16px;background: #05223b78;border-radius: 4px;margin-top:2px;">
                                {{ $king_sold }}
                            </div>
                        </div>
                    </div>
                </button>
            </div>
            <div class="col-6">
                <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                    style="background: #083f6694;border-radius: 8px;">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{ asset('mobile/vs.png') }}" width="23px;">
                        </div>
                        <div class="col-9 pl-0 pr-2">
                            <div class="supercell py-1"
                                style="font-size:16px;background: #05223b78;border-radius: 4px;margin-top:2px;">
                                {{ $win_battle }}
                            </div>
                        </div>
                    </div>
                </button>
            </div>
        </div>
        <div  style="background: radial-gradient(#19182c, transparent);">
        <div>
            <div class="mb-2 mt-2">
                <img src="{{ asset('mobile/upline.png') }}" width="100%" alt="">
            </div>
            <div class="mb-4">
                <h3 class="supercell text-center text-white">Daraja</h3>
            </div>
        </div>
            <div style="font-size:11px; text-align:start;padding-left:11px;padding-top:11px" class="text-white supercell">
                Sotuv (shu vaqtgacha sotilgan)
            </div>
            <div class="row">
                @foreach ($prodaja_levels as $key => $prLevel)
                    <div class="col-4">
                        <div class="text-center mb-1 d-flex justify-content-center align-items-center">
                            <div @if ($prLevel['level'] > $prodaja_level) style="opacity: 0.5" @endif
                                style="position: relative;widht:100px;height:100px">
                                <img src="{{ asset('mobile/levels/pr' . $prLevel['level'] . '.png') }}" width="90px"
                                    alt="">
                                <div style="position: absolute;top:-10px;right:0;left:0;bottom:0"
                                    class="d-flex justify-content-center align-items-center">
                                    <span class="supercell text-white"
                                        style="font-size:11px">{{ $prLevel['value'] }}M</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="font-size:11px; text-align:start;padding-left:11px;" class="text-white supercell">
                G'alaba (elchi jangida qozonilgan g'alaba soni)
            </div>
            <div class="row">
                @foreach ($battle_levels as $key => $btLevel)
                    <div class="col-4">
                        <div class="text-center mb-1 d-flex justify-content-center align-items-center">
                            <div @if ($btLevel['level'] > $battle_level) style="opacity: 0.5" @endif
                                style="position: relative;widht:100px;height:100px">
                                <img src="{{ asset('mobile/levels/bt' . $btLevel['level'] . '.png') }}" width="100px"
                                    alt="">
                                <div style="position: absolute;top:-10px;right:0;left:0;bottom:0"
                                    class="d-flex justify-content-center align-items-center">
                                    <span class="supercell text-white"
                                        style="font-size:13px">{{ $btLevel['value'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="font-size:11px; text-align:start;padding-left:11px;" class="text-white supercell">
                Shox yurish (200 mindan ortiq savdo soni)
            </div>
            <div class="row">
                @foreach ($ksb_levels as $key => $ksbLevel)
                    <div class="col-4">
                        <div class="text-center mb-1 d-flex justify-content-center align-items-center">
                            <div @if ($ksbLevel['level'] > $ksb_level) style="opacity: 0.5" @endif
                                style="position: relative;widht:80px;height:80px">
                                <img src="{{ asset('mobile/levels/ksb' . $ksbLevel['level'] . '.png') }}"
                                    width="70px" alt="">
                                <div style="position: absolute;top:-10px;right:0;left:0;bottom:0"
                                    class="d-flex justify-content-center align-items-center">
                                    <span class="supercell text-white"
                                        style="font-size:13px">{{ $ksbLevel['value'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row" style="background: radial-gradient(#19182c, transparent)">
            <div class="container mb-2 mt-2">
                <img src="{{ asset('mobile/upline.png') }}" width="100%" alt="">
            </div>
            <div class="container mb-2">
                <h3 class="supercell text-center text-white">LIGALAR TARIXI</h3>
            </div>
            @isset($history_liga)
                @foreach ($history_liga as $key => $item)
                    <div class="col-3">
                        <div class="">
                            <div class="text-center mb-1 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('mobile/' . $item->image) }}" width="35px" alt="">
                            </div>
                            <div class="text-center">
                                <span style="color:#f67111;font-size:13px;" class="supercell">
                                    {{ strtoupper($key) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="row" style="background: radial-gradient(#19182c, transparent)">
            <div class="container mb-2 mt-4">
                <img src="{{ asset('mobile/upline.png') }}" width="100%" alt="">
            </div>
            <div class="container mb-2">
                <h3 class="supercell text-center text-white">DORILAR</h3>
            </div>
            @isset($sold_count)
                @foreach ($sold_count as $key => $item)
                    <div class="col-3">
                        <div class="">
                            <div class="text-center mb-1 d-flex justify-content-center align-items-center"
                                style="
                            height:60px;
                            border-radius: 10px;
                            background:#006791a6;
                            border: 2px solid #1abac6;
                            overflow:hidden
                        ">
                                @if ($item->img)
                                    <img src="{{ asset($item->img) }}" width="60px" alt="">
                                @else
                                    <img src="{{ asset('images/tea.webp') }}" width="60px" alt="">
                                @endif
                            </div>
                            <div class="mt-1 text-center text-white" style="font-size:11px;font-weight:800">
                                {{ $item->name }}
                            </div>
                            <div class="text-center">
                                <span style="color:#f67111;font-size:13px;" class="supercell">
                                    {{ $item->number }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
    @endif
</div>
