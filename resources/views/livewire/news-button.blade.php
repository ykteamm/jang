<button style="position: relative" type="button" class="for-media-news-btn for-media-news-btn-g btn pl-0 class-news" data-toggle="modal"
    data-target="#news">
    @if ($notifcount > 0)
        <div id="newsNotifCountParent">
            <style>
                .notifications-count {
                    animation: tbtn 0.5s linear infinite;
                }
                #newsNotifCount {
                    animation: tbtn 0.5s linear infinite;
                }

                @media only screen and (max-width:360px) {
                    .notifications-count {
                        top: 18px !important;
                        right: 6px !important;
                    }
                }

                @keyframes tbtn {
                    0% {
                        transform: scale(1);
                        box-shadow: 1px 2px 10px rgb(red, green, blue);
                    }

                    50% {
                        transform: scale(1.3);
                        box-shadow: 1px 4px 20px rgb(red, green, blue);
                    }

                    100% {
                        transform: scale(1);
                        box-shadow: 1px 2px 10px rgb(red, green, blue);
                    }
                }
            </style>
            <div class="notifications-count"
                style="position: absolute;
                    top: 6px;
                    right: -16px;
                    background: red;
                    width: 25px;
                    height: 25px;
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;">
                <span id="newsNotifCount" style="font-size:11px" class="text-white supercell">
                    {{ $notifcount }}
                </span>
            </div>
        </div>
    @endif
    <img src="{{ asset('mobile/news/news.png') }}" class="for-media-news" width="160px" style="margin-right:-50px"
        alt="">
</button>
