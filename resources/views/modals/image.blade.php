<div class="modal fade" id="imageDownload" tabindex="-1" role="dialog" aria-labelledby="imageDownload" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-0">
                <button type="button" class="close p-3" style="font-size: 2rem" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0">
                <div class="d-flex justify-content-center align-items-center" style="">
                    <img src="{{ $winImage }}" style="width: 100%" alt="Image">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ $winImage }}" download="{{ $winImage }}" target="_blank"
                        class="py-1 px-2 d-flex justify-content-between align-items-center">
                        <img src="{{ asset('mobile/saqlash.png') }}" width="150px" alt="">
                    </a>
                    <a href="{{ 'https://t.me/share/url?url=' . $winImage }}" target="_blank"
                        class="py-1 px-2 d-flex justify-content-between align-items-center">
                        <img src="{{ asset('mobile/ulashish.png') }}" width="150px" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
