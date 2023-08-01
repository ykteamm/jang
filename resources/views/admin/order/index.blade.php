@extends('admin.layouts.app')
@section('admin')
 

<div class="main-container">
    <div class="container">
        <div class="accordion" id="accordionExample">
            @foreach ($users as $user)
            <div class="card">
                <div class="card-header" id="headingThree">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-block text-left px-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseThree{{$user->id}}" aria-expanded="false" aria-controls="collapseThree">
                                <span style="font-size:24px;">{{$user->pharmacy}}</span> 
                             </button>
                        </div>
                        @php
                            $delivery = 0;
                            $cashback = 0;
                            foreach ($user->order as $key => $order) {
                                if($order->delivery == 0)
                                {
                                    $delivery +=1;
                                }
                                if($order->cashback == 0)
                                {
                                    $cashback +=1;
                                }
                            }
                        @endphp
                        @if ($delivery != 0 || $cashback != 0)
                        <div class="col-auto mt-2">
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                                @if ($delivery != 0)
                                <button type="button" class="btn btn-sm btn-outline-success">
                                    <i class="fa-regular fa-truck"></i>
                                    <span class="badge badge-danger badge-pill">{{$delivery}}</span>
                                </button>
                                @endif
                                @if ($cashback != 0)
                                <button type="button" class="btn btn-sm btn-outline-success">
                                    <i class="fa-solid fa-sack-dollar"></i>
                                    <span class="badge badge-danger badge-pill">{{$cashback}}</span>
                                </button>
                                @endif
                            </div>
                        </div>
                        @endif

                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <h2 class="mb-0">
                                
                                <button class="btn btn-block text-left px-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseThree{{$user->id}}" aria-expanded="false" aria-controls="collapseThree">
                                <span style="font-size:18px;">{{$user->last_name}} {{$user->first_name}}</span>
                                </button>
                            </h2>
                         </div>
                    </div>
                    

                </div>
                <div id="collapseThree{{$user->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        {{-- <div class="card-header border-0 bg-none">
                                <div class="row">
                                    <div class="col align-self-center">
                                        <h6 class="mb-0">Table Responsive</h6>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <button class="btn btn-default btn-sm rounded">
                                            Export
                                        </button>
                                    </div>
                                </div>
                        </div> --}}
                        @foreach ($user->order as $key => $order)
                        <div class="accordion" id="accordionExampleOrder">
                        <div class="card">
                        <div class="card-header" id="headingThreeOrder">
                            {{-- <h2 class="mb-0">
                                <button class="btn btn-block text-left px-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeOrder{{$order->id}}" aria-expanded="false" aria-controls="collapseThree">
                                    #order{{$order->sort}}
                                </button>
                            </h2> --}}
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-block btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeOrder{{$order->id}}" aria-expanded="false" aria-controls="collapseThree">
                                        #order{{$order->sort}}
                                    </button>

                                </div>
                                <div class="col-auto pl-0">
                                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                                        @if($order->delivery == 0)
                                            <form action="{{route('delivery',['id' => $order->id])}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fa-regular fa-truck"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-outline-primary">
                                                <i class="fa-regular fa-truck"></i>
                                            </button>
                                        @endif
                                        @if($order->cashback == 0)
                                            <form action="{{route('cashback',['id' => $order->id])}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                </button>
                                            </form>
                                        @else
                                                <button type="button" class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                </button>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            @php
                                $sum = 0;
                                $bonus = 0;
                                foreach ($order->orderProduct as $o => $ord) {
                                    $sum += $ord->product->price * $ord->stock;
                                    $bonus += $ord->product->bonus * $ord->stock;
                                }
                            @endphp
                            <div class="media mt-1">                            
                                <div class="media-body">
                                    <h6 class="mb-1 text-default">Buyurtma summasi</h6>
                                    <p class="">{{number_format($sum,0,',',' ')}} so'm</p>
                                </div>
                                <div class="media-body text-right">
                                    <h6 class="mb-1 text-default">Buyurtma bonusi</h6>
                                    <p class="">{{number_format($bonus,0,',',' ')}} so'm</p>
                                </div>
                                {{-- <button class="btn btn-default btn-40 rounded-circle"><i class="material-icons">repeat</i></button>                             --}}
                            </div>
                        </div>
                        <div id="collapseThreeOrder{{$order->id}}" class="collapse" aria-labelledby="headingThreeOrder" data-parent="#accordionExampleOrder">
                            <div class="card-body">
                                @foreach ($order->orderProduct as $o => $ord)
                                <div class="media mb-1">
                                    <div class="icon icon-60 mr-3 rounded">
                                        <figure class="background">
                                            <img src="{{asset('images/'.$ord->product->image)}}" alt="{{$ord->product->name}}">
                                        </figure>
                                    </div>
                                    <div class="media-body">
                                        {{-- <small class="text-secondary">Adididas</small> --}}
                                        <h6 class="mb-1 text-default">{{$ord->product->name}} ({{$ord->stock}})</h6>
                                        <span>Narxi: {{number_format($ord->product->price,0,',',' ')}} x {{$ord->stock}} = {{number_format($ord->product->price*$ord->stock,0,',',' ')}}</span>
                                        <p>Bonus: {{number_format($ord->product->bonus,0,',',' ')}} x {{$ord->stock}} = {{number_format($ord->product->bonus*$ord->stock,0,',',' ')}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
