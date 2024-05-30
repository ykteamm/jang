<div class="modal fade" id="plan_edit" tabindex="-1" role="dialog" aria-labelledby="Plan" aria-hidden="true">
    @php use Carbon\Carbon; $ids=1; @endphp
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 0 !important;">
                {{--                <img src="{{asset('mobile/vil.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">--}}
                <div class="container p-0" style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
                    <span class="supercell text-white pl-3" style="font-size:25px;">Jamoaviy oylik plan</span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
                <div class="modal-body p-0">
                    <div class="container p-0">
                        <div class="mb-3 pt-3">
                            <div class="col-12">
                                <div class="container p-1" style="background:#3ad1717d;border-radius:13px; margin-bottom: 20px" data-toggle="modal" data-target="#new-elchi">
                                    <div data-toggle="modal" data-target="#myshogirdin" class="p-2">
                                        <div class="border-0 mb-1">
                                            <div class="card-body" style="border-radius:15px;">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <h3 style="color: black;">Umumiy</h3>
                                                    </div>
                                                    <div class="col-12"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                        @foreach (getShogirdUser() as $key => $item)
                                                            @php
                                                                $month_plan = OylikPlan($item->id);
                                                            @endphp
                                                            @if($month_plan)
                                                            <h6 style="border-bottom: 1px solid gray;color: black">
                                                                @php
                                                                    $date = new DateTime($month_plan->start_month_date);
                                                                    $monthNumber = $date->format('n');
                                                                    $uzbekMonths = [
                                                                        1 => 'Yanvar',
                                                                        2 => 'Fevral',
                                                                        3 => 'Mart',
                                                                        4 => 'Aprel',
                                                                        5 => 'May',
                                                                        6 => 'Iyun',
                                                                        7 => 'Iyul',
                                                                        8 => 'Avgust',
                                                                        9 => 'Sentabr',
                                                                        10 => 'Oktabr',
                                                                        11 => 'Noyabr',
                                                                        12 => 'Dekabr',
                                                                    ];
                                                                    $monthName = $uzbekMonths[$monthNumber];
                                                                @endphp
                                                                {{$monthName}}  plan
                                                                <br>
                                                            </h6>
                                                            <h6 style="color: red">
                                                                <input type="text" id="month_plan_jamoa_edit" style="text-align: center" value="{{$month_plan->oylik_plan}}" disabled>
                                                            </h6>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="{{route('month_plan_edit',\Illuminate\Support\Facades\Auth::id())}}" method="POST">
                                @csrf
                                @method('PUT')
                            @foreach (getShogirdUser() as $key => $item)
                                @php
                                $user_plan = OylikPlanView($item->id);
                                @endphp
                                <div class="col-12">
                                        <div class="container p-1" style="background:#3ad1717d;border-radius:13px; margin-bottom: 20px" >
                                            <div class="p-2">
                                                <div class="border-0 mb-1">
                                                    <div class="card-body" style="border-radius:15px;">
                                                        <div class="row">
                                                            <div class="col-12" style="border: 1px solid gray;padding:15px;display: flex;align-items:center; ">
                                                                <span style="color: black; margin-right: 10px;padding: 5px">
                                                                   {{$key+1}}
                                                                </span>
                                                                <input type="hidden" name="user_id[]" value="{{$item->id}}">
                                                                <h6 style="color: black">
                                                                    {{$item->first_name}} {{$item->last_name}} <br> Login: {{$item->username}} <br> Parol: {{$item->pr}}
                                                                </h6>
                                                            </div>
                                                            <div class="col-12"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                                <h6 style="border-bottom: 1px solid gray;color: black">
                                                                    Oylik plan
                                                                    <br>
                                                                </h6>
                                                                <h6 style="color: white">
                                                                    <input type="text" name="user_plan[]" value="{{$user_plan}}"  id="month_plan_edit{{$item->id}}">
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            @endforeach
                                <div class="text-center" style="display: none;" id="save_plan_edit">
                                    <button type="submit" class="btn btn-primary">
                                        Tahrirlash
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

