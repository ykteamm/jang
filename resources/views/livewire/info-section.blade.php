<div class="swiper-slide overflow-hidden">
    @if ($resime == 2)
        
        @if (count($infos) > 0)
            <div>
                <div class="text-center supercell text-white">
                    Ma'lumotnomalar
                </div>
                <div class="mt-3">
                    <div class="text-start supercell text-white py-2">Preparatlar</div>

                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                        
                            @foreach ($infos as $key => $infs)
                            {{-- <li class="nav-item" style="margin-right:15px;width:240px;" onclick="showInfo({{ $infs->id }})"
                                data-toggle="modal" data-target="#showInfoItem"> --}}
                                
                            {{-- </li> --}}

                        <div class="carousel-item @if($key == 0) active @endif" onclick="showInfo({{ $infs->id }})" data-toggle="modal" data-target="#showInfoItem">
                            <div class="card" style="height:330px;border-radius:5px !important">
                                <div class="card-header p-0"
                                    style="height:250px;overflow:hidden;border-radius:5px !important">
                                    <img width="100%" height="height:200px" src="{{ $infs->img }}" alt="Image">
                                </div>
                                <div class="card-body" style="border-radius:5px !important;padding:8px !important">
                                    <div
                                        style="height:40px;color:#140342;line-height:1.5;font-size:16px;margin-top:10px;font-weight:500;overflow:hidden">
                                        {{ $infs->title }}
                                    </div>
                                    <div style="font-weight:500;font-size:10px;color:#78787c;text-align:start">
                                        {{ getMonthName(date('F', strtotime($infs->created_at))) . ' ' }}
                                        {{ date('d', strtotime($infs->created_at)) }},
                                        {{ date('Y', strtotime($infs->created_at)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach


                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
            </div>
        @endif
        @if (count($videos) > 0)
            <div class="mt-3">
                <div class="text-start supercell text-white py-2">
                    Videolar
                </div>
                <ul class="nav nav-pills infoscrollbar" style="flex-wrap: nowrap; overflow:scroll">
                    @foreach ($videos as $vidd)
                        <li class="nav-item" style="margin-right:15px;width:240px;">
                            <div class="card" style="height:270px;width:240px;border-radius:5px !important">
                                <div class="card-header p-0" style="overflow:hidden;border-radius:5px !important">
                                    @if (!$vidd->img)
                                        <iframe style="width: 240px;height:170px" frameborder="0" allowfullscreen="1"
                                            src="https://www.youtube-nocookie.com/embed/{{ substr($vidd->url, 32) }}?wmode=opaque&amp;start=0"
                                            data-youtube-id="{{ substr($vidd->url, 32) }}"></iframe>
                                    @else
                                        <img src="{{ $vidd->img }}" alt="">
                                    @endif
                                </div>
                                <div class="card-body" style="border-radius:5px !important;padding:8px !important">
                                    <div
                                        style="height:40px;color:#140342;line-height:1.5;font-size:16px;margin-top:10px;font-weight:500;overflow:hidden">
                                        {{ $vidd->title }}
                                    </div>
                                    <div>
                                        <button style="font-size:11px" onclick="showVid({{ $vidd->id }})"
                                            data-toggle="modal" data-target="#showVideoItem"
                                            class="btn btn-primary btn-sm">Ko'rish</button>
                                    </div>
                                    <div
                                        style="font-weight:500;font-size:10px;color:#78787c;text-align:start;padding-top:4px">
                                        {{ getMonthName(date('F', strtotime($vidd->created_at))) . ' ' }}
                                        {{ date('d', strtotime($vidd->created_at)) }},
                                        {{ date('Y', strtotime($vidd->created_at)) }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (count($battleVideos) > 0)
            <div class="mt-3">
                <div class="text-start supercell text-white py-2">
                    Novatio jang videolari
                </div>
                <ul class="nav nav-pills infoscrollbar" style="flex-wrap: nowrap; overflow:scroll">
                    @foreach ($battleVideos as $batVid)
                        <li class="nav-item" style="margin-right:15px;width:240px;">
                            <div class="card" style="height:270px;width:240px;border-radius:5px !important">
                                <div class="card-header p-0" style="overflow:hidden;border-radius:5px !important">
                                    @if (!$batVid->img)
                                        <iframe style="width: 240px;height:170px" frameborder="0" allowfullscreen="1"
                                            src="https://www.youtube-nocookie.com/embed/{{ substr($batVid->url, 32) }}?wmode=opaque&amp;start=0"
                                            data-youtube-id="{{ substr($batVid->url, 32) }}"></iframe>
                                    @else
                                        <img src="{{ $batVid->img }}" alt="">
                                    @endif
                                </div>
                                <div class="card-body" style="border-radius:5px !important;padding:8px !important">
                                    <div
                                        style="height:40px;color:#140342;line-height:1.5;font-size:16px;margin-top:10px;font-weight:500;overflow:hidden">
                                        {{ $batVid->title }}
                                    </div>
                                    <div>
                                        <button style="font-size:11px" onclick="showVid({{ $batVid->id }})"
                                            data-toggle="modal" data-target="#showVideoItem"
                                            class="btn btn-primary btn-sm">Ko'rish</button>
                                    </div>
                                    <div
                                        style="font-weight:500;font-size:10px;color:#78787c;text-align:start;padding-top:4px">
                                        {{ getMonthName(date('F', strtotime($batVid->created_at))) . ' ' }}
                                        {{ date('d', strtotime($batVid->created_at)) }},
                                        {{ date('Y', strtotime($batVid->created_at)) }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <style>
            .infoscrollbar::-webkit-scrollbar {
                display: none
            }
        </style>

    @endif

</div>
