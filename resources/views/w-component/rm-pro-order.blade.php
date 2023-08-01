<div class="swiper-slide overflow-hidden text-center">

    <div class="container mt-2 mb-2">
        <div class="row">

        <form action="{{route('zakazPro.store')}}" method="POST" id="soldFormPro" style="display:contents;">
            @csrf
            <div class="container">
                <div class="mt-4 overflow-auto " style="height: 700px;">
                    @foreach (getOrderUser() as $user)
                        <div class="media mb-1 p-2 w-100 product-border" style="background: #bdf0ff;color:black;"
                        data-toggle="modal" data-target="#userorder{{$user['id']}}"
                        >
                            <div class="col-md-6">
                                {{-- <a href="#"> --}}
                                    <p class="mb-1">{{$user['last_name']}} {{$user['first_name']}}</p>
                                {{-- </a> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>

    </div>

</div>

