<div class="modal fade" id="smenaclose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <form method="post" action="{{route('shift.close')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="form-group text-center">
                        <label>Smena yopish kodi: 
                            <span class="close-code"></span>
                            <input type="text" value="" name="close_code" class="d-none">
                        </label>
                    </div>
                    <div class="form-group text-center btn-block">
                        {{-- <label for="choose-file-user-close" class="custom-file-upload" id="choose-file-label-user"> --}}
                            Selfini tanlang
                        {{-- </label>     --}}
                        <input name="close_selfi" type="file"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="for-close-smena-user-none">
                <button type="submit" 
                onclick="$('#for-close-smena-user-none').addClass('d-none');$('#for-close-smena-user').removeClass('d-none');" 
                class="btn btn-success">Smena yopish</button>
            </div>
            <div class="modal-footer d-none" id="for-close-smena-user">
                <button type="button" class="btn btn-primary">Biroz kuting !!!</button>
            </div>
            </form>
        </div> 
    </div>
</div>