<div class="modal fade" id="teachgradestar" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="height: 100%">
        <div class="modal-content" style="background-image: url('/promo/dist/img/promo/bg2.png');
            background-repeat: no-repeat;">
            <div class="modal-body p-0">
                <div class="container">
                    <img src="{{asset('mobile/upheader.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" id="first-view-close" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
                </div>
                <div class="container p-0 mt-5">
                    <div class="mb-3">
                        
                        <form action="{{route('teach-test-store')}}" method="POST">
                            @csrf
                            <div class="col-12 col-md-6 pl-0 pr-0 mt-5">  
                                <div class=" border-0 mb-1">
                                    <div class="card-body pt-1 pb-1 text-center">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h4 class="text-white">
                                                    5 ballik tizimda ustozni baholang.Yulduzchani ustiga bosing.
                                                </h4>
                                            </div>
                                            <div class="col-12">

                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="material-icons allteachstar" id="teachstar{{$i}}" onclick="teachStar({{$i}})" style="color:white;font-size:60px;">star</i>
                                            @endfor
                                            <input type="number" class="d-none" id="teachstarinput" name="star" value="0">
                                            </div>

                                            <div class="col-12 mt-5">
                                                <button type="submit" class="mb-2 btn btn-lg btn-info" data-toggle="modal" data-target="#teachgradestar" style="background: #69d836ab;
                                        border-radius: 26px;">
                                            Saqlash
                                            </button> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
