<div class="swiper-slide overflow-hidden text-center">
    <div class="container-fluid text-center mb-1">
        <div class="avatar avatar-140 rounded-circle mx-auto shadow">
            <div class="background" style="background-image: url(&quot;img/user1.png&quot;);">
                <img src="{{ Auth::user()->image_url }}" style="display: none;">
            </div>
        </div>
    </div>
    <button class="my-4 btn btn-sm btn-primary" data-toggle="collapse" style="width:100px" data-target="#userProfileMain"
        aria-expanded="false" aria-controls="userProfileMain" style="font-size:16px;font-weight:600">
        Tahrirlash
    </button>
    <div id="userProfileMain" class="collapse" aria-labelledby="userProfileMain">
        <button type="button" class="mb-2 btn btn-sm btn-primary" data-toggle="modal"
            data-target="#change-image">Rasmni
            ozgartirish <span class="material-icons">edit</span>
        </button>

        <div class="container mt-2 mb-2">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary"
                        style="background: #0a12280f;border-radius: 15px;">
                        <div style="background: #6dc6da5c;border-radius: 15px;">
                            Familya
                        </div>
                        <span>{{ Auth::user()->last_name }}</span>
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary"
                        style="background: #0a12280f;border-radius: 15px;">
                        <div style="background: #6dc6da5c;border-radius: 15px;">
                            Ism
                        </div>
                        <span>{{ Auth::user()->first_name }}</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="container mt-2 mb-2">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary"
                        style="background: #0a12280f;border-radius: 15px;">
                        <div style="background: #6dc6da5c;border-radius: 15px;">
                            Nickname
                        </div>
                        <span>{{ Auth::user()->nickname }}</span>
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="mb-2 btn btn-block btn-sm btn-primary"
                        style="background: #0a12280f;border-radius: 15px;">
                        <div style="background: #6dc6da5c;border-radius: 15px;">
                            Telefon
                        </div>
                        <span>{{ Auth::user()->phone_number }}</span>
                    </button>
                </div>
            </div>
        </div>
        <button type="button" class="mb-2 btn btn-sm btn-primary" data-toggle="modal"
            data-target="#change-profil">Ma'lumotlarni o'zgartirish <span class="material-icons">edit</span>
        </button>
    </div>
    <livewire:profile />
</div>
