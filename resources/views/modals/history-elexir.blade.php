<div class="modal fade" id="history-elexir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header p-0 pb-4" style="background: #a4adb8">
                        <div class="container p-0" style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
                            <span class="supercell text-white pl-3" style="font-size:25px;">ELEKSIR TARIXI</span>
                        </div>
                        {{-- <img src="{{asset('mobile/ks.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative"> --}}
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                                    </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="card mb-3 mt-3">
                                @foreach (historyElexir(Auth::id()) as $item)
                                        <div class="col-12 ">
                                            <div class="card border-0 mb-1">
                                                <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;">
                                                    <div class="row supercell align-items-center" style="font-size:13px;">
                                                        <div class="col text-right">
                                                            <span class="mb-1">{{date('d.m.Y',strtotime($item->start_day))}}-{{date('d.m.Y',strtotime($item->end_day))}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center supercell" style="font-size:13px;">
                                                        <div class="col pr-0">
                                                            <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="23px;">
                                                                +{{$item->elexir}}
                                                        </div>
                                                        <div class="col-auto text-right">
                                                                <span class="mb-1 text-primary">
                                                                    {{$item->reason}}
                                                                </span>
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