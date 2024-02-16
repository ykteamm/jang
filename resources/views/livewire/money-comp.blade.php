
<div class="swiper-slide overflow-hidden text-center">
    @if ($resime == 2)

        @if(Auth::user()->id != 5 || Auth::user()->specialty_id != 9)
        @if (Auth::user()->specialty_id == 1)

        <button
            style="position: absolute;top:10px;right:0px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
            type="button" class="rounded d-flex align-items-center justify-content-center" data-toggle="popover"
            title="Kunlik sotuv" data-content=" Kunlik ish haqi sotuvingizdan kelib chiqadi!" data-placement="left">
            <img width="20" class="instruksiya" src="{{ asset('mobile/instruksiya.png') }}" alt="Instruksiya">
        </button>

            @foreach (getMonthM(2) as $key => $item)
                <div class="bg-primary"
                        onclick="liveMoneyModal()" data-toggle="modal" data-target="#money" style="cursor:pointer"
                >
                    <div class="mt-2 px-2 bg-amber rounded text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-3 supercell pt-2" style="text-align:center">
                                {{ getMonthName($item['month_name']) }}
                            </h3>
                            @php
                                $getPremya = getPremya($item['date_begin'], $item['date_end']);
                                $getPremyaDefault = getPremyaDefault($item['date_begin'], $item['date_end']);
                                $getShtrafDefault = getShtrafDefault($item['date_begin'], $item['date_end']);
                                $getP = 0;
                                $getPD = 0;
                                $getSH = 0;
                            @endphp
                            @if (count($getPremya) > 0 || count($getPremyaDefault) > 0)
                                @foreach ($getPremya as $gp)
                                    @php
                                        $getP = $getP + $gp->premya->premya;
                                    @endphp
                                @endforeach
                                @foreach ($getPremyaDefault as $gp)
                                    @php
                                        $getPD = $getP + $gp->price;
                                    @endphp
                                @endforeach
                            @endif
                            @foreach ($getShtrafDefault as $gp)
                                @php
                                    $getSH = $getSH + $gp->price;
                                @endphp
                            @endforeach

                            @if (Auth::user()->specialty_id == 9)
                            <h5 style="font-weight:700">
                                {{ number_format(getpdold(), 0, ',', ' ') }}
                                <span style="font-size:14px">so'm</span>
                            </h5>
                            @elseif(Auth::user()->specialty_id == 1)
                            <h5 style="font-weight:700">
                                {{ number_format($item['maosh'] - $item['jarima'] + $getPD + $getP - $getSH, 0, ',', ' ') }}
                                <span style="font-size:14px">so'm</span>
                            </h5>
                            @else
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach

        <div id="topWishMarket">
        </div>
        <div>
            <livewire:money />
        </div>
        @endif

        @endif
        <div class="w-100">
            <livewire:plan :medicineShow="false">
        </div>
        <div class="container pl-0 pr-0">
            <div class="row">
                <div class="col-12 pl-0 pr-0">

                    <button type="button" class="btn pr-0 change-team-time live_market_bonus" onclick="liveMarket()" data-toggle="modal" data-target="#bonus">
                        <img src="{{ asset('mobile/market2233.png') }}" class="for-media-img" width="160px"
                            alt="">
                    </button>
                </div>
            </div>
        </div>

    @endif

</div>
