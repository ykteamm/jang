<div class="modal fade" id="teambattle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('mobile/bonuslar.png') }}" width="111%"
                    style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="opacity: 5;position:absolute;top:8px;right:10px;">
                    <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                </button>
            </div>
            <div class="modal-body pt-0">

                <livewire:team-battle500/>
            </div>
        </div>
    </div>
</div>
