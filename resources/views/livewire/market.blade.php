<div style="width: 390px;position:relative">
    @if($resime == 2)
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="position:absolute;top:8px;right:10px;opacity:5">
            <img src="{{ asset('mobile/xclose.png') }}" width="30px">
        </button>
        <div style="position:absolute;top:126px;left:79px;width:89px;height:29px;border-radius:10px"
            class="d-flex align-items-center justify-content-center">
            <span id="userCrystall" style="font-weight: 600;color:#fff;font-size:16px" class="supercell">
                {{-- {{ number_format(1250, 0, ',', ' ') }} --}}
                {{-- Get info from api --}}
            </span>
        </div>
        <button
            style="position: absolute;top:131px;right:15px;z-index:10;border:none;outline:none;background:transparent;color:#fff"
            type="button" class="rounded d-flex align-items-center justify-content-center"
            data-toggle="popover" title="Tashqi market" data-content="3 oylik jangda g'olib viloyat sovg'alari"
            data-placement="left">
            <img width="20" class="instruksiya" src="{{ asset('mobile/instruksiya.png') }}"
                alt="Instruksiya">
        </button>
        <img src="{{ asset('mobile/market/market.png') }}" width="100%" alt="Image Market">
        <div style="position: absolute;top:175px;left:0;right:0;bottom:15px;width:100%;overflow:scroll;">
            
            <livewire:market-story>

            <div id="wishListItemsTitle" class="supercell text-center">
                Sevimlilar
            </div>
            <div id="wishListItems">

            </div>
            <div id="outerMarker">
                @foreach ($outerMarket as $item)
                    <div id="outerMarket{{ $item->id }}"
                        class="d-flex justify-content-center align-items-center">
                        <div style="position:relative;width:95%;padding-right:7px;padding-left:1px">
                            <img class="mb-1" width="100%" src="{{ asset('mobile/market/card.png') }}"
                                alt="Image">
                            <div style="position:absolute;top:0;left:0;right:0;bottom:0;">
                                <div onclick="saveWishList({{ $item }})"
                                    style="position: absolute;right:20px;top:90px;width:30px;height:30px;overflow:hidden;text-align:center;border-radius:5px;cursor:pointer;opacity:0.4"
                                    class="d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="#fff" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </div>
                                <div
                                    style="position: absolute;left:21px;top:35px;width:110px;height:110px;overflow:hidden;border-radius:10px">
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="width:100%;height:100%">
                                        <img width="100%" src="{{ asset('outermarket/' . $item->image) }}"
                                            alt="MarketItemImage">
                                    </div>
                                </div>
                                <div
                                    style="position: absolute;right:28px;top:38px;width:204px;height:28px;overflow:hidden;text-align:center;border-radius:5px">
                                    <span style="font-weight: 600;color:#fff;font-size:13px"
                                        class="supercell">{{ $item->name }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-center"
                                    style="position: absolute;right:69px;top:81px;width:78px;height:45px;overflow:hidden;text-align:center;border-radius:5px">
                                    <span style="font-weight: 600;color:#fff;font-size:16px" class="supercell">
                                        {{ number_format($item->crystall, 0, ',', ' ') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>