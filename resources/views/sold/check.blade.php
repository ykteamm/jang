@extends('layouts.app')
@section('content')
<div class="main-container mb-4">
    <div class="text-center">
        ELEKTRON CHECK
    </div>
</div>
<div class="main-container">
    <div class="container">
        <div class="container mb-4">
            <div class="row h6 font-weight-bold">
                <div class="col">Check summasi</div>
                @php
                $sum=0;
                    foreach($all_sold as $item)
                    {
                        $sum += $item->price_product;
                    }
                @endphp
                <div class="col text-right text-mute summa-zakaz">{{$sum}}</div>
            </div>
        </div>
        <div class="mt-4">
            @foreach ($all_sold as $item)
                <div class="media mb-4 w-100" >
                    <div class="media-body">
                        <a href="#">
                            <p class="mb-1">{{$item->medicine->name}}</p>
                        </a>
                        <p><span class="text-success">{{$item->number}} x {{$item->price_product}} = {{$item->number* $item->price_product}}</span> 
                            <span class="text-secondary small">so'm</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection

