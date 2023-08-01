@if (count(myKSBattleHistory()))
    <div class="modal fade" id="myksbhistory{{Auth::id()}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content" style="background: #5f687c;">
                <div class="modal-header">
                    <img src="{{asset('mobile/jr.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                                </button>
                </div>
                <div class="modal-body p-0">
                    <div style="background: #e1edf1;border-radius:15px;" class="m-1 pt-3 pb-3">
                        @foreach (myKSBattleHistory() as $key => $value)
                        <div class="col-12 ">
                            <div class="card border-0">
                                
                                <div class="card-body" style="background: #898989;border-radius:15px;padding:20px;padding-bottom:5px !important;padding-top:5px !important">
                                    <div class="row supercell pt-1 pb-0" style="font-size:10px;background: #e8b331;border-top-left-radius:15px;border-top-right-radius:15px;height:3.4em;">
                                        <div class="col pl-0">
                                        </div>
                                        <div class="col-auto">
                                            <span  style="font-size:13px;-webkit-text-stroke: 1px #363b3d;color:#ffffff;">
                                                {{date('d.m',strtotime($value->start_date))}} - {{date('d.m',strtotime($value->end_date))}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row supercell p-2" style="background: #ffffff;border-bottom-left-radius:15px;border-bottom-right-radius:15px;">
                                            <div class="col-5">
                                                <div class="rounded-circle mb-1 bg-default-light text-default" style="width: 85px">
                                                    @if (Auth::user()->id == $value->offer_uids->id)
                                                        @if (isset($value->offer_uids->image_url))
                                                        <img src="{{$value->offer_uids->image_url}}" height="85px" alt="" style="border-radius: 50%;">
                                                        @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg" height="85px" alt="">
                                                        @endif
                                                    @else
                                                        @if (isset($value->accept_uids->image_url))
                                                        <img src="{{$value->accept_uids->image_url}}" height="85px" alt="" style="border-radius: 50%;">
                                                        @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg" height="85px" alt="">
                                                        @endif
                                                    @endif
                                                </div>
                                                <p class="text-dark mb-1" style="font-size:14px;">
                                                    @if (Auth::user()->id == $value->offer_uids->id)
                                                    {{$value->offer_uids->first_name}} {{substr($value->offer_uids->last_name,0,1)}}
                                                    @else
                                                        {{$value->accept_uids->first_name}} {{substr($value->accept_uids->last_name,0,1)}}
                                                    @endif
                                                </p>

                                                @if ($value->start == 1)
                                                <button style="font-size:10px;background: #0c2237;" class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                    @if (Auth::user()->id == $value->offer_uids->id)
                                                    {{getKSCount($value->offer_uids->id,$value->start_date,$value->end_date)}}
                                                    @else
                                                    {{getKSCount($value->accept_uids->id,$value->start_date,$value->end_date)}}
                                                    @endif
                                                </button>
                                                @endif

                                            </div>
                                            <div class="col-2 col-md-2 text-center pt-4" style="padding-left: 31px !important">
                                                <img src="{{asset('mobile/vs.png')}}" width="50px" style="border-radius:15px;margin-left: -28px;margin-top:-5px;">
                                            </div>
                                            <div class="col-5 text-right">
                                                <div class="rounded-circle mb-1 bg-default-light text-default" style="width: 85px;margin-left:1.5em !important">
                                                    @if (Auth::user()->id != $value->offer_uids->id)
                                                        @if (isset($value->offer_uids->image_url))
                                                        <img src="{{$value->offer_uids->image_url}}" height="85px" alt="" style="border-radius: 50%;">
                                                        @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg" height="85px" alt="">
                                                        @endif
                                                    @else
                                                        @if (isset($value->accept_uids->image_url))
                                                        <img src="{{$value->accept_uids->image_url}}" height="85px" alt="" style="border-radius: 50%;">
                                                        @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg" height="85px" alt="">
                                                        @endif
                                                    @endif
                                                </div>
                                                    <p class="text-dark mb-1" style="font-size:14px;">
                                                        @if (Auth::user()->id != $value->offer_uids->id)
                                                    {{$value->offer_uids->first_name}} {{substr($value->offer_uids->last_name,0,1)}}
                                                    @else
                                                        {{$value->accept_uids->first_name}} {{substr($value->accept_uids->last_name,0,1)}}
                                                    @endif
                                                    </p>
                                                @if ($value->start == 1)

                                                <button style="font-size:10px;background: #0c2237;" class="btn btn-sm btn-default rounded mb-1" id="addtohome">
                                                    @if (Auth::user()->id != $value->offer_uids->id)
                                                    {{getKSCount($value->offer_uids->id,$value->start_date,$value->end_date)}}
                                                    @else
                                                    {{getKSCount($value->accept_uids->id,$value->start_date,$value->end_date)}}
                                                    @endif
                                                </button>
                                                @endif
                                            </div>
                                            @if ($value->start == 0 && $value->offer_uids->id == Auth::id())
                                                <div class="col-12 mt-2 mb-2 text-center">
                                                    <button style="box-shadow: 1px 1px 3px 1px #8e8989" type="button" style="background: #2cc445" class="btn btn-sm btn-info btn-block">
                                                        <span style="-webkit-text-stroke: 1px #000000;">Kutilmoqda</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if ($value->start == 0 && $value->accept_uids->id == Auth::id())
                                                <div class="col-12 mt-2 mb-2 text-center">
                                                    <span style="font-size:12px;">{{getUser($value->offer_uids->id)->last_name}} {{substr(getUser($value->offer_uids->id)->first_name,0,1)}}
                                                        sizni jangga chaqirdi va xabar yubordi
                                                    </span>
                                                </div>
                                                <div class="card-body p-0">
                                                <form action="{{route('answer.ksb')}}" method="POST" id="ksb_form">
                                                    @csrf
                                                    <div class="container p-0 mt-2 mb-2 text-center">
                                                        <div class="form-group">
                                                            <input style="font-size:12px;" type="text" class="form-control"  value="{{$value->offer_comment}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="container p-0 mt-2 mb-2 text-center">
                                                        <div class="form-group">
                                                            <input style="font-size:12px;" type="text" name="comment" class="form-control" placeholder="Xabar yuborish..." required>
                                                        </div>
                                                    </div>
                                                    <input class="d-none" id="accept_ksb" type="number" name="accept" value="1">
                                                    <input class="d-none" id="no_accept_ksb" type="number" name="accept" value="0"> 
                                                    <input class="d-none" type="number" name="ksb_id" value="{{$value->id}}"> 
                                                    <div class="col-12 mt-2 mb-2 text-left double_ksb">
                                                        <button 
                                                        onclick="$('#no_accept_ksb').remove();$('.double_ksb').remove();$('.double_ksb_no').removeClass('d-none');$('#ksb_form').submit();"
                                                        style="box-shadow: 1px 1px 3px 1px #8e8989" type="button" style="background: #2cc445" class="btn btn-sm btn-success btn-block">
                                                            <span style="-webkit-text-stroke: 1px #000000;">Duelni qabul qilish</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-12 mt-2 mb-2 text-right double_ksb">
                                                        <button 
                                                        onclick="$('#accept_ksb').remove();$('.double_ksb').remove();$('.double_ksb_no').removeClass('d-none');$('#ksb_form').submit();"
                                                        style="box-shadow: 1px 1px 3px 1px #8e8989" type="button" style="background: #2cc445" class="btn btn-sm btn-danger btn-block">
                                                            <span style="-webkit-text-stroke: 1px #000000;">Duelni rad qilish</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-12 mt-2 mb-2 text-right double_ksb_no d-none">
                                                        <button style="box-shadow: 1px 1px 3px 1px #8e8989" type="button" style="background: #2cc445" class="btn btn-sm btn-info btn-block">
                                                            <span style="-webkit-text-stroke: 1px #000000;">Biroz kuting</span>
                                                        </button>
                                                    </div>
                                                </form>
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </div> 
        </div>
    </div>
@endif
