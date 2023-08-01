<div class="pl-4 pr-4">
    <ul class="nav nav-pills infoscrollbar mb-1" style="flex-wrap: nowrap; overflow:scroll">
        @if (isset($categories))
            
        @foreach ($categories as $cat)
            <li class="nav-item" style="margin-right:15px;width:240px;" wire:click="$emit('change_Slider',{{$cat->id}})">
                <div class="card" style="height:100px;width:80px;border-radius:5px !important">
                    <div class="card-header p-0" style="overflow:hidden;border-radius:5px !important">
                        <img src="https://matrix.novatio.uz/market/category/{{$cat->image}}" width="80px" height="100px" alt="">
                    </div>
                </div>
            </li>
        @endforeach
        @endif

    </ul>
    @if (isset($sliders))

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($sliders as $key => $item)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class=" @if($key == 0) active @endif "></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($sliders as $key => $item)
                <div class="carousel-item @if($key == 0) active @endif">
                    <img class="d-block w-100" src="https://matrix.novatio.uz/market/slider/{{$item->image}}" alt="Second slide">
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>