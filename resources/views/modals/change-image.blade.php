<div class="modal fade" id="change-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <form method="post" action="{{route('change.image')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="form-group text-center btn-block">
                            Rasmingizni tanlang
                        <input name="change_image" type="file"/>
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