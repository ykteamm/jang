<div class="modal fade" id="smena" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <form method="post" action="{{route('shift.open')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="form-group text-center">
                        <label for="exampleFormControlSelect1">Dorixona tanlang</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="pharmacy">
                                <option disabled selected hidden></option>
                            @foreach ($pharmacy as $item)
                                <option value="{{$item->pharmacy->id}}">{{$item->pharmacy->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label>Smena ochish kodi: 
                            <span class="open-code"></span>
                        </label>
                        <input type="text" value="" name="open_code" class="d-none">

                    </div>
                    <div class="form-group text-center btn-block">
                        {{-- <label for="choose-file-user" class="custom-file-upload" id="choose-file-label-user"> --}}
                            Selfini tanlash
                        {{-- </label>     --}}
                        <input name="open_selfi" type="file"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="for-open-smena-user-none">
                <button type="submit" 
                onclick="$('#for-open-smena-user-none').addClass('d-none');$('#for-open-smena-user').removeClass('d-none');" 
                class="btn btn-success">Smena ochish</button>
            </div>
            <div class="modal-footer d-none" id="for-open-smena-user">
                <button type="button" class="btn btn-primary">Biroz kuting !!!</button>
            </div>
            </form>
        </div> 
    </div>
</div>