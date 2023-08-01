@foreach (getLigasUserId() as $item)
<div class="modal fade" id="ksb{{$item}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6>
                    {{getUser($item)->last_name}} {{substr(getUser($item)->first_name,0,1)}} ni duelga taklif qilish
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="card-footer">
                        <form action="{{route('ksb')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Comment yozing</label>
                                <input type="comment" name="comment" class="form-control"  placeholder="Comment..." required>
                            </div>
                            <div class="form-group d-none">
                                <input type="user_id" name="user_id" class="form-control"  value="{{$item}}">
                            </div>
                            <div class="text-right" id="for-ksb-offer-{{$item}}">
                                <button 
                                onclick="$(`#for-ksb-offer-{{$item}}`).addClass('d-none');$(`#for-ksb-offer{{$item}}`).removeClass('d-none');"
                                type="submit" class="mb-2 btn btn-primary">Taklif yuborish</button>
                            </div>
                            <div class="text-right d-none" id="for-ksb-offer{{$item}}">
                                <button type="button" class="mb-2 btn btn-primary">Biroz kuting</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
