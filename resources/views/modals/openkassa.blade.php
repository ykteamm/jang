<div class="modal fade" id="openkassa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick="openKassa()" type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="container">
                            <div class="container mb-4">
                                <div class="row h6 font-weight-bold">
                                    <div class="col">Zakaz summasi</div>
                                    <div class="col text-right text-mute summa-zakaz">0</div>
                                </div>
                            </div>
                            <form action="{{route('sold.store')}}" method="POST" id="soldForm">
                             @csrf
                            <div class="container mb-4">
                                <button type="button" class="btn btn-default btn-block rounded" id="submitSold">Zakazni yopish</button>
                                <button type="button" class="btn btn-default btn-block rounded d-none" id="close-zakaz">Zakaz qabul qilindi</button>

                                    {{-- <div class="form-group float-label position-relative pt-2 mb-0">
                                        <input type="text" class="form-control text-primary" name="full_name">
                                        <label class="form-control-label text-primary">Mijoz ismi sharifi</label>
                                    </div>
                                    <div class="form-group float-label position-relative pt-2 mb-0">
                                        <input type="text" class="form-control text-primary" data-inputmask='"mask": "(99) 999-99-99"' data-mask name="phone_number" onfocus="this.removeAttribute('readonly');" readonly>
                                        <label class="form-control-label text-primary">Mijoz raqami</label>
                                    </div> --}}

                            </div>
                            <div class="mt-4 overflow-auto " style="height: 700px;">
                                @if (count($products) > 0)
                                    
                                    @foreach ($products[0]->pharmacy->shablon_pharmacy[0]->shablon->price as $item)
                                        <div class="media mb-1 p-2 w-100 product-border product-border{{$item->medicine->id}}">
                                            <div class="media-body">
                                                <a href="#">
                                                    <p class="mb-1">{{$item->medicine->name}}</p>
                                                </a>
                                                <p><span class="text-success product-price{{$item->medicine->id}}">{{$item->price}}</span> <span class="text-secondary small">so'm</span></p>
                                            </div>
                                            <div class="align-self-center">
                                                <div class="input-group cart-count">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="minus({{$item->medicine->id}})">-</button>
                                                    </div>
                                                    <input type="text" class="form-control kassa-input product{{$item->medicine->id}}" value="0" name="{{$item->medicine->id}}-{{$item->price}}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="plus({{$item->medicine->id}})">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>