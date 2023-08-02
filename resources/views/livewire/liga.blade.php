<div>
    @if ($resime == 2)
        
        <div class="container mb-3">
            <div class="row">
                <div class="col-10">
                    <img class="mt-3" src="{{asset('mobile/allliga.webp')}}" width="100%" alt="">
                </div>
                <div class="col-2 pl-0">
                        <img class="mt-3" src="{{asset('mobile/changeplan.webp')}}" width="60%" height="auto"  alt="" data-toggle="modal" data-target="#change_plan">
                </div>

            </div>
        </div>
        <div class="card p-0 mr-2 ml-2" style="background: #cee0e9">
            <div style="position: relative">
                <div style="position: absolute;top:-16px;left:0;right:0;bottom:0;z-index:1000" class="d-flex align-items-center justify-content-center" >
                    <div class="supercell text-white" style="font-size:22px">
                        {{ getMonthName(date("F")) }}
                    </div>
                </div>
                <img src="{{asset('mobile/defaultMonth.png')}}" width="105%" style="border-radius:15px;margin-left: -10px;margin-top:-2px;position:relative">
            </div>
            <div class="card p-0 m-2" style="background: none;margin-top: -12px !important;-webkit-box-shadow: 0px 0px 0px rgb(0 0 0 / 0%)">
                <div class="row">
                    <div class="col-4 pl-4" style="background-image: url({{asset('mobile/flag.webp')}});background-size: 100% 100%;height:100px;margin-top: 0px !important;margin-left:20px;">
                        <img src="{{asset('mobile/'.LigasUser(Auth::id())->image)}}" width="60px" style="margin-top: 13px !important;margin-left:9px;">
                    </div>
                    <div class="col-6 text-center" style="margin-top: 9px !important;background:#cd7c47;border-radius:6px;margin-left:17px;">
                        <p class="m-0 p-0 gilroy" style="font-size: 30px;font-weight:700;-webkit-text-stroke: 1px #28252a;color:aliceblue" >
                            @if (myLiga(Auth::id())->name != 'Default')
                                {{myLiga(Auth::id())->name}}
                            @else

                            @endif
                        </p>
                    <span class="gilroy" style="font-size: 25px;font-weight:700;-webkit-text-stroke: 1px #28252a;color:aliceblue;"> {{number_format(myFakt(Auth::id()),0,',',' ')}} </span>
                    </div>
                </div>
            </div>
            <div class="col-12  supercell">
                <div class="card border-0 mb-1">
                    <div class="card-body pt-2 pl-2" style="background: #f4b830;border-radius:15px;">
                        <div class="row align-items-center">
                            <div class="col-3">
                                <img src="{{asset('mobile/target.webp')}}" width="40px;">
                            </div>
                            <div class="col-9 pl-0 pr-2">
                                <button type="button" class="btn btn-sm btn-block btn-secondary gilroy" style="-webkit-text-stroke: 1px #28252a;font-size:20px;background: #cd7c47;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <span>Plan: <span>{{number_format(myPlan(Auth::id()),0,',',' ')}}</span> </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12  supercell">
                <div class="card border-0 mb-1">
                    <div class="card-body pt-2 pl-2 d-flex align-items-center justify-content-between" style="background: #ccd142;border-radius:15px;">
                        <span class="supercell">Prognoz: </span>
                        <span class="supercell">{{number_format(myPrognoz(),0,',',' ')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div style="background:#cee0e9;border-radius:6px;" class="m-2 p-0 mb-0 pb-2">
            <div id="chart_plan">

            </div>
        </div>
        <script>
            var oylik = <?php echo json_encode(chartOylik()); ?>;
            var plan = <?php echo json_encode(chartPlan()); ?>;
            var liga = <?php echo json_encode(chartLiga()); ?>;
            var options = {
                series: [{
                    name: 'Plan',
                    data: plan
                }, {
                    name: 'Liga',
                    data: liga,
                }],
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
                },
                tooltip: {
                    x: {},
                },
            };
    
            var chart = new ApexCharts(document.querySelector("#chart_plan"), options);
            chart.render();
        </script>
    @endif

</div>
