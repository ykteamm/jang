<div class="modal fade" id="openkingcheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if(Session::has('kingCheck'))

                @php
                            $solds = Session::get('kingCheck');
                        @endphp
                <h5 class="modal-title" id="exampleModalCenterTitle">{{$solds[0]->order->user->last_name}} {{$solds[0]->order->user->first_name}}</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    @if(Session::has('kingCheck'))
                    <div class="container p-0">
                        
                        @foreach ($solds as $key=> $item)
                            <div class="card">
                                {{-- <div class="card-body"> --}}
                                    <div class="row">
                                        <div class="col-auto" data-toggle="modal" data-target="#openkingcheckr{{$key*3}}">
                                            <div class="avatar avatar-100 rounded mb-1" >
                                                <div class="background popup-img" style="background-image: url(&quot;img/user1.png&quot;);" >
                                                        <img src="{{asset('images/users/king_sold/'.$item->image)}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col pl-0">
                                            
                                            @php
                                                $sum = 0;
                                                $arr = $item->order->sold;
                                                foreach ($arr as $key => $value) {
                                                    $sum = $sum + $value->price_product*$value->number;
                                                }
                                                if ($item->admin_check == 1)
                                                {
                                                    $checks = 'Tasdiqlangan';
                                                    $badge = 'success';
                                                }elseif($item->admin_check == 2)
                                                {
                                                    $checks = 'Rad etilgan';
                                                    $badge = 'danger';
                                                }else{
                                                    $checks = 'Tekshirilmagan';
                                                    $badge = 'primary';
                                                }
                                            @endphp
                                                <p class="small mb-1 text-center">
                                                    Umumiy {{$sum}}  <span class="badge badge-{{$badge}}">
                                                    @if ($item->order_id == 24247)
                                                        A'zam aka tekshirgan
                                                    @else
                                                        {{$checks}}
                                                    @endif
                                                    </span>
                                                    
                                                </p>
                                            @foreach ($arr as $a)
                                                <p class="small m-0 p-0">
                                                    {{$a->medicine->name}} ({{$a->number}}x{{$a->price_product}})
                                                </p>
                                            @endforeach
                                        </div>
                                       
                                </div>
                                @if($item->comment != null)
                                <div class="col pl-0 text-center">
                                    <span style="font-size:14px;">Izoh: {{$item->comment}}</span>
                                </div>
                                @endif
                                {{-- </div> --}}
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
