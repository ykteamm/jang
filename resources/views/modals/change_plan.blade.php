<div class="modal fade" id="change_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <div class="modal-body">
                @php
                    $ligas = App\Models\Liga::where('plan','>',0)->orderByDesc('plan')->get();
                @endphp
                <div class="card mb-3">
                    <div class="card-footer">
                        <div class="row mb-4">
                            <div class="col p-0">
                                @foreach ($ligas as $key => $item)
                                <div class="col-12   p-0">
                                    <div class="card border-0 mb-1">
                                        <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;">
                                            <div class="row align-items-center">
                                                <div class="col-2 pr-0 ">
                                                    <img src="{{asset('mobile/'.$item->image)}}" width="30px;">
                                                </div>
                                                <div class="col-4 pl-0 supercell">
                                                    <span class="mb-1" style="color: #272730;font-size:17px">{{$item->name}}</span>
                                                </div>
                                                <div class="col-6 pl-0 text-right supercell">
                                                    <button type="button" class="btn btn-sm btn-secondary supercell" style="font-size:15px;background: #0058c3e0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        Plan: {{numb($item->plan,0,',',' ')}} +
                                                    </button>
                                                </div>
                                                <div class="col-8 pr-0 mt-2">
                                                    <button type="button" class="btn btn-sm btn-secondary " style="font-size:15px;background: #c86418;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                        Oylik: {{number_format(maosh($item->plan,0,',',' '),0,',',' ')}} +
                                                    </button>
                                                </div>
                                                @if (myPlan(Auth::id()) < $item->plan)
                                                
                                                <div class="col-4 pl-0 mt-2 text-right for-plan-text-active">
                                                    <form action="{{route('change.plan')}}" method="post">
                                                        @csrf
                                                        <input type="number" value="{{$item->id}}" name="liga_id" class="d-none">
                                                        <button type="submit" onclick="changeTextPlan()" class="btn btn-sm btn-success " style="font-size:15px;background: #099b2a;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            <span>Tanlash</span>
                                                        </button>
                                                    </form>

                                                </div>
                                                <div class="col-4 pl-0 mt-2 text-right d-none for-plan-text">
                                                        <button type="button" class="btn btn-sm btn-success " style="font-size:13px;background: #099b2a;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                            <span>Biroz kuting !</span>
                                                        </button>
                                                </div>
                                                @endif
                                                
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