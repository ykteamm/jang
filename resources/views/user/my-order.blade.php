@extends('layouts.app')
@section('content')
{{-- <div class="mcontainer" style="background-color: none !important"> --}}
    <div class="container">
        @isset($orders)
            @foreach ($orders as $key => $item)
                <div class="accordion mb-2" id="accordionExample{{$key}}">
                    <div class="card">
                        <div class="card-header" id="headingOne{{$key}}">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left px-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="false" aria-controls="collapseOne">
                                    
                                    
                                     <div class="row">
                                        <div class="col">
                                            <p class="text-secondary small">{{date('H:i',strtotime($item->created_at))}} | {{date('d.m.Y',strtotime($item->created_at))}}</p>
                                        </div>
                                        <div class="col-auto">

                                            <div class="badge @if($item->delivery == 1) badge-success @else badge-danger @endif font-weight-normal vm"><i class="material-icons vm mt-0">local_shipping</i></div>
                                            <div class="badge @if($item->cashback == 1) badge-success @else badge-danger @endif font-weight-normal vm"><i class="material-icons vm mt-0">monetization_on</i></div>
                                            
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            @php
                                $sum = 0;
                                $bonus = 0;
                                foreach ($item->orderProduct as $o => $order) {
                                    $sum += $order->product->price * $order->stock;
                                    $bonus += $order->product->bonus * $order->stock;
                                }
                            @endphp
                            <div class="media">                            
                                <div class="media-body">
                                    <h6 class="mb-1 text-default">Buyurtma summasi</h6>
                                    <p class="">{{number_format($sum,0,',',' ')}} so'm</p>
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-1 text-default">Buyurtma bonusi</h6>
                                    <p class="">{{number_format($sum,0,',',' ')}} so'm</p>
                                </div>
                                {{-- <button class="btn btn-default btn-40 rounded-circle"><i class="material-icons">repeat</i></button>                             --}}
                            </div>
                            
                        </div>
        
                        <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample{{$key}}" style="">
                            <div class="card-body">
                                @foreach ($item->orderProduct as $o => $order)
                                <div class="media mb-1">
                                    <div class="icon icon-60 mr-3 rounded">
                                        <figure class="background">
                                            <img src="{{asset('images/'.$order->product->image)}}" alt="{{$order->product->name}}">
                                        </figure>
                                    </div>
                                    <div class="media-body">
                                        {{-- <small class="text-secondary">Adididas</small> --}}
                                        <h6 class="mb-1 text-default">{{$order->product->name}} ({{$order->stock}})</h6>
                                        <span>Narxi: {{number_format($order->product->price,0,',',' ')}} x {{$order->stock}} = {{number_format($order->product->price*$order->stock,0,',',' ')}}</span>
                                        <p>Bonus: {{number_format($order->product->bonus,0,',',' ')}} x {{$order->stock}} =  {{number_format($order->product->bonus*$order->stock,0,',',' ')}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
{{-- </div> --}}
@endsection
