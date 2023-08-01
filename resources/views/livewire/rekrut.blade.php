<div class="modal-content">
    @if ($resime == 2)
        
        <div class="modal-header">
            <div class="container p-0"
            style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
            <span class="supercell text-white pl-3" style="font-size:25px;">REKRUT</span>
        </div>
        {{-- <img src="{{asset('mobile/ks.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative"> --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="opacity: 5;position:absolute;top:8px;right:10px;">
            <img src="{{ asset('mobile/xclose.png') }}" width="30px">
        </button>
        </div>
        <div class="modal-body p-0">

            <div class="container p-0">
                <div class="pt-3">
                    @foreach (getRekrut() as $key => $item)
                    <form action="{{route('rekrut.check',$item->id)}}" id="rekrutform{{$item->id}}" method="POSt">
                        @csrf

                        <div class="col-12 mb-3">
                            <div class="container p-1" style="background:#3ad1717d;border-radius:13px;" data-toggle="modal" data-target="#new-elchi">
                                    <div class="border-0 mb-1">
                                        <div class="card-body" style="border-radius:15px;">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-sm btn-secondary " style="background: #e0aa2c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        @if ($item->status == 0)
                                                            Ko'rilmagan
                                                        @elseif($item->status == 1)
                                                            Tasdiqlandi
                                                        @else
                                                            Bekor qilindi
                                                        @endif
                                                    </button>
                                                </div>
                                                <div class="col-auto ml-auto mr-3">
                                                    <span class="mb-1" style="color: #272730;font-size:12px">{{$item->fname}}</span>
                                                </div>
                                            </div>

                                            <div class="align-items-center mt-2">
                                                <textarea id="rekruting{{$item->id}}" name="comment" placeholder="Sababini yozing..." rows="4" style="width: 100%" @if ($item->comment != NULL) disabled  @endif>@if ($item->comment != NULL) {{$item->comment}}  @endif</textarea>
                                            </div>

                                            @if ($item->comment == NULL)
                                                <div class="row align-items-center rekrutbutton">
                                                    <div class="col-6">
                                                        <button
                                                        onclick="rekrutCancel({{$item->id}})"
                                                        type="button" class="btn btn-sm btn-secondary " style="background: #c70f0f;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            Rad qilish
                                                        </button>
                                                    </div>
                                                    <div class="col-auto ml-auto mr-3">
                                                        <button
                                                        onclick="rekrutSuccess({{$item->id}})"
                                                        type="button" class="btn btn-sm btn-secondary " style="background: #05af05;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            Qabul qilish
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center d-none rekrutbutton2">
                                                    <div class="col-12">
                                                        <button
                                                        type="button" class="btn btn-sm btn-secondary " style="background: #0f3ac7;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            Biroz kuting
                                                        </button>
                                                    </div>
                                                </div>
                                                <input class="d-none rekrutinput{{$item->id}}" type="number" name="status">
                                            @endif
                                        </div>
                                    </div>
                            </div>


                        </div>

                        </div>
                </form>

                    @endforeach
                </div>
            </div>
        </div>
        
    @endif

</div>