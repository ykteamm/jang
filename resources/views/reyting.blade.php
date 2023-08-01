@extends('layouts.app')
@section('content')
    
<div class="main-container overflow-auto">

    <div class="container mb-4">
        <div class="card">
            <div class="card-header border-bottom">
                <h6 class="mb-0 text-center">Provizorlar Reytingi</h6>
            </div>
            <div class="card-body px-0 pt-0">
                <ul class="list-group list-group-flush">
                    @isset($users)
                        @foreach($users as $key => $item)
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div>
                                            {{$key+1}}
                                        </div>
                                    </div>
                                    <div class="col-auto pr-0 pl-0">
                                        <div class="avatar avatar-40 rounded">
                                            
                                            <div class="background">
                                                <img src="https://api.multiavatar.com/kathrin.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1">{{$item->last_name}} {{$item->first_name}}</h6>
                                        <p class="small text-secondary">{{$item->pharmacy}}</p>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-success">
                                            {{$item->cashback}}
                                            <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px" alt="">
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endisset
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
