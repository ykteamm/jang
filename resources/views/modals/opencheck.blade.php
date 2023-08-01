<div class="modal fade" id="opencheck" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Elektron check</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    @if(Session::has('checksold'))
                    <div class="container">
                        <div class="container mb-4">
                            <div class="row h6 font-weight-bold">
                                <div class="col">Check summasi</div>
                                @php
                                $sum=0;
                                $all_sold = Session::get('checksold');
                                    foreach($all_sold as $item)
                                    {
                                        $sum += $item->price_product*$item->number;
                                    }
                                @endphp
                                <div class="col text-right text-mute">{{$sum}}</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            @foreach ($all_sold as $item)
                                <div class="media mb-4 w-100" >
                                    <div class="media-body">
                                        <a href="#">
                                            <p class="mb-1">{{$item->medicine->name}}</p>
                                        </a>
                                        <p><span class="text-success">{{$item->number}} x {{$item->price_product}} = {{$item->number* $item->price_product}}</span> 
                                            <span class="text-secondary small">so'm</span></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>