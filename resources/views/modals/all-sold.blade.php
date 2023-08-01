@isset($all_sold)
        @foreach ($all_sold as $sold)
        <div class="modal fade" id="check{{$sold->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{$sold->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">

                {{-- <div class="modal fade" id="hisbot" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document"> --}}

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Elektron check</h5>
    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                            <img src="{{asset('mobile/xclose.png')}}" width="30px">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3">
                            <div class="container">
                                <div class="container mb-4">
                                    <div class="row h6 font-weight-bold">
                                        <div class="col">Check summasi</div>
                                        @php
                                        $sum=0;
                                        $arr = $sold->sold;
                                        $category=0;
                                        $categoryTea=0;
                                            foreach($arr as $item)
                                            {
                                                $sum = $sum + $item->price_product*$item->number;
                                                if(in_array($item->medicine->category_id,getCategoryId()))
                                                {
                                                    $category += $item->number;
                                                }
                                                if(in_array($item->medicine->category_id,getCategoryTeaId()))
                                                {
                                                    $categoryTea += $item->number;
                                                }
                                            }
                                        @endphp
                                        <div class="col text-right text-mute">{{$sum}}</div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    @foreach ($sold->sold as $med)
                                        <div class="media mb-4 w-100" >
                                            <div class="media-body">
                                                <a href="#">
                                                    <p class="mb-1">{{$med->medicine->name}}</p>
                                                </a>
                                                <p><span class="text-success">{{$med->number}} x {{$med->price_product}} = {{$med->number* $med->price_product}}</span> 
                                                    <span class="text-secondary small">so'm</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($sum >= 200000 || ($category >= 1 && $categoryTea >= 2) || ($categoryTea >= 4))
                                    @if (count($sold->king_sold) >= 1)
                                    @foreach ($sold->king_sold as $item)
                                        
                                        @if($item->image != 'add')
                                            @if ($item->admin_check == 2)
                                                <div class="container mb-4">
                                                    <h6 class="text-center">Shox yurish cheki qabul qilindi</h6>
                                                    <h6 class="text-center">
                                                        <span class="badge badge-danger">
                                                            Admin rad javobini berdi
                                                        </span>
                                                    </h6>
                                                </div>
                                                <form action="{{route('king.sold',$sold->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="container mb-4">
                                                            <h6 class="text-center">Rasmni qayta jo'natish</h6>
                                                    <div class="container mb-2 mt-2 text-center">
                                                        <input name="image" type="file"/>
                                                    </div>
                                                    <div class="container mb-4" id="for-king-sold-check-none2">
                                                        <button type="submit" 
                                                        onclick="$('#for-king-sold-check-none2').addClass('d-none');$('#for-king-sold-check2').removeClass('d-none');" 
                                                        class="btn btn-success px-2 btn-block rounded">Qayta saqlash</button>
                                                    </div>
                                                    <div class="container mb-4 d-none" id="for-king-sold-check2">
                                                        <button type="button" class="btn btn-primary px-2 btn-block rounded">Biroz kuting !!!</button>
                                                    </div>
                                                    </div>
                                                </form>
                                            @endif
                                            @if ($item->admin_check == 1)
                                                <div class="container mb-4">
                                                    <h6 class="text-center">Shox yurish cheki qabul qilindi</h6>
                                                    <h6 class="text-center">
                                                        <span class="badge badge-success">
                                                            Admin tasdiqladi
                                                        </span>
                                                    </h6>
                                                </div>
                                            @endif
                                            @if ($item->admin_check == 0)
                                                <div class="container mb-4">
                                                    <h6 class="text-center">Shox yurish cheki qabul qilindi</h6>
                                                    
                                                    <h6 class="text-center">
                                                        <span class="badge badge-primary">
                                                            Admin tasdiqlashini kuting
                                                        </span>
                                                    </h6>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach

                                    @else
                                    <form action="{{route('king.sold',$sold->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="container mb-4">
                                                <h6 class="text-center">Agar sizda shox yurish cheki bo'lsa</h6>
                                                <h6 class="text-center">rasmga olib jo'nating</h6>
                                        <div class="container mb-2 mt-2 text-center">
                                            <input name="image" type="file"/>
                                        </div>
                                        <div class="container mb-4" id="for-king-sold-check-none">
                                            <button type="submit" 
                                            onclick="$('#for-king-sold-check-none').addClass('d-none');$('#for-king-sold-check').removeClass('d-none');" 
                                            class="btn btn-success px-2 btn-block rounded">Saqlash</button>
                                        </div>
                                        <div class="container mb-4 d-none" id="for-king-sold-check">
                                            <button type="button" class="btn btn-primary px-2 btn-block rounded">Biroz kuting !!!</button>
                                        </div>
                                        </div>
                                    </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endisset