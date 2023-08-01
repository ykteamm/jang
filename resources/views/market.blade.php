@extends('layouts.app')
@section('content')
    
<div class="overflow-auto">
    @if(Session::has('success_order'))
    <div class="list-group-item session-message" style="border-radius: 15px;">
        <div class="row">
            <div class="col-auto align-self-center">
                <i class="material-icons text-default">check_circle</i>
            </div>
            <div class="col pl-0">
                <div class="row mb-1">
                    <div class="col">
                        <p class="mb-0">{{Session::get('success_order')}}</p>
                    </div>
                    {{-- <div class="col-auto pl-0">
                        <p class="small text-secondary">2/12/2020</p>
                    </div> --}}
                </div>
                {{-- <p class="small text-secondary">{{Session::get('success_order')}}</p> --}}
                <p class="small text-secondary">2/12/2020</p>

            </div>
        </div>
    </div>
    @endif
    <div class="container mb-4 py-3 overflow-auto" >

        <div class="row">
            @isset($products)
                @foreach ($products as $item)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card border-0 mb-4 overflow-hidden">
                            <div class="card-body h-150 position-relative">
                                {{-- <div class="top-right m-2">
                                    <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle"><i class="material-icons mt-0 vm">favorite_border</i></button>
                                </div> --}}
                                <div class="bottom-left m-2">
                                    <button class="btn btn-sm btn-default rounded">
                                        {{number_format($item->elexir,0,',',' ')}}
                                        <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px" alt="">
                                    </button>

                                </div>
                                <a href="product.html" class="background">
                                    <img src="{{asset('images/'.$item->image)}}" alt="">
                                </a>
                            </div>
                            <div class="card-body ">
                                {{-- <p class="mb-0"><small class="text-secondary">Rockstar</small></p> --}}
                                <a href="product.html">
                                    <p class="mb-0">{{$item->name}}</p>
                                </a>
                                {{-- <h5 class="mb-0">
                                    {{$item->elexir}}
                                        <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px" alt="">
                                </h5> --}}
                                {{-- <div>
                                    <button type="button" onclick="plus({{$item->id}})" class="btn btn-sm btn-primary">+</button>
                                </div> --}}
                                <div class="mt-1 text-center">
                                    @if (Auth::user()->cashback >= $item->elexir )
                                        <a href="{{route('product-shopping',$item->id)}}" type="button" class="btn btn-sm btn-primary">Sotib olish</a>
                                    @else
                                        <button type="button" class="btn btn-sm btn-danger">Sotib ololmaysiz eleksir kam</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</div>
@endsection
