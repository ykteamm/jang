<div class="modal fade" id="first-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="height: 100%">
        <div class="modal-content" style="background-image: url('/promo/dist/img/promo/bg2.png');
            background-repeat: no-repeat;">
            <div class="modal-body p-0">
                <div class="container">
                    <img src="{{asset('mobile/upheader.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                    <button type="button" class="close d-none" data-dismiss="modal" id="first-view-close22" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
                </div>
                <div class="container p-0">
                    <h2 class="text-white text-center">Salom {{Auth::user()->first_name}} !</h2>

                    <h4 class="text-white text-center">Sizda yangi 
                        @if (count(getShogird()) > 1)
                        shogirdlar
                        @else
                        shogird
                        @endif
                         bor 7 kun davomida 
                         @if (count(getShogird()) > 1)
                         ularga
                         @else
                         unga
                         @endif bilim va ko'nikmalar berasiz.
                    </h4>

                    
                    
                    <div class="col-md-12">
                        <button type="button" class="mb-2 btn btn-sm btn-block btn-success" onclick="firstViewSuccess()">Tasdiqlayman</button>
                    </div>
                    {{-- <button>Tasdiqlayman</button> --}}

                </div>
            </div>
        </div>
    </div>
</div>
