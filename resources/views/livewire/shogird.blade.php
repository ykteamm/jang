<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header" style="padding: 0 !important;">
{{--                <img src="{{asset('mobile/vil.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">--}}
            <div class="container p-0" style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
                <span class="supercell text-white pl-3" style="font-size:25px;">Shogird</span>
            </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
        </div>
        @if ($resime == 2)
            <div class="modal-body p-0">
                <div class="container p-0">
                    <div class="mb-3 pt-3">
                        @foreach (getShogirdUser() as $key => $item)
                            @php
                                $week = HaftalikShogirdStatistic($item->id);
                                $month = OylikShogirdStatistic($item->id);
                                $apteka = AptekaNomi($item->id)
                            @endphp
                            <div class="col-12">
                                @if($item->id == Auth::id())
                                    <div class="container p-1" style="background:rgba(14,94,246,0.96);border-radius:13px; margin-bottom: 20px" data-toggle="modal" data-target="#new-elchi">
                                        <div data-toggle="modal" data-target="#myshogirdin{{$item->id}}" class="p-2">
                                            <div class="border-0 mb-1">
                                                <div class="card-body" style="border-radius:15px;">
                                                    <div class="row">
                                                        <div class="col-4" style="border: 1px solid gray;padding-top:10px;text-align: center;">
                                                            <h6 style="border-bottom: 1px solid gray;color: white">
                                                                T/R
                                                            </h6>
                                                            <h6 style="color: white">
                                                                {{$key+1}}
                                                            </h6>
                                                        </div>
                                                        <div class="col-8"  style="border: 1px solid gray; padding-top: 10px;text-align: center;">
                                                            <h6 style="border-bottom: 1px solid gray;color: white">
                                                                Ismi va Familiyasi
                                                            </h6>
                                                            <h6 style="color: white">
                                                                {{$item->first_name}} {{$item->last_name}}
                                                            </h6>
                                                        </div>
                                                        <div class="col-6"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                            <h6 style="border-bottom: 1px solid gray;color: white">
                                                                Haftalik
                                                            </h6>
                                                            <h6 style="color: white">
                                                                {{$week}}
                                                            </h6>
                                                        </div>
                                                        <div class="col-6"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                            <h6 style="border-bottom: 1px solid gray;color: white">
                                                                Oylik
                                                            </h6>
                                                            <h6 style="color: white">
                                                                {{$month}}
                                                            </h6>
                                                        </div>
                                                        <div class="col-6"  style="border: 1px solid gray; padding-top: 10px;text-align: center;">
                                                            <h6 style="border-bottom: 1px solid gray;color: white">
                                                                Apteka
                                                            </h6>
                                                            @foreach($apteka as $apt)
                                                                <button class="col-12 mt-2 mb-2 btn btn-info" style="color: white">
                                                                    @foreach($pharm as $ph)
                                                                        @if($ph->id == $apt->id)
                                                                            {{$ph->name}}
                                                                        @endif
                                                                    @endforeach
                                                                </button>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-6"  style="border: 1px solid gray; padding-top: 10px;text-align: center;">
                                                            <h6 style="border-bottom: 1px solid gray;color: white">
                                                                Action
                                                            </h6>
                                                            @foreach($apteka as $apt)
                                                                <button class="col-12 mt-2 mb-2 btn btn-info" type="button" data-toggle="modal" data-target="#AptekaTahrir{{$apt->id}}{{$item->id}}">
                                                                    <i class="fas fa-edit"></i>
                                                                    Tahrir
                                                                </button>
                                                                        {{--                                                                <button class="col-6 mt-2 btn btn-danger" type="button"   data-toggle="modal" data-target="#AptekaDelete{{$apt->id}}{{$item->id}}">--}}
                                                                        {{--                                                                    <i class="fas fa-trash"></i>--}}
                                                                        {{--                                                                    O'chirish--}}
                                                                        {{--                                                                </button>--}}

                                                                        <!-- Modal -->
                                                                <div class="modal fade" id="AptekaTahrir{{$apt->id}}{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Aptekani tahrirlash</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{route('apteka-edit',['id'=>$apt->id])}}" method="POST">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{$item->id}}">
                                                                                    <div class="form-group col-md-12 col-12">
                                                                                        <label for="apteka">Apteka tanglang</label><br>
                                                                                        <select class="custom-select custom-select-lg mb-3 col-md-12" name="apteka" id="apteka" aria-label=".form-select-lg example">
                                                                                            <option value="">--Tanglang--</option>
                                                                                            @foreach($pharm as $ph)
                                                                                                <option @if($ph->id == $apt->id) selected @else @endif value="{{$ph->id}}">{{$ph->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-primary">
                                                                                            <i class="fas fa-edit"></i>
                                                                                            Tahrirlash
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                        {{--                                                                <div class="modal fade" id="AptekaDelete{{$apt->id}}{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                                                        {{--                                                                    <div class="modal-dialog">--}}
                                                                        {{--                                                                        <div class="modal-content">--}}
                                                                        {{--                                                                            <div class="modal-header">--}}
                                                                        {{--                                                                                <h5 class="modal-title" id="exampleModalLabel">Aptekani o'chirish</h5>--}}
                                                                        {{--                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                                                        {{--                                                                                    <span aria-hidden="true">&times;</span>--}}
                                                                        {{--                                                                                </button>--}}
                                                                        {{--                                                                            </div>--}}
                                                                        {{--                                                                            <div class="modal-body">--}}
                                                                        {{--                                                                                <form action="{{route('apteka-delete',['id'=>$apt->id])}}" method="POST">--}}
                                                                        {{--                                                                                    @csrf--}}
                                                                        {{--                                                                                    @method('DELETE')--}}
                                                                        {{--                                                                                    <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{$item->id}}">--}}
                                                                        {{--                                                                                    <h1>Sizni ishonchingiz komilmi?</h1>--}}
                                                                        {{--                                                                                    <div class="modal-footer">--}}
                                                                        {{--                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                                                        {{--                                                                                        <button type="submit" class="btn btn-danger">--}}
                                                                        {{--                                                                                            <i class="fas fa-trash"></i>--}}
                                                                        {{--                                                                                            O'chirish--}}
                                                                        {{--                                                                                        </button>--}}
                                                                        {{--                                                                                    </div>--}}
                                                                        {{--                                                                                </form>--}}
                                                                        {{--                                                                            </div>--}}
                                                                        {{--                                                                        </div>--}}
                                                                        {{--                                                                    </div>--}}
                                                                        {{--                                                                </div>--}}

                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="container p-1" style="background:#3ad1717d;border-radius:13px; margin-bottom: 20px" data-toggle="modal" data-target="#new-elchi">
                                        <div data-toggle="modal" data-target="#myshogirdin{{$item->id}}" class="p-2">
                                            <div class="border-0 mb-1">
                                                <div class="card-body" style="border-radius:15px;">
                                                    <div class="row">
                                                        <div class="col-4" style="border: 1px solid gray;padding-top:10px;text-align: center;">
                                                                <h6 style="border-bottom: 1px solid gray">
                                                                    T/R
                                                                </h6>
                                                                <h6 style="color: red">
                                                                    {{$key+1}}
                                                                </h6>
                                                            </div>
                                                        <div class="col-8"  style="border: 1px solid gray; padding-top: 10px;text-align: center;">
                                                                <h6 style="border-bottom: 1px solid gray">
                                                                    Ismi va Familiyasi
                                                                </h6>
                                                                <h6 style="color: red">
                                                                    {{$item->first_name}} {{$item->last_name}}
                                                                </h6>
                                                            </div>
                                                        <div class="col-6"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                                <h6 style="border-bottom: 1px solid gray">
                                                                    Haftalik
                                                                </h6>
                                                                <h6 style="color: red">
                                                                    {{$week}}
                                                                </h6>
                                                            </div>
                                                        <div class="col-6"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                                <h6 style="border-bottom: 1px solid gray">
                                                                    Oylik
                                                                </h6>
                                                                <h6 style="color: red">
                                                                    {{$month}}
                                                                </h6>
                                                            </div>
                                                        <div class="col-6"  style="border: 1px solid gray; padding-top: 10px;text-align: center;">
                                                                <h6 style="border-bottom: 1px solid gray">
                                                                    Apteka
                                                                </h6>
                                                                @foreach($apteka as $apt)
                                                                    <button class="col-12 mt-2 mb-2 btn btn-info" style="color: white">
                                                                        @foreach($pharm as $ph)
                                                                            @if($ph->id == $apt->id)
                                                                                {{$ph->name}}
                                                                            @endif
                                                                        @endforeach
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        <div class="col-6"  style="border: 1px solid gray; padding-top: 10px;text-align: center;">
                                                                <h6 style="border-bottom: 1px solid gray">
                                                                    Action
                                                                </h6>
                                                                <div class="row justify-content-center" >
                                                                    @foreach($apteka as $apt)
                                                                        <button class="col-10 mt-2 mb-2 btn btn-info" type="button" data-toggle="modal" data-target="#AptekaTahrir{{$apt->id}}{{$item->id}}">
                                                                            <i class="fas fa-edit"></i>
                                                                            Tahrir
                                                                        </button>

                                                                        {{--                                                                <button class="col-6 mt-2 btn btn-danger" type="button"   data-toggle="modal" data-target="#AptekaDelete{{$apt->id}}{{$item->id}}">--}}
                                                                        {{--                                                                    <i class="fas fa-trash"></i>--}}
                                                                        {{--                                                                    O'chirish--}}
                                                                        {{--                                                                </button>--}}

                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="AptekaTahrir{{$apt->id}}{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Aptekani tahrirlash</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form action="{{route('apteka-edit',['id'=>$apt->id])}}" method="POST">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{$item->id}}">
                                                                                            <div class="form-group col-md-12 col-12">
                                                                                                <label for="apteka">Apteka tanglang</label><br>
                                                                                                <select class="custom-select custom-select-lg mb-3 col-md-12" name="apteka" id="apteka" aria-label=".form-select-lg example">
                                                                                                    <option value="">--Tanglang--</option>
                                                                                                    @foreach($pharm as $ph)
                                                                                                        <option @if($ph->id == $apt->id) selected @else @endif value="{{$ph->id}}">{{$ph->name}}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                                <button type="submit" class="btn btn-primary">
                                                                                                    <i class="fas fa-edit"></i>
                                                                                                    Tahrirlash
                                                                                                </button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        {{--                                                                <div class="modal fade" id="AptekaDelete{{$apt->id}}{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                                                        {{--                                                                    <div class="modal-dialog">--}}
                                                                        {{--                                                                        <div class="modal-content">--}}
                                                                        {{--                                                                            <div class="modal-header">--}}
                                                                        {{--                                                                                <h5 class="modal-title" id="exampleModalLabel">Aptekani o'chirish</h5>--}}
                                                                        {{--                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                                                        {{--                                                                                    <span aria-hidden="true">&times;</span>--}}
                                                                        {{--                                                                                </button>--}}
                                                                        {{--                                                                            </div>--}}
                                                                        {{--                                                                            <div class="modal-body">--}}
                                                                        {{--                                                                                <form action="{{route('apteka-delete',['id'=>$apt->id])}}" method="POST">--}}
                                                                        {{--                                                                                    @csrf--}}
                                                                        {{--                                                                                    @method('DELETE')--}}
                                                                        {{--                                                                                    <input class='text-input' id='user_id' name='user_id' type='hidden' value="{{$item->id}}">--}}
                                                                        {{--                                                                                    <h1>Sizni ishonchingiz komilmi?</h1>--}}
                                                                        {{--                                                                                    <div class="modal-footer">--}}
                                                                        {{--                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                                                        {{--                                                                                        <button type="submit" class="btn btn-danger">--}}
                                                                        {{--                                                                                            <i class="fas fa-trash"></i>--}}
                                                                        {{--                                                                                            O'chirish--}}
                                                                        {{--                                                                                        </button>--}}
                                                                        {{--                                                                                    </div>--}}
                                                                        {{--                                                                                </form>--}}
                                                                        {{--                                                                            </div>--}}
                                                                        {{--                                                                        </div>--}}
                                                                        {{--                                                                    </div>--}}
                                                                        {{--                                                                </div>--}}

                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <div class="col-12">
                            <div class="container p-1" style="background:rgba(252,11,11,0.96);border-radius:13px; margin-bottom: 20px" data-toggle="modal" data-target="#new-elchi">
                                <div data-toggle="modal" data-target="#myshogirdin{{$item->id}}" class="p-2">
                                    <div class="border-0 mb-1">
                                        <div class="card-body" style="border-radius:15px;">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <h3 style="color: white;">Umumiy</h3>
                                                </div>
                                                <div class="col-6"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                    <h6 style="border-bottom: 1px solid gray;color: white">
                                                        Haftalik
                                                    </h6>
                                                    <h6 style="color: white">
                                                        @if($pul_data['hafta'])
                                                            {{$pul_data['hafta']}}
                                                        @else
                                                            0
                                                        @endif
                                                    </h6>
                                                </div>
                                                <div class="col-6"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                    <h6 style="border-bottom: 1px solid gray;color: white">
                                                        Oylik
                                                    </h6>
                                                    <h6 style="color: white">
                                                        @if($pul_data['oy'])
                                                            {{$pul_data['oy']}}
                                                        @else
                                                            0
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
