@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="container">
        <div class="container mb-4">
            <div class="row h6 font-weight-bold">
                <div class="col">Zakaz summasi</div>
                <div class="col text-right text-mute summa-zakaz">0</div>
            </div>
        </div>
        <div class="container mb-4">
            <button type="button" class="btn btn-default btn-block rounded" id="submitSold">Zakazni yopish</button>
        </div>
        <div class="mt-4 overflow-auto " style="height: 700px;">
            <form action="{{route('sold.store')}}" method="POST" id="soldForm">
                @csrf
            @foreach ($products[0]->pharmacy->shablon_pharmacy[0]->shablon->price as $item)
                <div class="media mb-4 w-100" >
                    <div class="media-body">
                        <a href="#">
                            <p class="mb-1">{{$item->medicine->name}}</p>
                        </a>
                        <p><span class="text-success product-price{{$item->medicine->id}}">{{$item->price}}</span> <span class="text-secondary small">so'm</span></p>
                    </div>
                    <div class="align-self-center">
                        <div class="input-group cart-count">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" onclick="minus({{$item->medicine->id}})">-</button>
                            </div>
                            <input type="text" class="form-control product{{$item->medicine->id}}" value="0" name="{{$item->medicine->id}}-{{$item->price}}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="plus({{$item->medicine->id}})">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $("#submitSold").click(function(){        
                $("#soldForm").submit();
            });
        });
        
    </script>
@endsection

