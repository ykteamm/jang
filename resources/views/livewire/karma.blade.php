<div class="modal-content">
    @if ($resime == 2)
        
        <div class="modal-body p-0">
            <div class="container">
                <img src="{{asset('mobile/kh.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <div class="card mb-3 mt-3">
                @if ($team_id)
                    @foreach ($karmahistory as $item)
                            <div class="col-12 ">
                                <div class="card border-0 mb-1">
                                    <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;">
                                        <div class="row align-items-center supercell" style="font-size:13px;">
                                            <div class="col pr-0">
                                                {{$item->karma}}                                                            
                                            </div>
                                            @if($item->user != null)
                                            <div class="col pr-0">
                                                {{$item->user->last_name}}  {{$item->user->first_name}}                                                            
                                            </div>
                                            @endif
                                            <div class="col-auto text-right">
                                                    <span class="mb-1 text-primary">
                                                    {{$item->comment}}
                                                    </span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @endif

            </div>
    </div>
    @endif

</div>