<div class="swiper-slide overflow-hidden text-center">

    <div class="container mt-2 mb-2">
        <div class="row" style="background: aliceblue;
        padding-top: 10px;
        border-radius: 8px;">

        <form action="{{route('zakazPro.store')}}" method="POST" id="soldFormPro" style="display:contents;">
            @csrf
            <div class="col-12">
                <select class="custom-select custom-select-sm" name="provizor_id" required>
                    <option selected disabled hidden>Provizor talang</option>
                        @foreach (getRMPRO() as $item)
                            <option value="{{$item['id']}}">{{$item['last_name']}} {{$item['first_name']}}</option>
                        @endforeach
                  </select>
            </div>
            <div class="container">
                <div class="container mb-4 mt-4">
                    <div class="row h6 font-weight-bold" style="color:black;">
                        <div class="col">Zakaz summasi</div>
                        <div class="col text-right text-mute summa-zakazPro">0</div>
                    </div>
                </div>
                <div class="container mb-4">
                    <div class="row h6 font-weight-bold" style="color:black;">
                        <div class="col">Promo summasi</div>
                        <div class="col text-right text-mute summa-promoPro">0</div>
                    </div>

                    <div class="container" style="color:green;"><span id="promop">0</span>%</div>

                </div>


                <div class="container mb-4">
                    <button type="button" class="btn btn-default btn-block rounded" id="def-zakazPro">Promo 60% dan oshmadi</button>
                    <button type="button" class="btn btn-default btn-block rounded d-none propropro" id="submitSoldPro">Zakazni yopish</button>
                    <button type="button" class="btn btn-default btn-block rounded d-none" id="close-zakazPro">Zakaz qabul qilindi</button>

                </div>
                <div class="mt-4 overflow-auto " style="height: 700px;">
                        @php
                            $proId = [36,37,38,39,29,47,61,62,63,64,65];
                        @endphp
                        @foreach (getProProd() as $item)
                            @if(in_array($item['id'],$proId))
                            <div class="media mb-1 p-2 w-100 product-border product-borderPro{{$item['id']}}">
                                <div class="col-md-6">
                                    <a href="#">
                                        <p class="mb-1">{{$item['name']}}</p>
                                    </a>
                                    @php
                                        $pr = getProProdPrice($item['id']);
                                        if($pr == 10)
                                        {
                                            $pr = $item['price'][0]['price'];
                                        }
                                    @endphp
                                    <p><span class="text-success product-pricePro{{$item['id']}}">{{$pr}}</span> <span class="text-secondary small">so'm</span></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mt-3" style="height:55px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" style="background: #f27676;color:blue;" type="button" onclick="minusPromo({{$item['id']}})">-</button>
                                        </div>
                                        <input type="text" style="height: 55px;"
                                        class="form-control kassa-input productPro{{$item['id']}} allmp" narxi="{{$item['price'][0]['price']}}" proid="{{$item['id']}}"
                                        value="0" name="{{$item['id']}}-{{$item['price'][0]['price']}}" onkeyup="minusPlus()">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" style="background: #80e387;color:blue;" type="button" onclick="plusPromo({{$item['id']}})">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        @foreach (getProProd() as $item)
                            @if(!in_array($item['id'],$proId))
                            <div class="media mb-1 p-2 w-100 product-border product-borderPro{{$item['id']}}">
                                <div class="col-md-6">
                                    <a href="#">
                                        <p class="mb-1">{{$item['name']}}ee</p>
                                    </a>
                                    <p><span class="text-success product-pricePro{{$item['id']}}">{{$item['price'][0]['price']}}</span> <span class="text-secondary small">so'm</span></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mt-3" style="height:55px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" style="background: #f27676;color:blue;" type="button" onclick="minusPromo({{$item['id']}})">-</button>
                                        </div>
                                        <input type="text" style="height: 55px;"
                                        class="form-control kassa-input productPro{{$item['id']}} allmp" narxi="{{$item['price'][0]['price']}}" proid="{{$item['id']}}"
                                        value="0" name="{{$item['id']}}-{{$item['price'][0]['price']}}" onkeyup="minusPlus()">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" style="background: #80e387;color:blue;" type="button" onclick="plusPromo({{$item['id']}})">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                </div>
            </div>
        </div>
    </form>

    </div>

</div>
