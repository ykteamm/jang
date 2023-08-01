<div class="modal fade" id="change-profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <form method="post" action="{{route('change.profil')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Ism</label>
                        <input type="text" name="first_name" value="{{Auth::user()->first_name}}" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Ism</label>
                        <input type="text" name="last_name" value="{{Auth::user()->last_name}}" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nickname</label>
                        <input type="text" name="nickname" maxlength="7" value="{{Auth::user()->nickname}}" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput12">Telefon raqam</label>
                        <input type="text" name="phone_number" value="{{substr(Auth::user()->phone_number,4,9)}}" data-inputmask='"mask": "(99) 999-99-99"' data-mask name="phone" class="form-control" id="exampleFormControlInput12">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Saqlash</button>
            </div>
            </form>
        </div> 
    </div>
</div>