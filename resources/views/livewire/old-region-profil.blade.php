<div class="modal-content"
    style="background-image: url('/promo/dist/img/promo/bg2.png');
    background-repeat: no-repeat;">
    <div class="modal-body p-0">
        <div class="container">
            <img src="{{ asset('mobile/upheader.png') }}" width="111%"
                style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style="opacity: 5;position:absolute;top:6px;right:10px;">
                <img src="{{ asset('mobile/xclose.png') }}" width="30px">
            </button>
        </div>
        <div class="container p-0">
            @foreach (allRegion() as $item)
                <button type="button" id='region-profil{{ $item->id }}'
                    class="mb-2 d-none btn btn-sm deletecolor btn-info"
                    wire:click="$emit('regionlive',{{ $item->id }})">
                    <span class="supercel-text-stroke">Shu hafta</span>
                </button>
            @endforeach

            <div class="container">
                <div class="row mb-3 mt-3">
                    <div class="col-4">
                        <div class="text-center mb-1 d-flex justify-content-center align-items-center"
                            style="
                            height:60px;
                            border-radius: 10px;
                            background:#006791a6;
                            border: 2px solid #1abac6;
                        ">
                            {{-- <img src="{{asset($item->_url)}}" width="35px" alt=""> --}}
                        </div>
                    </div>
                    <div class="col-8 text-center mt-3">
                        @isset($reg)
                            <h4 class="text-white supercell">
                                {{ substr($reg->name, 0, strpos($reg->name, ' ')) }}
                            </h4>
                        @endisset
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                            style="background: #083f6694;border-radius: 8px;">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('mobile/kb.png') }}" width="23px;">
                                </div>
                                <div class="col-9 pl-0 pr-2">
                                    <div class="supercell"
                                        style="background: #05223b78;border-radius: 4px;margin-top:2px;">
                                        {{ number_format($kubok, 0, ',', ' ') }}
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                            style="background: #083f6694;border-radius: 8px;">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('mobile/king-sold.webp') }}" width="23px;">
                                </div>
                                <div class="col-9 pl-0 pr-2">
                                    <div class="supercell"
                                        style="background: #05223b78;border-radius: 4px;margin-top:2px;">
                                        {{ number_format($king_sold, 0, ',', ' ') }}
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-12">
                        <button type="button" class="mb-2 btn btn-block btn-sm btn-info"
                            style="background: #083f6694;border-radius: 8px;">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('mobile/oltin.png') }}" width="23px;">
                                </div>
                                <div class="col-9 pl-0 pr-2">
                                    <div class="supercell"
                                        style="background: #05223b78;border-radius: 4px;margin-top:2px;">
                                        {{ number_format($fact, 0, ',', ' ') }}
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            {{-- src="{{asset('mobile/upheader.png')}}" --}}
            <div class="container p-0 mt-5 pb-1" style="background:#98a8c3;border-radisu:10px !important;">
                <img src="{{ asset('mobile/upheader.png') }}" width="100%" style="margin-top: -30px;">
                <div class="mb-3">
                    @isset($users)
                        <div class="col-12  supercell pl-0 pr-0">
                            <div class="card border-0 mb-1">
                                <div class="card-body pt-1 pb-1 text-center"
                                    style="background: #dfe7f2;border-radius:15px;border:1px solid #666464">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h6 class="supercell"> Elchi soni </h6>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="supercell">{{ count($users) }} </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($users as $key => $item)
                            @php
                                if ($key == 0) {
                                    $color = 'e0aa2c';
                                }
                                if ($key == 1) {
                                    $color = 'bdccdb';
                                }
                                if ($key == 2) {
                                    $color = 'cc8448';
                                }
                                if (!in_array($key, [0, 1, 2])) {
                                    $color = '8d9eb8';
                                }
                            @endphp
                            <div class="col-12  supercell" data-toggle="modal" data-target="#user-profil"
                                onclick="upModal({{ $item->id }})">
                                <div class="card border-0 mb-1">
                                    <div class="card-body" class="pr-0"
                                        style="background: #c8d7ec;border-radius:15px;border:1px solid #666464">
                                        <div class="row align-items-center">
                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-secondary supercell"
                                                    style="background: #{{ $color }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                    {{ $key + 1 }}
                                                </button>
                                            </div>
                                            <div class="col-2 pl-0">
                                                <div class="container pl-0 pr-0">
                                                    <div class="avatar avatar-40  mx-auto shadow"
                                                        style="border-radius: 20px !important;">
                                                        <div class="background"
                                                            style="background-image: url({{ $item->image_url }});">
                                                            <img src="{{ $item->image_url }}" style="display: none;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0 pl-0">
                                                <span class="mb-1"
                                                    style="color: #272730;font-size:12px">{{ $item->first_name }}
                                                    {{ substr($item->last_name, 0, 1) }}</span>
                                                <p style="color: #272730;font-size:10px;color:#6c757d;">
                                                    @if ($grade[$item->id] > 30)
                                                        Oqsoqol
                                                    @else
                                                        Chaqaloq
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-1 pr-0 pl-0 text-right">
                                                <img src="{{ asset('mobile/oltin.png') }}" width="23px;">
                                            </div>
                                            <div class="col-3 pr-0">
                                                <button type="button" class="btn btn-sm btn-secondary supercell"
                                                    style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                    <span style="font-size:11px;">{{ numb($item->sold) }}</span>
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
