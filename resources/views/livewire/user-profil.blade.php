<div class="container p-0">

    @isset($user)
        <div class="container-fluid text-center mb-1">
            <div class="avatar avatar-140  mx-auto shadow" style="border-radius: 20px !important;">
                <div class="background" style="background-image: url({{ $user->image_url }});">
                    <img src="{{ $user->image_url }}" style="display: none;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{-- <button type="button" class="mb-2 btn btn-block btn-sm btn-info" style="background: #083f6694;border-radius: 8px;"> --}}
                <h4 class="text-center supercell" style="font-size:20px;color:white;">{{ $user->last_name }}
                    {{ $user->first_name }}</h4>
                {{-- </button> --}}
            </div>
        </div>
    @endisset

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
                            <div class="supercell py-1" style="font-size:16px;background: #05223b78;border-radius: 4px;margin-top:2px;">
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
                            <img src="{{ asset('mobile/' . $liga_img) }}" width="23px;">
                        </div>
                        <div class="col-9 pl-0 pr-2">
                            <div class="supercell py-1" style="font-size:16px;background: #05223b78;border-radius: 4px;margin-top:2px;">
                                @php
                                    if ($liga_name == 'Default') {
                                        $liga_name = '---';
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
                            <div class="supercell py-1" style="font-size:16px;background: #05223b78;border-radius: 4px;margin-top:2px;">
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
                            <div class="supercell py-1" style="font-size:16px;background: #05223b78;border-radius: 4px;margin-top:2px;">
                                {{ $win_battle }}
                            </div>
                        </div>
                    </div>
                </button>
            </div>
        </div>
        <div class="row">
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
        <div class="row">
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
