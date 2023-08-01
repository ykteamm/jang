<div class="modal fade" id="exercise" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background: #60687b;">
            <div class="modal-body p-0">
                <div class="container">
                    <img src="{{asset('mobile/intop.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
                </div>
                @if (Auth::user()->status == 0)

                    @php
                    $getMoneyExercise = getMoneyExercise();
                    $getMoneyExerciseFirst = getMoneyExerciseFirst();
                    @endphp
                    @if (count($getMoneyExercise) > 0 || $getMoneyExerciseFirst)

                        <div style="background: #c0a47c;border-radius:15px;" class="m-1 pt-3 pb-3">
                            @foreach ($getMoneyExercise as $item)

                                <div class="mb-3">
                                    <div class="col-12">
                                        <div class="card border-0">
                                            <div class="card-body" class="pr-0" style="background: #e6d4b7;">
                                                <div class="row align-items-center">


                                                    <div class="col align-self-center">
                                                        <span class="mb-1 supercell text-dark" style="font-size:10px;">1 kunda {{number_format($item['task'],0,',','.')}} so'mdan ortiq savdo uchun</span>
                                                    </div>

                                                    <div class="col-auto text-right">
                                                        <button type="button" class="btn btn-secondary supercell" style="background: #c0a47c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            <div class="row" style="font-size:10px;color:#dee1e6">
                                                                Bonus
                                                            </div>
                                                            <div class="row text-center" style="margin-left: -2px;">
                                                                <img src="{{asset('mobile/oltin.png')}}" width="20px">
                                                            </div>
                                                            <div class="row text-center" style="font-size:10px;color:#dee1e6;padding-right:-2px;">
                                                                <span class="text-center pl-1">x {{number_format($item['premya'],0,',','.')}}</span>
                                                            </div>

                                                        </button>
                                                    </div>

                                                </div>
                                                <div class="row align-items-center">

                                                    @if ($item['done'] == 1)
                                                        <div class="col align-self-center">
                                                            <span style="fint-size:20px;" class="mb-1 badge badge-info" style="font-size:10px;">Bajarildi: {{$item['fakt']}} so'm savdo bilan</span>
                                                        </div>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            @if ($getMoneyExerciseFirst)
                                @php
                                    $task = $getMoneyExerciseFirst;
                                @endphp
                            <div class="mb-3">
                                <div class="col-12">
                                    <div class="card border-0">
                                        <div class="card-body" class="pr-0" style="background: #e6d4b7;">
                                            <div class="row align-items-center">


                                                <div class="col align-self-center">
                                                    <span class="mb-1 supercell text-dark" style="font-size:10px;">1 kunda {{number_format($task->task,0,',','.')}} so'mdan ortiq savdo uchun</span>
                                                </div>

                                                <div class="col-auto text-right">
                                                    <button type="button" class="btn btn-secondary supercell" style="background: #c0a47c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        <div class="row" style="font-size:10px;color:#dee1e6">
                                                            Bonus
                                                        </div>
                                                        <div class="row text-center" style="margin-left: -2px;">
                                                            <img src="{{asset('mobile/oltin.png')}}" width="20px">
                                                        </div>
                                                        <div class="row text-center" style="font-size:10px;color:#dee1e6;padding-right:-2px;">
                                                            <span class="text-center pl-1">x {{number_format($task->premya,0,',','.')}}</span>
                                                        </div>

                                                    </button>
                                                </div>

                                            </div>
                                            <div class="row align-items-center">
                                                    <div class="col align-self-center">
                                                        <span style="fint-size:20px;" class="mb-1 badge badge-info" style="font-size:10px;">Bajarildi: {{number_format(getTodaySold(Auth::id()))}} so'm</span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>

                    @endif
                @else
                <div style="background: #c0a47c;border-radius:15px;" class="m-1 pt-3 pb-3">
                    @foreach (getExercises() as $item)
                        @php
                            $make = $item['make'];
                            $plan = $item['plan'];
                            $prot = $make*100/$plan;
                        @endphp
                    <div class="mb-3">
                        <div class="col-12">
                            <div class="card border-0">
                                <div class="card-body" class="pr-0" style="background: #e6d4b7;">
                                    <div class="row align-items-center">

                                        <div class="col-auto pr-0">
                                            @if ($make >= $plan)
                                                <img src="{{asset('mobile/oke.png')}}" width="25px" style="border-radius:15px;" alt="">
                                            @else
                                                <img src="{{asset('mobile/nooke.png')}}" width="25px" style="border-radius:15px;" alt="">
                                            @endif
                                        </div>
                                        <div class="col align-self-center">
                                            <span class="mb-1 supercell text-dark" style="font-size:10px;">{{$item['name']}}</span>

                                            <div class="progress mb-3">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$prot}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$make}}/{{$plan}}</div>
                                            </div>
                                        </div>

                                        <div class="col-auto text-right">
                                            <button type="button" class="btn btn-secondary supercell" style="background: #c0a47c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                <div class="row" style="font-size:10px;color:#dee1e6">
                                                    Bonus
                                                </div>
                                                <div class="row text-center" style="margin-left: -2px;">
                                                    <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px">
                                                </div>
                                                <div class="row text-center" style="font-size:10px;color:#dee1e6;padding-right:-2px;">
                                                    <span class="text-center pl-1">x{{$item['bonus']}}</span>
                                                </div>

                                            </button>
                                        </div>

                                    </div>
                                    <div class="row align-items-center">

                                        <div class="col-auto pr-0">
                                            <span style="fint-size:20px;" class="mb-1 badge badge-info" style="font-size:10px;">Plan: {{$plan}}</span>
                                        </div>
                                        <div class="col align-self-center">
                                            <span style="fint-size:20px;" class="mb-1 badge badge-info" style="font-size:10px;">Bajarildi: {{$make}}</span>
                                        </div>

                                        @if ($make >= $plan)
                                        <div class="col-auto text-right">
                                            <span style="fint-size:20px;" class="mb-1 badge badge-success" style="font-size:10px;">Bajarildi</span>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                    @php
                        $getMoneyExercise = getMoneyExercise();
                        $getMoneyExerciseFirst = getMoneyExerciseFirst();
                    @endphp
                    @if (count($getMoneyExercise) > 0 || $getMoneyExerciseFirst)

                        <div style="background: #c0a47c;border-radius:15px;" class="m-1 pt-3 pb-3">
                            @foreach ($getMoneyExercise as $item)

                                <div class="mb-3">
                                    <div class="col-12">
                                        <div class="card border-0">
                                            <div class="card-body" class="pr-0" style="background: #e6d4b7;">
                                                <div class="row align-items-center">


                                                    <div class="col align-self-center">
                                                        <span class="mb-1 supercell text-dark" style="font-size:10px;">1 kunda {{number_format($item['task'],0,',','.')}} so'mdan ortiq savdo uchun</span>
                                                    </div>

                                                    <div class="col-auto text-right">
                                                        <button type="button" class="btn btn-secondary supercell" style="background: #c0a47c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            <div class="row" style="font-size:10px;color:#dee1e6">
                                                                Bonus
                                                            </div>
                                                            <div class="row text-center" style="margin-left: -2px;">
                                                                <img src="{{asset('mobile/oltin.png')}}" width="20px">
                                                            </div>
                                                            <div class="row text-center" style="font-size:10px;color:#dee1e6;padding-right:-2px;">
                                                                <span class="text-center pl-1">x {{number_format($item['premya'],0,',','.')}}</span>
                                                            </div>

                                                        </button>
                                                    </div>

                                                </div>
                                                <div class="row align-items-center">

                                                    @if ($item['done'] == 1)
                                                        <div class="col align-self-center">
                                                            <span style="fint-size:20px;" class="mb-1 badge badge-info" style="font-size:10px;">Bajarildi: {{$item['fakt']}} so'm savdo bilan</span>
                                                        </div>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            @if ($getMoneyExerciseFirst)
                                @php
                                    $task = $getMoneyExerciseFirst;
                                @endphp
                            <div class="mb-3">
                                <div class="col-12">
                                    <div class="card border-0">
                                        <div class="card-body" class="pr-0" style="background: #e6d4b7;">
                                            <div class="row align-items-center">


                                                <div class="col align-self-center">
                                                    <span class="mb-1 supercell text-dark" style="font-size:10px;">1 kunda {{number_format($task->task,0,',','.')}} so'mdan ortiq savdo uchun</span>
                                                </div>

                                                <div class="col-auto text-right">
                                                    <button type="button" class="btn btn-secondary supercell" style="background: #c0a47c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        <div class="row" style="font-size:10px;color:#dee1e6">
                                                            Bonus
                                                        </div>
                                                        <div class="row text-center" style="margin-left: -2px;">
                                                            <img src="{{asset('mobile/oltin.png')}}" width="20px">
                                                        </div>
                                                        <div class="row text-center" style="font-size:10px;color:#dee1e6;padding-right:-2px;">
                                                            <span class="text-center pl-1">x {{number_format($task->premya,0,',','.')}}</span>
                                                        </div>

                                                    </button>
                                                </div>

                                            </div>
                                            <div class="row align-items-center">
                                                    <div class="col align-self-center">
                                                        <span style="fint-size:20px;" class="mb-1 badge badge-info" style="font-size:10px;">Bajarildi: {{number_format(getTodaySold(Auth::id()))}} so'm</span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>

                    @endif

                @endif
            </div>
        </div>
    </div>
</div>
