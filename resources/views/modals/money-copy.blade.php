<style>
    .outer-ziggg {
        height: 400px;
        /* display:grid; */
        aspect-ratio: 1;
        border: 1px solid;
        margin-bottom: 5px;
        border: none;
        background: linear-gradient(135deg, #1f005c, #5b0060, #870160, #ac255e, #ca485c, #e16b5c, #ca485c, #870160, #5b0060, #1f005c);
        -webkit-mask:
            conic-gradient(from -45deg at bottom, #0000, #000 1deg 89deg, #0000 90deg) 50%/40px 100%;
    }

    .inner-ziggg {
        width: 100%;
        height: 300px;
        /* display:grid;
      place-content:center;
      font-size:35px; */
        font-weight: bold;
        aspect-ratio: 1;
        border: 1px solid;
        margin-bottom: 5px;
        border: none;
        /* background:linear-gradient(135deg,#9ba7ad, #cfa5d2, #ca9ebe, #9f6d82, #e4a3ad, #a37670, #bf866a, #b79d8f);
      -webkit-mask:
          conic-gradient(from -45deg at bottom,#0000,#000 1deg 89deg,#0000 90deg) 50%/40px 100%; */
    }
</style>

<div class="modal fade" id="money" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body p-0">
                    <div class="swiper-container swiper-cards">
                        <div class="pb-4">
                            @foreach (getMonthM(1) as $item)
                                <div class="w-100 outer-ziggg">
                                    <div class="inner-ziggg p-2">
                                        <h2 class="mb-1 text-white pt-2" style="text-align:center;font-weight:800">
                                            {{ getMonthName($item['month_name']) }}</h2>
                                        <div style="padding: 5px 0 10px 0; border-bottom:3px dashed white"
                                            class="mx-2"></div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight:700"
                                                class="text-white d-flex align-items-center pt-3">
                                                <img src="{{ asset('mobile/oltin.png') }}" width="20px;"
                                                    class="mr-1">
                                                <h4 style="font-weight:700">
                                                    {{ number_format($item['summa'], 0, ',', ' ') }} <span
                                                        style="font-size:14px">so'm</span></h4>
                                            </div>
                                            <h4 class="text-white pt-3" style="font-weight:700">
                                                {{ number_format($item['maosh'], 0, ',', ' ') }} <span
                                                    style="font-size:14px">so'm</span></h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center pt-3">
                                            <button onclick="jarimalar()" class="btn btn-light"
                                                style="font-weight:700;font-size:15px">
                                                Ishlangan vaqt
                                            </button>
                                            <h4 class="text-white" style="font-weight:700">
                                                @if ($item['jarima'])
                                                    -{{ number_format($item['jarima'], 0, ',', ' ') }}
                                                @else
                                                    0
                                                @endif
                                                <span style="font-size:14px">so'm</span>
                                            </h4>
                                        </div>
                                        <div id="jarimalar" style="display:none">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-white">
                                                    Ishlanmagan vaqt:
                                                </span>
                                                <h5 class="text-white" style="font-weight:600">
                                                    {{ number_format($item['time'], 0, ',', ' ') }} <span
                                                        style="font-size:14px">minut</span></h5>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-white">
                                                    Olib qolinadigan:
                                                </span>
                                                <h5 class="text-white" style="font-weight:600">
                                                    {{ number_format($item['jarima'], 0, ',', ' ') }} <span
                                                        style="font-size:14px">so'm</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-2 pt-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="text-white">
                                                Natija:
                                            </h4>
                                            <h4 class="text-white" style="font-weight:700">
                                                {{ number_format($item['maosh'] - $item['jarima'], 0, ',', ' ') }} <span
                                                    style="font-size:14px">so'm</span></h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-footer">
                        <div class="row mb-4">
                            <div class="col p-0">
                                @foreach (fff() as $key => $item)
                                    <div class="col-12 col-md-6 gilroy p-0">
                                        <div class="card border-0 mb-1">
                                            <div class="card-body" style="background: #e5cfbb;border-radius:15px;">
                                                <div class="w-100 mt-2">
                                                    <button style="background-color: coral" class="w-100 btn btn-sm">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div style="font-weight:700"
                                                                class="text-white d-flex align-items-center">
                                                                <img src="{{ asset('mobile/oltin.png') }}"
                                                                    width="18" class="mr-1">
                                                                <span style="font-weight:700">
                                                                    {{ number_format($item['fact'], 0, ',', ' ') }}
                                                                    <span style="font-size:14px">so'm</span>
                                                                </span>
                                                            </div>
                                                            <div class="text-white">
                                                                {{ number_format($item['maosh'], 0, '', ' ') }}
                                                                so'm
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3 d-flex align-items-center">
                                                        <div class="ish-sana pr-2">
                                                            <div class="h6">{{ date('d.m', strtotime($key)) }}
                                                            </div>
                                                            <div class="h5">{{ date('Y', strtotime($key)) }}</div>
                                                        </div>
                                                        <div style="width:4px;height:100%;background:#ffffff"
                                                            class="lenta"></div>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span style="color:#37255b">
                                                                Smena:
                                                            </span>
                                                            <span>
                                                                @if ($item['open_date'])
                                                                    {{ date('H:i', strtotime($item['open_date'])) }}
                                                                @else
                                                                    <span style="font-size:13px">No open</span>
                                                                @endif
                                                                -
                                                                @if ($item['close_date'])
                                                                    {{ date('H:i', strtotime($item['close_date'])) }}
                                                                @else
                                                                    <span style="font-size:13px">No close</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span style="color:#37255b">
                                                                Natija:
                                                            </span>
                                                            <span>
                                                                {{ number_format($item['maosh'] - $item['jarima'], 0, ',', ' ') }}
                                                                so'm
                                                            </span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span style="color:#37255b">
                                                                Ishlanmagan:
                                                            </span>
                                                            <span>
                                                                {{ number_format($item['minut'], 0, ',', ' ') }}
                                                                min
                                                            </span>
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
    </div>
</div>
@section('scripts')
    <script>
        function jarimalar() {
            var jarima = document.getElementById("jarimalar")
            if (jarima.style.display == 'none') {
                console.log(jarima)
                jarima.style.display = 'block'
                console.log("AAA", jarima.style.display)
            } else {
                jarima.style.display = 'none'
                console.log(jarima)
            }
        }
    </script>
@endsection
