<div class="modal-content">
    <div class="modal-header">
        <img src="{{ asset('mobile/vil.webp') }}" width="111%"
            style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="opacity: 5;position:absolute;top:8px;right:10px;">
            <img src="{{ asset('mobile/xclose.png') }}" width="30px">
        </button>
    </div>
    <div class="modal-body p-0">
        <div class="container p-0">
            <div class="mb-3 pt-3">
                @foreach (allRegion() as $key => $item)
                    <div class="col-12 col-md-6 supercell" data-toggle="modal" data-target="#region-profil"
                        onclick="showRegion({{ $item->id }})">
                        <div class="card border-0 mb-1">
                            <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;">
                                <div class="row align-items-center">
                                    <div class="col-2">
                                        <button type="button" class="btn btn-sm btn-secondary supercell"
                                            style="background: #e0aa2c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                            {{ $key + 1 }}
                                        </button>
                                    </div>
                                    <div class="col-8 pr-0">
                                        <span class="mb-1"
                                            style="color: #272730;font-size:12px">{{ $item->name }}</span>
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
