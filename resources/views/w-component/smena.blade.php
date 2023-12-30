<div class="swiper-slide overflow-hidden text-center">

    {{-- <livewire:money /> --}}
    <div class="row h-70">

        <div class="col align-self-center px-3 mt-3" style="position: relative">
            {{-- <button
                style="position: absolute;top:@if (count($shifts) == 1) 0px @else 27px @endif;right:12px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
                type="button" class="rounded d-flex align-items-center justify-content-center" data-toggle="popover"
                title="Smena"
                data-content="Smena- 9.00 da smena ochiladi, 18.00 da yopiladi. Selfida kun soni, oq xalat, beyjik bo'lishi shart! Selfi faqat aptekadan qabul qilinadi!"
                data-placement="left">
                <img width="20" class="instruksiya" src="{{ asset('mobile/instruksiya.png') }}" alt="Instruksiya">
            </button>
            @if ($message = Session::get('smena'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @foreach ($errors->all() as $error)
                        <p class="yellow-text font lato-normal center">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (count($shifts) == 1)
                <div class="col align-self-center pl-0 pr-0">
                    <div class="container mb-4 pl-0 pr-0">
                        <div class="row">
                            @foreach ($shifts as $item)
                                <div class="col-12 ">
                                    <div class="card border-0 mb-4">
                                        <div class="card-body">
                                            <div class="row align-items-center text-center">
                                                <div class="col-6 align-self-center">
                                                    <h6 class="mb-1 text-secondary">Dorixona</h6>
                                                    <p class="small text-secondary">{{ $item->pharmacy->name }}</p>
                                                </div>
                                                <div class="col-auto align-self-center border-left">
                                                    <h6 class="mb-1 text-secondary">Smena ochilgan</h6>
                                                    <p class="small text-secondary">
                                                        {{ date('d.m.Y H:i:s', strtotime($item->created_at)) }}</p>
                                                </div>
                                                <div class="col-12 align-self-center mt-3">
                                                    <button type="button" onclick="closeCode()"
                                                        class="btn btn-info btn-block rounded m-2" data-toggle="modal"
                                                        data-target="#smenaclose">
                                                        Smena yopish
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if ($makeCloseShift)
                <div class="btn btn-danger" onclick="openCode()" data-toggle="modal"
                data-target="#smena">
                    Smenagiz yopildi. <br>
                    Qaytadan smena oching
                </div>
            @endif
            <div class="container">
                @if (count($shifts) != 1)
                    {{-- <div class="row">
                        <div class="col-12 p-0">
                            <div class="card border-0 mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center text-center"> --}}
                                        {{-- <form method="post" action="{{route('shift.open')}}" enctype="multipart/form-data" style="display: contents;">
                                        {{ csrf_field() }}
                                        <div class="col-6 align-self-center">
                                            <h6 class="mb-1 text-secondary">Dorixona</h6>
                                            <select class="form-control" id="exampleFormControlSelect1" name="pharmacy">
                                                <option disabled selected hidden></option>
                                            @foreach ($pharmacy as $item)
                                                <option value="{{$item->pharmacy->id}}">{{$item->pharmacy->name}}</option>
                                            @endforeach
                                        </select>
                                        </div> --}}
                                        {{-- <div class="col-6 align-self-center border-left">
                                            <h6 class="mb-1 text-secondary">Kun soni</h6>
                                            <p class="small text-secondary open-code"></p>
                                            <input type="text" value="" name="open_code" class="d-none">
                                        </div>
                                        <div class="col-6 align-self-center">
                                            <div class="form-group text-center btn-block">
                                                Selfini tanlash
                                                <input name="open_selfi" type="file"/>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-center border-left" id="for-open-smena-user-none">
                                            <button type="submit"
                                            onclick="$('#for-open-smena-user-none').addClass('d-none');$('#for-open-smena-user').removeClass('d-none');"
                                            class="btn btn-success">Smena ochish</button>

                                        </div>
                                        <div class="col-6 align-self-center border-left d-none" id="for-open-smena-user">
                                                <button type="button" class="btn btn-primary">Biroz kuting !!!</button>
                                        </div> --}}
                                        {{-- </form> --}}

                                        {{-- <div class="col-12 align-self-center mt-3">
                                            <button type="button" onclick="closeCode()"
                                                class="btn btn-info btn-block rounded m-2" data-toggle="modal"
                                                data-target="#smenaclose">
                                                Smena yopish
                                            </button>
                                        </div> --}}
                                    {{-- </div>
                                </div>
                            </div> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                    <div class="card-body mb-3">
                        <button type="button" onclick="openCode()" class="mb-2 btn btn-lg btn-info" data-toggle="modal"
                            data-target="#smena">
                            SMENA
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-6">
                        {{-- @if (count($shifts) == 1)
                            <button type="button" onclick="openKassa()" class="mb-2 btn btn-block btn-lg btn-info"
                                data-toggle="modal" data-target="#openkassa">
                                KASSA
                            </button>
                        @else
                            <button type="button" class="mb-2 btn btn-block btn-lg btn-info" data-toggle="modal"
                                data-target="#kassa">
                                KASSA
                            </button>
                        @endif --}}
                    </div>
                    <div class="col-6">
                        <button type="button" class="mb-2 btn btn-block btn-lg btn-info live-hisobot" data-toggle="modal"
                            data-target="#hisbot">
                            HISOBOT
                        </button>
                    </div>
                        <div class="container pl-0 pr-0">
                            <div class="row">
                                @if (count(getShogirdUser()) > 0)

                                <div class="col-6 pl-0 pr-0">

                                    <button type="button" style="background: #8bd137" class="btn live-shogird"
                                        data-toggle="modal" data-target="#myshogird">
                                        Shogird
                                    </button>
                                </div>
                                @endif

                                @if (count(getRekrut()) > 0)
                                    <div class="col-6 pl-0 pr-0">

                                        <button type="button" style="background: #8bd137" class="btn live-rekrut"
                                            data-toggle="modal" data-target="#myrekrut">
                                            Rekrut
                                        </button>
                                    </div>
                                @endif


                                {{-- @if (count(mijoz()) > 0)
                                    <div class="col-6 pl-0 pr-0">

                                        <button type="button" style="background: #8bd137" class="btn"
                                            data-toggle="modal" data-target="#myrekrut">
                                            Mijoz
                                        </button>
                                    </div>
                                @endif --}}
                            </div>
                        </div>

                </div>
                <button type="button" class="mb-2 btn btn-lg btn-info d-none" data-toggle="modal" id="check"
                    data-target="#opencheck">
                    Check
                </button>

            </div>

        </div>

    </div>
    <div class="container">
        @isset($all_sold)
            <div class="row mb-3">
                <div class="col">
                    <h6 class="subtitle mb-0 text-center">Bugungi cheklar</h6>
                </div>
            </div>
        @endisset
        <div class="row overflow-auto" style="height: 450px;">
            @isset($all_sold)
                @foreach ($all_sold as $sold)
                    @php
                        $sum = 0;
                        $category = 0;
                        $categoryTea = 0;
                        $category = 0;
                        $categoryTea = 0;
                        foreach ($sold->sold as $key => $value) {
                            $sum += $value->price_product * $value->number;
                            if (in_array($value->medicine->category_id, getCategoryId())) {
                                $category += $value->number;
                            }
                            if (in_array($value->medicine->category_id, getCategoryTeaId())) {
                                $categoryTea += $value->number;
                            }
                        }
                    @endphp
                    <div class="col-12  mb-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1 text-secondary text-left">{{ number_format($sum, 0, ',', ' ') }}
                                        </h5>
                                        <p class="text-secondary text-left mb-0">
                                            {{ date('d.m.Y H:i', strtotime($sold->created_at)) }}</p>
                                        @if ($sum >= 200000 || ($category >= 1 && $categoryTea >= 2) || $categoryTea >= 4)
                                            <p class="text-secondary text-left"><span
                                                    class="badge badge-success badge-pill">shox yurish</span></p>
                                        @endif
                                    </div>
                                    <div class="col-auto pl-0 @if ($sum >= 200000 || ($category >= 1 && $categoryTea >= 2) || $categoryTea >= 4) mt-3 @else mt-1 @endif">
                                        <button class="btn bg-info rounded text-white" id="opencheck{{ $sold->id }}"
                                            data-toggle="modal" data-target="#check{{ $sold->id }}">
                                            Ko'rish
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
