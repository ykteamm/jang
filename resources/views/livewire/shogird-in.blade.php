<div>
    @if ($resime == 2)
        
        @foreach (getShogirdUser() as $item)
            <div class="modal fade" id="myshogirdin{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                                <img src="{{asset('mobile/vil.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                                </button>
                        </div>
                        <div class="modal-body p-0">

                            <div class="container p-0">
                                <div class="mb-3 pt-3">
                                    @foreach (getShogirdDay($item->id) as $item)
                                    <div class="col-12   pl-0 pr-0">
                                        <div class="card border-0 m-2">
                                            <div class="pb-1 text-center" style="background: #dfe7f2;border-radius:15px;border:1px solid #666464">
                                                <div class="card-header" style="padding: 5px 25px;background:#20caf4;">
                                                    <div class="d-flex align-items-center justify-content-between text-blue-800">
                                                        <div style="font-weight:500">{{$item['day']}} - kun</div>
                                                        <div style="font-weight:500">
                                                            {{ date('d.m.Y',strtotime($item['open'])) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-12">
                                                        <h5 class="">{{$item['dm'][0]->name}} kuni</h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between pl-3 pr-3" >
                                                    <div>
                                                        <button type="button" class="mb-2 btn btn-block btn-sm btn-primary pr-3 pl-3" style="background: @if($item['make'] >= 150000) #44ea355c @else #be5858ba @endif ;border-radius: 10px;">
                                                            <div style="background: #1e136b;border-radius: 10px;" class="pr-4 pl-4">
                                                                Kun dorilari
                                                            </div>
                                                            <span style="color:#1e136b;">{{number_format($item['make'],0,',',' ')}} so'm</span>
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="mb-2 btn btn-block btn-sm btn-primary pr-3 pl-3" style="background: @if($item['make_other'] >= 150000) #44ea355c @else #be5858ba @endif;border-radius: 10px;">
                                                            <div style="background: #1e136b;border-radius: 10px;" class="pr-4 pl-4">
                                                                Boshqa dorilar
                                                            </div>
                                                            <span style="color:#1e136b;">{{number_format($item['make_other'],0,',',' ')}} so'm</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="accordion">
                                                            <div class="">
                                                                {{-- <div style="background-color:#ccd4ee69" class="card-header border border-black text-center p-1"
                                                                    id="headingTwo{{$item['day']}}">
                                                                </div> --}}
                                                                <div class="card-body">
                                                                    <div id="collapseTwo{{$item['day']}}" class="collapse"
                                                                        aria-labelledby="headingTwo{{$item['day']}}"
                                                                        data-parent="#accordion" style="background: #b6ccdf;
                                                                        padding: 10px 10px;
                                                                        border-radius: 8px;">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <div style="font-weight:500">Kun dorilari</div>
                                                                            <div style="font-weight:500">
                                                                                plan: 150 000 so'm
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <div style="font-weight:500">
                                                                                @foreach ($item['all_med'] as $medic)
                                                                                    <p class="m-0">{{$medic->name}}</p>
                                                                                @endforeach
                                                                            </div>
                                                                            <div style="font-weight:500">
                                                                                <div>
                                                                                    <button type="button" class="mb-1 btn btn-block btn-sm btn-primary pr-3 pl-3" style="background: #0a12280f;border-radius: 10px;">
                                                                                        <div style="background: #1e136b;border-radius: 10px;" class="pr-4 pl-4">
                                                                                            Bajarildi
                                                                                        </div>
                                                                                        <span style="color:#1e136b;">{{number_format($item['make'],0,',',' ')}} so'm</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div>
                                                                                    <button type="button" class="mb-1 btn btn-block btn-sm btn-primary pr-3 pl-3" style="background: #0a12280f;border-radius: 10px;">
                                                                                        <div style="background: #1e136b;border-radius: 10px;" class="pr-4 pl-4">
                                                                                            Qoldi
                                                                                        </div>
                                                                                        <span style="color:#1e136b;">
                                                                                            @if ($item['make'] >= 150000)
                                                                                                0 so'm
                                                                                            @else
                                                                                                {{number_format((150000-$item['make']),0,',',' ')}} so'm</span>
                                                                                            @endif
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="collapseTwo{{$item['day']}}" class="collapse mt-2"
                                                                        aria-labelledby="headingTwo{{$item['day']}}"
                                                                        data-parent="#accordion" style="background: #b6ccdf;
                                                                        padding: 10px 10px;
                                                                        border-radius: 8px;">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <div style="font-weight:500">Boshqa dorilari</div>
                                                                            <div style="font-weight:500">
                                                                                plan: 100 000 so'm
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <div style="font-weight:500">Bajarildi</div>
                                                                            <div style="font-weight:500">
                                                                                {{number_format($item['make_other'],0,',',' ')}} so'm
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="p-0 text-center"
                                                                    id="headingTwo{{$item['day']}}">
                                                                    <button class="btn btn collapsed dropdown-toggle"
                                                                        data-toggle="collapse"
                                                                        data-target="#collapseTwo{{$item['day']}}"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseTwo{{$item['day']}}"
                                                                        style="font-size:16px;font-weight:600">
                                                                        Batafsil
                                                                    </button>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @endif

</div>
