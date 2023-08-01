<header class="header pt-0">
    <div class="row mt-0" style="flex-wrap: inherit">
        <div class="col-md-4 mt-0 pr-1" style="width: 30%;">
            <a href="/"><img src="{{asset('mobile/wdwd.png')}}" width="90px" alt=""></a>
        </div>
        @if (userme()->rm != 1 && userme()->rm != 2)
        <div class="pl-0 mt-3 pr-0">
            <div class="input-group pr-0">
                {{-- <input type="text" value="{{userBall()->ball}}" class="form-control" disabled style="border-top-right-radius: 18px !important;border-bottom-right-radius: 18px !important;height: calc(1.5em + 0.75rem + -6px);"> --}}
                <div class="input-group-append">
                    <button class="btn img-container" type="button" style="padding: 0px 0px;" data-toggle="modal" data-target="#history-kubok">
                        <img src="{{asset('mobile/kubok22.webp')}}" width="95px;" alt="">
                          <div class="text-block supercell">
                            {{number_format(userBall()->ball,0,',',' ')}}
                          </div>
                    </button>
                </div>
            </div>
        </div>
        <div class="pl-0 pr-0 mt-3 m-2">
            <div class="input-group">
                {{-- <input type="text" value="{{userElexir()->elexir}}" class="form-control" disabled style="border-top-right-radius: 18px !important;border-bottom-right-radius: 18px !important;height: calc(1.5em + 0.75rem + -6px);"> --}}
                <div class="input-group-append">
                    {{-- <button class="btn img-container" type="button" style="padding: 0px 0px;" data-toggle="modal" data-target="#history-elexir">
                        <img src="{{asset('mobile/elekser22.webp')}}" width="95px" alt="">
                        <div class="text-block supercell">
                            {{number_format(userElexir()->elexir,0,',',' ')}}
                          </div>
                    </button> --}}
                    <button class="btn img-container live-history-crystal" type="button" style="padding: 0px 0px;" data-toggle="modal" data-target="#history-crystal">
                        <img src="{{asset('mobile/crystall.webp')}}" width="95px" alt="">
                            <div class="text-block supercell" style="padding-right: 10px" id="userCrystallMain">
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @endif

        @if (userme()->specialty_id == 1 && userme()->rm == 0)

        <div class="pl-0 pr-0 mt-1 ml-1">
            <div class="input-group">
                <div class="input-group-append">
                    @php
                        $fact = numb(myFakt(userme()->id));
                        $strlen = strlen($fact);
                    @endphp
                    <button class="btn img-container click-plan live-liga" type="button" style="padding: 0px 0px;"
                                @if (userme()->status == 1)
                                    data-toggle="modal" data-target="#planuser"
                                @endif>
                        <img src="{{asset('mobile/'.LigasUser(Auth::id())->image)}}" width="60px" alt="">
                        <div style="position: absolute;
                        bottom: 27%;
                        @if($strlen == 1)
                        right: -1%;
                        @elseif($strlen == 2)
                        right: -13%;
                        @elseif($strlen == 3)
                        right: -23%;
                        @else
                        right: -31%;
                        @endif
                        color: white;
                        font-size:22px;
                        padding-left: 20px;
                        padding-right: 20px;">
                            <span class="badge bg-primary">{{$fact}}</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        @endif

    </div>
    {{-- <div class="@if(Route::current()->getName() != 'order') d-none @endif"> --}}
    <div class="order-header" style="display:none;">
    <div class="container mb-4 text-white">
        <div class="row my-3 h6 font-weight-normal">
            <div class="col">Buyurtma summasi</div>
            <div class="col text-right text-mute"><span class="summa-header">0</span></div>
        </div>
        <div class="row my-3 h6 font-weight-normal">
            <div class="col">Bonus</div>
            <div class="col text-right text-mute"><span class="bonus-header">0</span></div>
        </div>
        <hr>
    </div>
    <div class="container">
        <button type="button" id="submitBtn" class="btn btn-default btn-block rounded">Buyurtma berish</button>
    </div>
    </div>
</header>
