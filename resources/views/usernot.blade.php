@extends('layouts.app')
@section('content')
    
<div class="container h-100 pl-0 pr-0">
    
    <div class="swiper-container introduction @if ($errors->any() || Session::has('smena')) active1 @else active2 @endif  text-white">
        <div class="swiper-wrapper">
            <div class="swiper-slide overflow-hidden text-center">
                        <div class="container-fluid text-center mb-1">
                            <div class="avatar avatar-140 rounded-circle mx-auto shadow">
                                <div class="background" style="background-image: url(&quot;img/user1.png&quot;);">
                                    <img src="{{Auth::user()->image_url}}"  style="display: none;">
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" class="mb-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#change-image">Rasmni ozgartirish <span class="material-icons">edit</span></button>
                        
                        <div class="container mt-2 mb-2">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary" style="background: #0a12280f;border-radius: 15px;">
                                        <div style="background: #6dc6da5c;border-radius: 15px;">
                                            Familya
                                        </div>
                                        <span>{{Auth::user()->last_name}}</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary" style="background: #0a12280f;border-radius: 15px;">
                                        <div style="background: #6dc6da5c;border-radius: 15px;">
                                            Ism
                                        </div>
                                        <span>{{Auth::user()->first_name}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="container mt-2 mb-2">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary" style="background: #0a12280f;border-radius: 15px;">
                                        <div style="background: #6dc6da5c;border-radius: 15px;">
                                            Nickname
                                        </div>
                                        <span>{{Auth::user()->nickname}}</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary" style="background: #0a12280f;border-radius: 15px;">
                                        <div style="background: #6dc6da5c;border-radius: 15px;">
                                            Telefon
                                        </div>
                                        <span>{{Auth::user()->phone_number}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="mb-2 btn btn-sm btn-primary" data-toggle="modal" data-target="#change-profil">Ma'lumotlarni o'zgartirish <span class="material-icons">edit</span></button>

            </div>
            <div class="swiper-slide overflow-hidden text-center">
                
                <div class="row h-70">
                    
                    <div class="col align-self-center px-3 mt-3">
                        @if ($message = Session::get('smena'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            @foreach ($errors->all() as $error)
                            <p class="yellow-text font lato-normal center">{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                        @if(count($shifts) == 1)            
                        <div class="col align-self-center pl-0 pr-0">
                            <div class="container mb-4 pl-0 pr-0">
                                <div class="row">
                                    @foreach ($shifts as $item)
                                        <div class="col-12">
                                            <div class="card border-0 mb-4">
                                                <div class="card-body">
                                                    <div class="row align-items-center text-center">
                                                        <div class="col-6 align-self-center">
                                                            <h6 class="mb-1 text-secondary">Dorixona</h6>
                                                            <p class="small text-secondary">{{$item->pharmacy->name}}</p>
                                                        </div>
                                                        <div class="col-auto align-self-center border-left">
                                                            <h6 class="mb-1 text-secondary">Smena ochilgan</h6>
                                                            <p class="small text-secondary">{{date('d.m.Y H:i:s',strtotime($item->created_at))}}</p>
                                                        </div>
                                                        <div class="col-12 align-self-center mt-3">
                                                            <button type="button" onclick="closeCode()" class="btn btn-info btn-block rounded m-2" data-toggle="modal" data-target="#smenaclose">
                                                                Smena yopish
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="container">
                            @if(count($shifts) != 1)            

                            <div class="card-body mb-3">
                                <button type="button" onclick="openCode()" class="mb-2 btn btn-lg btn-info" data-toggle="modal" data-target="#smena">
                                    SMENA
                                </button>

                            </div>   
                            @endif

                                <div class="row">
                                    <div class="col-6">
                                        @if(count($shifts) == 1)            
                                        <button type="button" onclick="openKassa()" class="mb-2 btn btn-block btn-lg btn-info" data-toggle="modal" data-target="#openkassa">
                                            KASSA
                                        </button>
                                    @else
                                        <button type="button" class="mb-2 btn btn-block btn-lg btn-info" data-toggle="modal" data-target="#kassa">
                                            KASSA
                                        </button>
                                    @endif
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="mb-2 btn btn-block btn-lg btn-info" data-toggle="modal" data-target="#hisbot">
                                            HISOBOT
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="mb-2 btn btn-lg btn-info d-none" data-toggle="modal" id="check" data-target="#opencheck">
                                    Check
                                </button>
                            
                        </div>
                        
                    </div>

                </div>
                <div class="container">
                    @isset($all_sold)

                    <div class="row mb-3">
                        <div class="col">
                            <h6 class="subtitle mb-0 text-center">Bugungi cheklar</h6>
                        </div>
                    </div>
                    @endisset
                    <div class="row overflow-auto" style="height: 450px;">
                        @isset($all_sold)
                            @foreach ($all_sold as $sold)
                                @php
                                $sum=0;
                                $category=0;
                                $categoryTea=0;$category=0;
                                $categoryTea=0;
                                    foreach ($sold->sold as $key => $value) {
                                        $sum += $value->price_product*$value->number;
                                        if(in_array($value->medicine->category_id,getCategoryId()))
                                        {
                                            $category += $value->number;
                                        }
                                        if(in_array($value->medicine->category_id,getCategoryTeaId()))
                                        {
                                            $categoryTea += $value->number;
                                        }
                                    }
                                @endphp
                                <div class="col-12 mb-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="mb-1 text-secondary text-left">{{number_format($sum,0,',',' ')}}
                                                    </h5>
                                                    <p class="text-secondary text-left mb-0">{{date('d.m.Y H:i',strtotime($sold->created_at))}}</p>
                                                    @if ($sum >= 200000 || ($category >= 1 && $categoryTea >= 2) || ($categoryTea >= 4))
                                                        <p class="text-secondary text-left"><span class="badge badge-success badge-pill">shox yurish</span></p>
                                                    @endif
                                                </div>
                                                <div class="col-auto pl-0 @if($sum >= 200000 || ($category >= 1 && $categoryTea >= 2) || ($categoryTea >= 4)) mt-3 @else mt-1 @endif">
                                                    <button class="btn bg-info rounded text-white" id="opencheck{{$sold->id}}" data-toggle="modal" data-target="#check{{$sold->id}}">
                                                        Ko'rish
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            <div class="swiper-slide overflow-hidden text-center">
                <div class="row">
                    <div class="col align-self-center px-3">
                        <div class="container pl-0 pr-0 m-0">
                            Eleksir test rejimida ishlamoqda !!! rrrrr
                        </div>
                        @if ($lock->mayBeLocked)
                            <button class="btn btn-danger w-100 mt-0 d-flex align-items-center justify-content-between" type="button" data-toggle="modal" data-target="#lock">
                                <div class="" style="font-size:20px;font-weight:800">
                                    Blokirovkaga qoldi
                                </div>
                                <span class="d-flex align-items-end">
                                    <span class="mr-1" style="font-size:20px;font-weight:800">
                                        {{ $lock->day }}
                                    </span> kun <strong class="px-1" style="font-weight:800;font-size:22px"> {{" : "}} </strong> 
                                    <span class="mr-1" style="font-size:20px;font-weight:800">
                                        {{ $lock->hour }}
                                    </span> soat
                                </span>
                            </button>
                        @else
                            <div class="container pl-0 pr-0">
                                <div class="row">
                                    <div class="col-6 pl-0 pr-0">
        
                                        <button type="button" class="btn pr-0" data-toggle="modal" data-target="#exercise">
                                            <img src="{{asset('mobile/top22.webp')}}" class="for-media-img" width="160px" alt="">
                                        </button>
                                    </div>
                                    <div class="col-6 pl-0 pr-0">
        
                                        <button type="button" class="btn pl-0" data-toggle="modal" data-target="#kingsold">
                                            <img src="{{asset('mobile/ksold.webp')}}" class="for-media-img" width="160px" alt="">
                                        </button>
                                    </div>
                                    <button type="button" class="btn d-none" id="openkingchecksold" data-toggle="modal" data-target="#openkingcheck">
                                        Ko'rish
                                    </button>
                                </div>
                                
                            </div>
                        @endif
                        @if (Auth::user()->status == 1)
                            @if($battle_yes == 'end' || $battle_yes == 'no')
                            <div class="container-fluid text-center mb-2 mt-1 pl-0 pd-0 img-container">
                                Sizga mos raqib tanlayapmiz 
                                <p>Jangga tayyor turing</p>
                            </div>
                            @endif
                            @if($battle_yes == 'yes')
                            <div class="container-fluid text-center mb-2 mt-1 pl-0 pd-0 img-container">
                                        <img class="responsive-img" src="{{asset('mobile/jang3.webp')}}">
                                        <div class="user-image1">
                                            <div class="for-avatar avatar avatar-140 rounded-circle mx-auto" style="width: 130px;height:130px;
                                            @if($summa_bugun1 > $summa_bugun2)
                                            box-shadow: 0px 1px 17px 5px #d3cf17;
                                            @endif
                                            @if($summa_bugun1 < $summa_bugun2)
                                            box-shadow: 0px 1px 17px 5px #ff0000;
                                            @endif
                                            "
                                            >
                                                <div class="background">

                                                    @if (Auth::user()->id == $my_battle[0]->u1ids->id)
                                                        @if (isset($my_battle[0]->u1ids->image_url))
                                                        <img src="{{$my_battle[0]->u1ids->image_url}}" height="10px" alt="">
                                                        @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg" height="10px" alt="">
                                                        @endif
                                                    @else
                                                        @if (isset($my_battle[0]->u2ids->image_url))
                                                        <img src="{{$my_battle[0]->u2ids->image_url}}" height="10px" alt="">
                                                        @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg" height="10px" alt="">
                                                        @endif
                                                    @endif

                                                </div>
                                                

                                            </div>
                                            
                                            <div class="text-dark mt-1 supercell text-font for-name">
                                                @if (Auth::user()->id == $my_battle[0]->u1ids->id)
                                                    {{$my_battle[0]->u1ids->first_name}} {{substr($my_battle[0]->u1ids->last_name,0,1)}}
                                                @else
                                                    {{$my_battle[0]->u2ids->first_name}} {{substr($my_battle[0]->u2ids->last_name,0,1)}}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="user-image2">
                                            <div class="for-avatar avatar avatar-140 rounded-circle mx-auto" style="width: 130px;height:130px;
                                            @if($summa_bugun1 < $summa_bugun2)
                                            box-shadow: 0px 1px 17px 5px #d3cf17;
                                            @endif
                                            @if($summa_bugun1 > $summa_bugun2)
                                            box-shadow: 0px 1px 17px 5px #ff0000;
                                            @endif
                                            ">
                                                <div class="background">
                                                    @if (Auth::user()->id != $my_battle[0]->u1ids->id)
                                                        @if (isset($my_battle[0]->u1ids->image_url))
                                                        <img src="{{$my_battle[0]->u1ids->image_url}}" height="10px" alt="">
                                                        @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg" height="10px" alt="">
                                                        @endif
                                                    @else
                                                        @if (isset($my_battle[0]->u2ids->image_url))
                                                        <img src="{{$my_battle[0]->u2ids->image_url}}" height="10px" alt="">
                                                        @else
                                                        <img src="https://api.multiavatar.com/kathrin.svg" height="10px" alt="">
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-dark mt-1 supercell text-font for-name">
                                                @if (Auth::user()->id != $my_battle[0]->u1ids->id)
                                                    {{$my_battle[0]->u1ids->first_name}} {{substr($my_battle[0]->u1ids->last_name,0,1)}}
                                                @else
                                                    {{$my_battle[0]->u2ids->first_name}} {{substr($my_battle[0]->u2ids->last_name,0,1)}}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="battle_date supercell">
                                            <span>{{$my_battle[0]->day+1}} / {{$my_battle[0]->days}}</span>
                                            <p>KUN</p>
                                        </div>
                                        <div class="bugun1 img-container first_one" onclick="changeDay(0)">
                                            <img src="{{asset('mobile/bugun.webp')}}" width="140px" alt="">
                                        </div>
                                        <div class="bugun1 img-container first_two d-none" onclick="changeDay(1)">
                                            <img src="{{asset('mobile/bugun.webp')}}" width="140px" alt="">
                                        </div>
                                        <div class="bugun_date1 supercell first_one" onclick="changeDay(0)">
                                            <span>Bugun</span>
                                        </div>
                                        <div class="bugun_date1 supercell first_two d-none" onclick="changeDay(1)">
                                            <span>{{date_diff(date_create(date('Y-m-d')),date_create(date('Y-m-d',strtotime($battle_start_day))))->format("%a")}} kun</span>
                                        </div>
                                        <div class="bugun_price1 supercell first_one" style="font-size: 13px;" onclick="changeDay(0)">
                                            @if(count($summa1) > 0)
                                                {{number_format($summa1[0]->allprice,0,',',' ')}}
                                            @else
                                                0
                                            @endif
                                        </div>
                                        <div class="bugun_price1 supercell first_two d-none" onclick="changeDay(1)" style="font-size: 13px;">
                                            @if(count($summa_bugun1) > 0)
                                                {{number_format($summa_bugun1[0]->allprice,0,',',' ')}}
                                            @else
                                                0
                                            @endif
                                        </div>
                                        
                                        <div class="bugun2 img-container first_one" onclick="changeDay(0)">
                                            <img src="{{asset('mobile/bugun.webp')}}" width="140px" alt="">
                                        </div>
                                        <div class="bugun2 img-container first_two" onclick="changeDay(1)">
                                            <img src="{{asset('mobile/bugun.webp')}}" width="140px" alt="">
                                        </div>
                                        <div class="bugun_date2 supercell first_one" onclick="changeDay(0)">
                                            <span>Bugun</span>
                                        </div>
                                        <div class="bugun_date2 supercell first_two d-none" onclick="changeDay(1)">
                                            <span>{{date_diff(date_create(date('Y-m-d')),date_create(date('Y-m-d',strtotime($battle_start_day))))->format("%a")}} kun</span>
                                        </div>
                                        <div class="bugun_price2 supercell first_one" style="font-size: 13px;" onclick="changeDay(0)">
                                            @if(count($summa2) > 0)
                                                {{number_format($summa2[0]->allprice,0,',',' ')}}
                                            @else
                                                0
                                            @endif
                                        </div>
                                        <div class="bugun_price2 supercell first_two d-none" style="font-size: 13px;" onclick="changeDay(1)">
                                            @if(count($summa_bugun2) > 0)
                                                {{number_format($summa_bugun2[0]->allprice,0,',',' ')}}
                                            @else
                                                0
                                            @endif
                                        </div>
                                        
                                        <div class="container mt-5 natija-img">
                                            <div class="col-auto text-center img-container">

                                                @if (count($battle_history) > 0)
                                                    @if ($battle_history[count($battle_history)-1]['win'] == Auth::user()->id)
                                                        <a class="play-btn" style="position: absolute;top:40px;right:10px"
                                                            aria-labelledby="#imageDownload" data-toggle="modal"
                                                            data-target="#imageDownload">
                                                            <img src="{{ asset('mobile/kb.png') }}" alt="Image" width="30">
                                                        </a>
                                                    @endif
                                                @endif

                                                
                                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                    <img src="{{asset('mobile/natija.webp')}}" width="190px" alt="">
                                                </button>
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($battle_history as $key => $item)
                                                    @if ($i<=5)
                                                        
                                                    @if($item->u1id == Auth::user()->id)
                                                    <div class="stars{{$i}}" style="background-color:#c19736b3;border-radius:5px;padding: 2px 2px;">
                                                        @if ($item->win == Auth::user()->id)
                                                        <img src="{{asset('mobile/stars1.webp')}}" width="30px" alt="">
                                                        @else
                                                        <img src="{{asset('mobile/stars2.webp')}}" width="30px" alt="">
                                                        @endif
                                                    </div>
                                                    @else
                                                    <div class="stars{{$i}}" style="background-color:#c19736b3;border-radius:5px;padding: 2px 2px;">
                                                        @if ($item->lose == Auth::user()->id)
                                                        <img src="{{asset('mobile/stars2.webp')}}" width="30px" alt="">
                                                        @else
                                                        <img src="{{asset('mobile/stars1.webp')}}" width="30px" alt="">
                                                        @endif
                                                    </div>
                                                    @endif
                                                    @endif
                                                    @php
                                                        $i += 1;
                                                    @endphp
                                                @endforeach
                                                @if (count($battle_history) < 5)
                                                    @for ($j = 1; $j <= 5 - count($battle_history); $j++)
                                                    <div class="stars{{count($battle_history)+$j}}" style="background-color:#c18f36;border-radius:5px;padding: 2px 2px;">
                                                        <div style="background-color:#c19736b3;border-radius:5px;width:30px;height:30px;">
                                                        </div>
                                                    </div>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                            </div>
                            <div class="container pl-0 pr-0 reyting-user">
                                <div class="row">
                                    <div class="col-6 pl-3 pr-0">
        
                                        <button type="button" class="btn pr-0" data-toggle="modal" data-target="#reyting">
                                            <img src="{{asset('mobile/reyting.webp')}}" class="for-media-img" width="160px" alt="">
                                        </button>
                                    </div>
                                    <div class="col-6 pl-0 pr-4">
        
                                        <button type="button" class="btn pl-0" data-toggle="modal" data-target="#region">
                                            <img src="{{asset('mobile/viloyatim.webp')}}" class="for-media-img" width="160px" alt="">
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                            @endif
                        @endif
                        {{-- @if (Auth::user()->status == 0)
                            ddd {{getTeacher()->first_name}} {{getTeacher()->last_name}}
                        @endif --}}
                        {{-- test --}}
                    </div>
                </div>
            </div>
            <div class="swiper-slide overflow-hidden text-center">
                <livewire:money
                />
                @if(count($money_array) > 0)

                <div class="container mt-2 pt-2 pb-2" style="background:#a5cae3;border-radius:15px;">
                    <div class="p-1">
                        <h5 class="text-center supercell" style="color:#00eb00;-webkit-text-stroke: 1px #040c10">
                            Kalendar Fevral
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @php
                                $plan = 0;
                                $make = 0;
                            @endphp
                            @if($plan_days > 0)
                            <div class="card mb-1" style="background:#009d70;border-radius:15px;border:3px solid #00e8b6;">
                                <div class="card-body p-2 pl-3">
                                    <div class="row">
                                        
                                        <div class="col-12">
                                            
                                            <div class="p-1">
                                                <h5 class="text-center supercell" style="color:#ffffff;-webkit-text-stroke: 1px #040c10" onclick="clickPlan()">
                                                    Bugungi plan
                                                </h5>
                                            </div>
                                               
                                        </div>
                                        <div class="col-12 supercell mb-3">
                                            <button type="button" class="btn" style="background: #d9e6f7;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);color:#ffffff;-webkit-text-stroke: 1px #040c10">
                                                {{number_format($plan_make,0,',',' ')}}/{{number_format($plan_days,0,',',' ')}}
                                                
                                                </button>
                                        </div>
                                        <div class="col-12">
                                            <div class="row pl-2">
                                                <div class="col-8">
                                                    <div class="row">
                                                    @foreach ($week_array as $key => $item)
                                                            <div class="col-1" style="flex: 0 0 14.271%;max-width: 14.271%;padding-right:0px;padding-left:1px;">
                                                                <div class="card-body p-1" style="background: #79a2fe;border-radius:7px;">
                                                                    @if (strtotime(date('Y-m-d')) < strtotime($item['date']))
                                                                        <div style="background: #d9e6f7;border-radius:5px;">
                                                                        </div>
                                                                    @else
                                                                        @if ($item['sold'] >= $item['day_money'])
                                                                        <div style="background: #d9e6f7;border-radius:5px;">
                                                                            <i class="material-icons" style="color:#03a403;font-size:14px;-webkit-text-stroke: 3px #03a403;">done</i>
                                                                        
                                                                        </div> 
                                                                        @else
                                                                        <div style="background: #d9e6f7;border-radius:5px;">
                                                                            <i class="material-icons" style="color:#ff0207;font-size:14px;-webkit-text-stroke: 3px #ff0207;">close</i>
                                                                        </div>
                                                                        @endif
                                                                    @endif
                                                                    
                                                                    <span class="text-white">{{date('d',strtotime($item['date']))}}</span>
                                                                </div>
                                                            </div>
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
                    </div>
                </div>
                @endif
                <div class="container pl-0 pr-0">
                    <div class="row">
                        <div class="col-12 pl-0 pr-0">

                            <button type="button" class="btn pr-0" data-toggle="modal" data-target="#bonus">
                                <img src="{{asset('mobile/market2233.png')}}" class="for-media-img" width="160px" alt="">
                            </button>
                        </div>
                    </div>
                    
                </div>

            </div>     
            <livewire:team-battle/>
        </div>
    </div>
</div>
    @include('modals.kingliga')
    @include('modals.lock')
    @include('modals.image')
    @include('modals.battle')
    @include('modals.battle-day')
    @include('modals.kassa')
    @include('modals.openkassa')
    @include('modals.opencheck')
    @include('modals.exercise')
    @include('modals.smena')
    @include('modals.bonus')
    @include('modals.smenaclose')
    @include('modals.all-sold')
    @include('modals.king-sold')
    @include('modals.history-kubok')
    @include('modals.history-elexir')
    @include('modals.reyting')
    @include('modals.hisobot')
    @include('modals.viloyatim')
    @include('modals.change-image')
    @include('modals.change-profil')
    @include('modals.money')
    @include('modals.plan')
    @include('modals.change_plan')
    @include('modals.teambattle')
    @include('modals.openkingcheck')
    @include('modals.ksb')
    @include('modals.myksbhistory')
    @include('modals.region-profil')
    @include('modals.first-enter')
    <button type="button" class="btn btn-info btn-block rounded m-2 d-none" data-toggle="modal" id="firstenter" data-target="#first-enter">
        Smena yopish
    </button>
    @include('modals.first-view')
    <button type="button" class="btn btn-info btn-block rounded m-2 d-none" data-toggle="modal" id="firstview" data-target="#first-view">
        Smena yopish
    </button>
    @include('modals.region')
    @include('modals.region-profil')
    @include('modals.user-profil')
    {{-- @include('modals.testtest') --}}
    @include('modals.user-profil')
    @include('modals.region')
    @if(Session::has('kingCheck'))
        @php
            $solds = Session::get('kingCheck');
        @endphp
        @foreach ($solds as $key=> $item)
        <div class="modal fade" id="openkingcheckr{{$key*3}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                            <img src="{{asset('mobile/xclose.png')}}" width="30px">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3">
                            <div class="container p-0">
                                <img src="{{asset('images/users/king_sold/'.$item->image)}}" width="100%" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
@endsection
@section('scripts')
<script src="{{asset('promo/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    
   
  
    
    function upModal(id)
    {
        $(`#userprofil${id}`).click();
    }
    function allRegion(id)
    {
        $(`#allregionlive${id}`).click();
    }
</script>
<script>
    
    $(function () {
            $('[data-mask]').inputmask()
        });
    var dday = <?php echo json_encode(date('d',strtotime(getKSDay()['this_end']))) ?>;
    var dname = <?php echo json_encode(date('F',strtotime(getKSDay()['this_end']))) ?>;
    var countDownDate = new Date(dname+" "+dday+", 2023 23:59:59").getTime();
    
    var x = setInterval(function() {    

      // Get today's date and time
      var now = new Date().getTime();
        
      var distance = countDownDate - now;
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      document.getElementById("count-timer-day").innerHTML = days;
      document.getElementById("count-timer-hour").innerHTML = hours;
      document.getElementById("count-timer-minut").innerHTML = minutes;
    }, 1000);

    var countDownDate2 = new Date("April 20, 2023 23:59:59").getTime();
    
    var x2 = setInterval(function() {

      // Get today's date and time
      var now2 = new Date().getTime();
        
      var distance2 = countDownDate2 - now2;
      var days2 = Math.floor(distance2 / (1000 * 60 * 60 * 24));
      var hours2 = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes2 = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
      var seconds2 = Math.floor((distance2 % (1000 * 60)) / 1000);
      document.getElementById("count-timer-day2").innerHTML = days2;
      document.getElementById("count-timer-hour2").innerHTML = hours2;
      document.getElementById("count-timer-minut2").innerHTML = minutes2;
    }, 1000);

    </script>
<script>
          $(function () {
       var img = $('.imgvvv'),
           imgshow = $('#imgshowimg'),
           overly = $('#overimg'),
           close = $('#closeimg');
           img.on('click', function () {
           overly.show();
           imgshow.attr('src', $(this).attr('src'));
           close.click(function(){
           overly.hide()
         ;})
     ;})
;});
    function changeTextPlan()
    {
        $('.for-plan-text-active').addClass('d-none');
        $('.for-plan-text').removeClass('d-none');
    }
    function clickPlan()
    {
        $('.click-plan').click();
        changeReytingTab(2);
        changeReytingTab(2);
        changeReytingTab(2);
    }
    function openKassa()
    {
        $(".kassa-input").each(function(){
            $(this).val(0);
            $('.summa-zakaz').text(0);
       })

    }
    function changeReytingTab(number)
    {
        $('.reyting-tab-class').removeClass('reyting-tab-active');
        $('.reyting-tab-class').addClass('reyting-tab');

        $(`.reyting-tab${number}`).removeClass('reyting-tab');
        $(`.reyting-tab${number}`).addClass('reyting-tab-active');
    }

    function changeReytingTab23(number)
    {
        $('.reyting-tab-class23').removeClass('reyting-tab-active23');
        $('.reyting-tab-class23').addClass('reyting-tab23');

        $(`.reyting-tab${number}`).removeClass('reyting-tab23');
        $(`.reyting-tab${number}`).addClass('reyting-tab-active23');
    }

    function changeKingSoldTab(number)
    {
            $(`.king-sold-tab${number}`).removeClass('king-sold-tab');
            $(`.king-sold-tab${number}`).addClass('king-sold-tab-active');
        if(number == 2)
        {
            $('.king-sold-tab1').addClass('king-sold-tab');
            $('.king-sold-tab1').removeClass('king-sold-tab-active');

            $('.king-sold-tab3').addClass('king-sold-tab');
            $('.king-sold-tab3').removeClass('king-sold-tab-active');
        }
        if(number == 3){
            $('.king-sold-tab1').addClass('king-sold-tab');
            $('.king-sold-tab1').removeClass('king-sold-tab-active');

            $('.king-sold-tab2').addClass('king-sold-tab');
            $('.king-sold-tab2').removeClass('king-sold-tab-active');
        }
        if(number == 1){
            $('.king-sold-tab2').addClass('king-sold-tab');
            $('.king-sold-tab2').removeClass('king-sold-tab-active');

            $('.king-sold-tab3').addClass('king-sold-tab');
            $('.king-sold-tab3').removeClass('king-sold-tab-active');
        }
    }
    function changeColorReyting(d)
    {
        $('.delete-reyting-bg').css('background','white');
        $(`.${d}`).css('background','#6a74b570');
    }
</script>
<script>
        $(document).ready(function () {
            setTimeout(() => { 
                $('.alert-danger').remove();
                $('.alert-success').remove();
            }, 4000);
            $('#choose-file-user').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-user-close').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user-close')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-king-sold').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-king-sold')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $("#submitSold").click(function(){        
                $("#soldForm").submit();
                $("#submitSold").addClass('d-none');
                $("#close-zakaz").removeClass('d-none');
            });
            // $("#kas").click();

            var check = <?php echo json_encode( Session::get('checksold') ) ?>;
            if(check != null)
            {
                $("#check").click();
            }

            var kingsold = <?php echo json_encode( Session::get('kingSold') ) ?>;
            if(kingsold != null)
            {
                $(`#opencheck${kingsold}`).click();
            }

            var kingsoldcheck = <?php echo json_encode( Session::get('kingCheck') ) ?>;
            if(kingsoldcheck != null)
            {
                $('#openkingchecksold').click();
            }
        });
        function openCode()
        {
            var code = makeCode();
            $('input[name=open_code]').val(code);
            $('.open-code').text(code);

        }
        function closeCode()
        {
            var code = makeCode();
            $('input[name=close_code]').val(code);
            $('.close-code').text(code);
        }
        function makeCode() {

            var sdf = localStorage.getItem('codes');

            var time_storage = localStorage.getItem('time_storage');
            var time_now = $.now();

            if(time_storage)
            {
                if((time_now - time_storage) > 900000)
                {
                    var result           = '';
                    var characters       = 'ABCDEFGHKLMNPQRSTUVWXYZ';
                    var numbers       = '123456789';
                    var charactersLength = characters.length;
                    var numbersLength = numbers.length;
                    for ( var i = 0; i < 1; i++ ) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    for ( var i = 0; i < 2; i++ ) {
                        result += numbers.charAt(Math.floor(Math.random() * numbersLength));
                    }
                    var sdf = localStorage.setItem('codes', result);
                    localStorage.setItem('time_storage', $.now());
                }
            }
            var sdf = localStorage.getItem('codes');

            // console.log($.now());
            if(!sdf)
            {
                var result           = '';
                var characters       = 'ABCDEFGHKLMNPQRSTUVWXYZ';
                var numbers       = '123456789';
                var charactersLength = characters.length;
                var numbersLength = numbers.length;
                for ( var i = 0; i < 1; i++ ) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                for ( var i = 0; i < 2; i++ ) {
                    result += numbers.charAt(Math.floor(Math.random() * numbersLength));
                }
                var sdf = localStorage.setItem('codes', result);
                localStorage.setItem('time_storage', $.now());
            }

            return sdf;

        }

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = number.toFixed(decimals);

            var nstr = number.toString();
            nstr += '';
            x = nstr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? dec_point + x[1] : '';
            var rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

            return x1 + x2;
        }
        function minus($id)
        {
            var stock = parseInt($(`.product${$id}`).val());
            if(stock <= 1)
            {
                $(`.product-border${$id}`).removeClass('plus-border');
                 $(`.product-border${$id}`).addClass('product-border')
            }
            if(stock != 0)
            {
                 ;
                 $(`.product${$id}`).val(stock-1);
                var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g,''));

                var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g,''));

                var allprice = number_format(orderPrice-price, 0, ',', ' ');

                $('.summa-zakaz').text(allprice);
            }
            
        }
        function plus($id)
        {
            var stock = parseInt($(`.product${$id}`).val());
            $(`.product${$id}`).val(stock+1);
            var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g,''));
            var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g,''));

            console.log(orderPrice);

            var allprice = number_format(price+orderPrice, 0, ',', ' ');

            $('.summa-zakaz').text(allprice);
            $(`.product-border${$id}`).addClass('plus-border');
            $('.plus-border').removeClass('product-border');

        }
        function changeDay(number)
        {
            // console.log(number);
            if(number == 0)
            {
                $('.first_one').addClass('d-none');
                $('.first_two').removeClass('d-none');
            }else{
                $('.first_two').addClass('d-none');
                $('.first_one').removeClass('d-none');
            }
            
        }
</script>
<script>
    var oylik = <?php echo json_encode(chartOylik()); ?>;
    var plan = <?php echo json_encode(chartPlan()); ?>;
    var liga = <?php echo json_encode(chartLiga()); ?>;
    var options = {
        
          series: [{
          name: 'Plan',
          data: plan
        //   data: [0,12,34,24,26]
        }, {
          name: 'Liga',
          data: liga,
        }
        ],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: oylik,
        //   categories: [0,2,3,3,2],
        },
        tooltip: {
          x: {
            // format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart_plan"), options);
        chart.render();
</script>
@endsection
