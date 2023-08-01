

<div class="modal-content" style="background-image: url('/promo/dist/img/promo/bg2.png');
    background-repeat: no-repeat;">
    <div class="modal-body p-0">
        <div class="container">
            <img src="{{asset('mobile/upheader.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                <img src="{{asset('mobile/xclose.png')}}" width="30px">
            </button>
        </div>
        <div class="container p-0">
            @foreach (kingsoldcheck() as $item)
                @php
                    $b = strtotime($item['b']);
                    $e = strtotime($item['e']);
                @endphp
                <button type="button" id='kscheck{{$item['id']}}{{$b}}{{$e}}' class="mb-2 d-none btn btn-sm deletecolor btn-info" wire:click="$emit('kingCheck',{{$item['id']}},{{$b}},{{$e}})">
                    <span class="supercel-text-stroke" >Shu hafta</span>
                </button>
            @endforeach

            <div class="container">
                <div class="mb-3 mt-3">
                    @isset($checks)

                        @foreach ($checks as $key=> $item)
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

                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>