<div class="modal fade" id="news" tabindex="-1" role="dialog" aria-labelledby="allNews" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable h-100" role="document">
        <div class="modal-content">
            <div class="modal-header p-0" style="position:relative;height:55px;background:#384b5e">
                <button type="button" class="close" data-dismiss="modal" aria-label="allNews"
                    style="opacity: 5;position:absolute;top:8px;right:10px;z-index:20">
                    <img src="{{ asset('mobile/news/close.png') }}" width="30px">
                </button>
                <div class="supercell d-flex align-items-center justify-content-center"
                    style="position:absolute;top:0px;left:0;right:0;font-size:22px">
                    <div class="pl-4 text-white pt-2"
                        style="text-shadow: -1px 4px 0 #000, 3px 1px 0 #000, 3px -1px 0 #000, -1px -1px 0 #000">
                        Jang news</div>
                </div>
                {{-- <div style="position: absolute; bottom:3px;left:0;right:0">
                    <ul class="mx-1 navbar-nav flex-row align-items-center justify-content-between">
                        <li class="nav-item news-menu-item active">
                            <a class="nav-link p-0 text-white supercell" >News</a>
                        </li>
                        <li class="nav-item news-menu-item">
                            <a class="nav-link p-0 text-white supercell">Tours</a>
                        </li>
                        <li class="nav-item news-menu-item">
                            <a class="nav-link p-0 text-white supercell">Info</a>
                        </li>
                    </ul>
                </div>
                <div style="position:absolute;height:1px;top:86px;background:#74d5ff;width:100%"></div> --}}
            </div>
            <div class="modal-body p-0" style="position: relative; margin-top:-2px">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" style="">
                        @foreach ($news as $key => $item)
                            @if ($key < 3)
                                <div class="carousel-item @if ($key == 1) active @endif">
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="width:100%;overflow:hidden">
                                        <img class="w-100" src="{{ asset($item->img) }}" alt="First slide">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                        data-slide="prev" style="margin-left: -21px !important;">
                        <span aria-hidden="true">
                            <i class="material-icons" style="color:#000000;font-size:33px;">navigate_before</i>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                        data-slide="next" style="margin-right: -21px !important;">
                        <span aria-hidden="true">
                            <i class="material-icons" style="color:#000000;font-size:33px;">navigate_next</i>
                        </span>
                        <span class="sr-only">Next</span>
                    </a> --}}
                </div>
                <div style="position: relative;margin-top:-5px">
                    <img width="100%" src="{{ asset('mobile/news/nwh.png') }}" alt="Img"
                        style="margin-bottom:-1px">
                    <div style="padding: 10px;background:#998a9d;width:100%;margin-top:-10px">
                        <div id="allnews">
                            {{-- This element dynamic. Body will add by home.blade.php --}}
                            {{-- <div class="d-flex align-items-center justify-content-center">
                                <span class="pr-1"
                                    style="color:#78787c;font-size:12px; font-weight:600">${nw.like}</span>
                                <span class="d-flex align-items-center justify-content-center"
                                    style="width:13px;height:13px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="#78787c" class="bi bi-heart-fill"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </span>
                            </div> --}}
                        </div>
                    </div>
                    <img width="100%" src="{{ asset('mobile/news/nwf.png') }}" alt="Img"
                        style="margin-top:-15px">
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .news-menu-item {
        width: 32.2%;
        padding: 8px 25px;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        box-sizing: border-box;
        background: #677e97;
        border-top: 1.5px solid #7fa0b8;
        border-left: 1.5px solid #7fa0b8;
        border-right: 1.5px solid #7fa0b8;
    }

    .news-menu-item.active {
        background: #aadff9;
        border-top: 1px solid #74d5ff;
        border-left: 1px solid #74d5ff;
        border-right: 1px solid #74d5ff;
    }

    .news-menu-item a {
        font-size: 13px;
        text-align: center;
        text-shadow: -1px 1px 0 #000,
            1px 1px 0 #000,
            1px -1px 0 #000,
            -1px -1px 0 #000;
    }

    .news-card-left {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .news-card {
        overflow: hidden;
        margin-bottom: 30px;
        border-radius: 12px;
        box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        font-size: 18px;
        /* background: #f7eaea; */
        background: #fff;
        color: #333
    }
</style>
