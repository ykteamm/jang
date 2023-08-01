<div class="modal fade" id="teachtest" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="height: 100%">
        <div class="modal-content" style="background-image: url('/promo/dist/img/promo/bg2.png');
            background-repeat: no-repeat;">
            <div class="modal-body p-0">
                <div class="container">
                    <img src="{{asset('mobile/upheader.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" id="first-view-close" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
                </div>
                <div class="container p-0">
                    <div class="mb-3">
                        
                        <form action="{{route('teach-test-store2')}}" method="POST">
                            @csrf
                            <div class="col-12  pl-0 pr-0 mt-5">  
                                <div class=" border-0 mb-1">
                                    <div class="card-body pt-1 pb-1 text-center">
                                        <div class="row align-items-center">
                                            @foreach (getTeachQuestion() as $item)
                                                <div class="col-2">
                                                    <input type="checkbox" name="{{$item->id}}">
                                                </div>
                                                <div class="col-10 pl-0">
                                                    <h4 class="text-white">{{$item->name}}</h4>
                                                    
                                                </div>
                                            @endforeach
                                            <div class="col-12 mt-5">
                                                <button type="submit" class="mb-2 btn btn-lg btn-info" data-toggle="modal" data-target="#teachgradestar" style="background: #69d836ab;
                                        border-radius: 26px;">
                                            Saqlash
                                            </button> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        {{-- @foreach ($users as $key => $item)
                        @php
                            if ($key == 0) { $color = 'e0aa2c'; }
                            if ($key ==1) { $color = 'bdccdb'; }
                            if ($key == 2) { $color = 'cc8448'; }
                            if (!in_array($key,[0,1,2])) { $color = '8d9eb8'; }
                        @endphp
                            <div class="col-12  supercell" data-toggle="modal" data-target="#testtest" onclick="upModal({{$item->id}})">
                                <div class="card border-0 mb-1">
                                    <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;border:1px solid #666464">
                                        <div class="row align-items-center">
                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #{{$color}};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                    {{$key+1}}
                                                </button>
                                            </div>
                                            <div class="col-2 pl-0">
                                                <div class="container pl-0 pr-0">
                                                    <div class="avatar avatar-40  mx-auto shadow" style="border-radius: 20px !important;">
                                                        <div class="background" style="background-image: url({{$item->image_url}});">
                                                            <img src="{{$item->image_url}}" style="display: none;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 pr-0 pl-0">
                                                <span class="mb-1" style="color: #272730;font-size:12px">{{$item->first_name}} {{substr($item->last_name,0,1)}}</span>
                                                <p style="color: #272730;font-size:10px;color:#6c757d;">
                                                    @if ($grade[$item->id] > 30)
                                                        Oqsoqol
                                                    @else
                                                        Chaqaloq
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-1 pr-0 pl-0 text-right">
                                                <img src="{{asset('mobile/oltin.png')}}" width="23px;">
                                            </div>
                                            <div class="col-3 pr-0">
                                                <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                    <span style="font-size:11px;">{{numb($item->sold)}}</span> 
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endisset --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

