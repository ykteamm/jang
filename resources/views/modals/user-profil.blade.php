<div class="modal fade" id="user-profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content"
            style="background-image: url('/promo/dist/img/promo/bg2.png');background-repeat: no-repeat;">
            <div class="modal-body p-0">
                <div class="container">
                    <img src="{{ asset('mobile/upheader.png') }}" width="111%"
                        style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="opacity: 5;position:absolute;top:6px;right:10px;">
                        <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                    </button>
                </div>
                <livewire:user-profil />
            </div>
        </div>
    </div>
</div>
