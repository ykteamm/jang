<div>
    @if ($resime == 2)
        @foreach (getShogirdUser() as $item)
            <div class="modal fade" id="shogirdin{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="padding: 0 !important;">
                            {{--                <img src="{{asset('mobile/vil.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">--}}
                            <div class="container p-0" style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
                                <span class="supercell text-white pl-3" style="font-size:25px;">{{$item->first_name}} {{$item->last_name}}</span>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                                <img src="{{asset('mobile/xclose.png')}}" width="30px">
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="container p-0">
                                <div class="mb-3 pt-3">
                                    @php
                                        $week = HaftalikShogirdStatistic($item->id);
                                        $month = OylikShogirdStatistic($item->id);
                                        $apteka = AptekaNomi($item->id)
                                    @endphp
                                    <div class="col-12   pl-0 pr-0">
                                        <div class="card border-0 " style="padding: 5px">
                                            <div class="pb-1 text-center" style="background: #dfe7f2;border-radius:15px;border:1px solid #666464">
                                                <div class="row align-items-center">
                                                    <div class="col-12 mb-3">
                                                        <button class="btn btn-success" style="margin: 10px;" type="button"   data-toggle="collapse" data-target="#savdo" aria-expanded="false" aria-controls="savdo">
                                                            Shogirdni savdolari
                                                        </button>
                                                    </div>

                                                    <div class="col-12 collapse" id="savdo">
                                                        <p class="row" style="justify-content: space-evenly; padding: 12px 0 12px 0; margin-bottom: 0 !important;">
                                                            <button class="col-4 btn btn-primary" type="button"   data-toggle="collapse" data-target="#haftalik" aria-expanded="false" aria-controls="haftalik">
                                                                Haftalik
                                                            </button>
                                                            <button class="col-4 btn btn-primary" type="button"   data-toggle="collapse" data-target="#oylik" aria-expanded="false" aria-controls="oylik">
                                                                Oylik
                                                            </button>
                                                        </p>
                                                        <div class="d-flex align-items-center" style="justify-content: space-evenly">
                                                            <div class="collapse" id="haftalik">
                                                                <div class="card card-body">
                                                                    {{$week}}
                                                                </div>
                                                            </div>
                                                            <div class="collapse" id="oylik">
                                                                <div class="card card-body">
                                                                    {{$month}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button class="btn btn-success" style="margin: 10px;" type="button"   data-toggle="collapse" data-target="#apteka" aria-expanded="false" aria-controls="apteka">
                                                            Shogirdni aptekasi
                                                        </button>
                                                    </div>
                                                    <div class="col-12 collapse" id="apteka">
                                                        <div class="card card-body">
                                                            @foreach($apteka as $apt)
                                                                {{$apt->name}}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    @endif
</div>
