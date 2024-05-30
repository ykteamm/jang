<div class="modal fade" id="plan_check" tabindex="-1" role="dialog" aria-labelledby="Plan" aria-hidden="true">
    @php use Carbon\Carbon; $ids=1;  @endphp
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
                                                        @php
                                                            $total_plan = 0;
                                                            $month_plan = 0;
                                                        @endphp
                                                        @foreach (getShogirdUser() as $key => $item)
                                                            @php
                                                                $month_plan = OylikPlan($item->id);
                                                                $total = OylikShogirdStatistic($item->id);
                                                                $total_plan += $total;
                                                            @endphp
                                                            @if($month_plan)
                                                            <h6 style="border-bottom: 1px solid gray;color: black ; display: flex;justify-content: center;align-items: center">
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
                                                                {{ $monthName }}  plan
                                                                <div style="margin-left: 20px">
                                                                    <button type="button" class="my-2 btn btn-info w-100 mt-0 d-flex align-items-center justify-content-between"
                                                                       data-toggle="modal" data-target="#plan_edit">Edit</button>
                                                                </div>
                                                            </h6>

                                                            @endif
                                                        @endforeach
                                                        <span style="color: blue">
                                                            {{ number_format($total_plan, 0, '.', ' ') }} /
                                                        </span>
                                                        @foreach (getShogirdUser() as $key => $item)
                                                            @php
                                                                $month_plan = OylikPlan($item->id);
                                                            @endphp
                                                            @if($month_plan)
                                                            <span style="color: red">
                                                                   / {{$month_plan->oylik_plan}}
                                                            </span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach (getShogirdUser() as $key => $item)
                                @php $plan = OylikShogirdStatistic($item->id); $view = OylikPlanView($item->id);  $test = raqamni_aylantirish($view) @endphp
                                <div class="col-12">
                                        <div class="container p-1" style="background:#cce0d37d;border-radius:13px; margin-bottom: 20px" >
                                            <div class="p-2">
                                                <div class="border-0 mb-1">
                                                    <div class="card-body" style="border-radius:15px;">
                                                        <div class="row">
                                                            <div class="col-12" style="border: 1px solid gray;padding:15px;display: flex;align-items:center;">
                                                                <span style="color: black; margin-right: 10px;padding: 5px">
                                                                   {{$key+1}}
                                                                </span>
                                                                <h6 style="color: black">
                                                                    {{$item->first_name}} {{$item->last_name}} <br> Login: {{$item->username}} <br> Parol: {{$item->pr}}
                                                                </h6>

                                                            </div>
                                                            <div class="col-12"  style="border: 1px solid gray;padding-top: 10px;text-align: center;">
                                                                <h6 style="border-bottom: 1px solid gray;color: black">
                                                                    Oylik plan
                                                                    <br>
                                                                </h6>
                                                                @if($plan > $test)
                                                                    <span style="color: limegreen">
                                                                        {{number_format($plan, 0, '.', ' ')}} /
                                                                    </span>
                                                                @else
                                                                <span style="color: black">
                                                                     {{number_format($plan, 0, '.', ' ')}} /
                                                                </span>
                                                                @endif
                                                                <span style="color: red">
                                                                    / {{$view}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

