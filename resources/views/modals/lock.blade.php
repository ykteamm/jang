<div class="modal fade" id="lock" tabindex="-1" role="dialog" aria-labelledby="LockElchiModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('mobile/ligam.webp') }}" width="111%"
                    style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="opacity: 5;position:absolute;top:8px;right:10px;">
                    <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="container p-0">
                    <div class="p-2" style="font-size:20px;font-weight:600">
                        <strong style="color:#000">{{ getMonthName(date('F', strtotime('-1 month'))) }}</strong>
                        oyiga
                        ko'ra siz <strong style="color:#000">{{ number_format($lock->prodaja, 0, '', ' ') }}</strong>
                        <span style="color:#000">so'm</span>
                        sotuv qilgansiz !
                        Sizga <strong style="color:#000">LAQQA</strong> statusi berildi
                    </div>
                    <div class="p-1">
                        @if ($lock->mayBeLocked)
                            <button class="btn btn-danger w-100 mt-0 d-flex align-items-center justify-content-between">
                                <div class="" style="font-size:20px;font-weight:800">
                                    Blokirovkaga qoldi
                                </div>
                                <span class="d-flex align-items-end">
                                    <span class="mr-1" style="font-size:20px;font-weight:800" id="lockDayModal">
                                        {{ $lock->day }}
                                    </span>
                                    kun <strong class="px-1" style="font-weight:800;font-size:22px">
                                        {{ ' : ' }} </strong>
                                    <span class="mr-1" style="font-size:20px;font-weight:800" id="lockHourModal">
                                        {{ $lock->hour }}
                                    </span>
                                    soat
                                </span>
                            </button>
                        @endif
                    </div>
                    <div class="p-2" style="font-size:20px;font-weight:600">
                        Akkauntni blokirovkaga tushmasligi uchun
                        oyiga <strong style="color:#000">10 000 000</strong> <span style="color:#000">so'm</span>
                        savdo qilishingiz kerak !
                    </div>
                    <div>
                        <div class="row d-grid">
                            @if($lock->weeks != null)
                            @foreach ($lock->weeks as $week => $desc)
                                <div class="col-6">
                                    <div class="p-2">
                                        <div style="border:2px solid @if($desc['sum'] > 2500000) green @else red @endif"
                                            class="p-2 border-2 text-center bold h5 rounded rounded-2">
                                            <div style="font-weight:600" class="pb-1">
                                                {{ $week }}
                                            </div>
                                            <div style="font-size:16px;font-weight:600">
                                                {{ number_format($desc['sum'], 0, '', ' ') }}/2 500 000
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
