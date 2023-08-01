<div class="modal-content">
    @if($resime == 2)
    <div class="modal-header">
        <img src="{{asset('mobile/hisobot.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
    </div>
    <div class="row justify-content-equal no-gutters mb-2">
        <div class="col-12 text-center">
            Ish grafigi
        </div>
        <div class="col-6 text-center">
            {{$start_work}}
        </div>
        <div class="col-6 text-center">
            {{$finish_work}}
        </div>
    </div>
    <div class="row justify-content-equal no-gutters">
        
        <div class="col-12 text-center mb-5">
                  <button type="button" class="mb-2 btn btn-sm btn-outline-info" wire:click="$emit('last30','Bugun')">Bugun</button>
                  <button type="button" class="mb-2 btn btn-sm btn-outline-info" wire:click="$emit('last30','Kecha')">Kecha</button>
                  <button type="button" class="mb-2 btn btn-sm btn-outline-info" wire:click="$emit('last30','O\'tgan kun')">O'tgan kun</button>
                  <button type="button" class="mb-2 btn btn-sm btn-outline-info" wire:click="$emit('last30','Oxirgi 7 kun')">Oxirgi 7 kun</button>
                  <button type="button" class="mb-2 btn btn-sm btn-outline-info" wire:click="$emit('last30','Oxirgi 30 kun')">Oxirgi 30 kun</button>
                  <button type="button" class="mb-2 btn btn-sm btn-outline-info" wire:click="$emit('last30','Shu hafta')">Shu hafta</button>
                  <button type="button" class="mb-2 btn btn-sm btn-outline-info" wire:click="$emit('last30','Shu oy')">Shu oy</button>
                  {{-- <button type="button" class="mb-2 btn btn-sm btn-info" wire:click="$emit('last30','Shu yil')">Shu yil</button> --}}
                  {{-- <button type="button" class="mb-2 btn btn-sm btn-info" wire:click="$emit('last30','Oldingi yil')">Oldingi yil</button> --}}
                  {{-- <button type="button" class="mb-2 btn btn-sm btn-info" wire:click="$emit('last30','Hammasi')">Hammasi</button> --}}
        </div>
        <div class="col-12 mb-4">
            <form wire:submit.prevent="submit" class="form">
                <div class="d-flex justify-content-between align-items-center px-2">
                    <div class="px-2">
                        <input value="{{ $start_date }}" class="form-control form-control-sm" type="date" wire:model="start_date">
                    </div>
                    <div class="px-2">
                        <input value="{{ $end_date }}" class="form-control form-control-sm" type="date" wire:model="end_date">
                    </div>
                    <div class="px-2">
                        <input type="submit" value="Ko'rish" class="btn btn-sm btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-body accordion p-2 ml-2 mr-2" id="accordionExample" @if(count($hisobot) > 0) style="border:1px solid rgb(73, 84, 141);border-radius:15px;" @endif>
        @if(count($hisobot) > 0) 
        <div>
            <h4 class="text-center">Smena hisobot</h4>
            
        </div>
        @endif
        <div @if(count($medicine) > 0) style="border:1px solid #07132ea3;border-radius:15px;" class="pt-2 mb-2"  @endif>

        @foreach ($hisobot as $h)

        <div class="container mb-1" >
            <div class="alert" style="background-color: #6b768c4f;color:#272730;font-size:20px;">
                <div class="media">
                            <div class="row align-items-center text-center text-dark mb-1">
                                <div class="col-4 align-self-center">
                                    <p class="small">{{$h['name']}}</p>
                                </div>
                                <div class="col-4 align-self-center border-left">
                                    <p class="small">{{number_format($h['time'],0,',',' ')}} soat</p>
                                </div>
                                <div class="col-4 align-self-center border-left">
                                    <p class="small">{{number_format($h['price'],0,',',' ')}}</p>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

        {{-- @php
            dd($date, $hisobot, $medicine, $allprice);
        @endphp --}}
    @if(count($medicine) > 0 && count($allprice)) 
        <div>
            <h4 class="text-center">Sotuv hisobot</h4>
            <div class="col-12 text-center">
                @if(isset($allprice[0]->allprice))
                <button type="button" class="mb-2 btn btn-sm btn-info">
                    Barchasi: {{number_format($allprice[0]->allprice,0,',',' ')}}
                </button>
                @else 
                <button type="button" class="mb-2 btn btn-sm btn-info">
                    Barchasi: {{number_format($allprice[0]['allprice'],0,',',' ')}}
                </button>
                @endif
            </div>
        </div>
        @endif
        <div class="container" @if(count($medicine) > 0) style="border:1px solid #07132ea3;border-radius:15px;" @endif>
            @foreach ($medicine as $h)

            <div class="form-group float-label position-relative active mb-0">
                <div class="bottom-right mb-1">
                    @if(isset($h->number))
                        <button type="button" class="btn btn-sm btn-secondary" style="font-size:13px;background: #0c53a9;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            {{$h->number}} dona
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-secondary" style="font-size:13px;background: #0c53a9;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            {{$h['number']}} dona
                        </button>
                    @endif
                    @if(isset($h->allprice))
                        <button type="button" class="btn btn-sm btn-secondary" style="font-size:13px;background: #0c53a9;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            {{number_format($h->allprice,0,',',' ')}}
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-secondary" style="font-size:13px;background: #0c53a9;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            {{number_format($h['allprice'],0,',',' ')}}
                        </button>
                    @endif
                    {{-- <button class="btn btn-sm btn-success rounded">{{number_format($h->allprice,0,',',' ')}}</button> --}}
                </div>
                @if(isset($h->name))
                <input type="text" class="form-control" style="font-size:14px;color:#272730;" value="{{$h->name}}" disabled>
                @else
                <input type="text" class="form-control" style="font-size:14px;color:#272730;" value="{{$h['name']}}" disabled>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
{{-- <p class="small text-secondary">{{$h['name']}}</p>
</div>
<div class="col-4 align-self-center border-left">
    <p class="small text-secondary">{{number_format($h['time'],0,',',' ')}} soat</p>
</div>
<div class="col-4 align-self-center border-left">
    <p class="small text-secondary">{{number_format($h['price'],0,',',' ')}}</p> --}}
