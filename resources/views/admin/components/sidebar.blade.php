<div class="main-menu">
    <div class="row mb-4 no-gutters">
        <div class="col-auto"><button class="btn btn-link btn-40 btn-close text-white"><span class="material-icons">chevron_left</span></button></div>
        <div class="col-auto">
            <div class="avatar avatar-40 rounded-circle position-relative">
                <figure class="background">
                    <img src="img/user1.png" alt="">
                </figure>
            </div>
        </div>
        <div class="col pl-3 text-left align-self-center">
            <h6 class="mb-1">Errica Johnson</h6>
            <p class="small text-default-secondary">London, UK</p>
        </div>
    </div>
    <div class="menu-container">
        <div class="row mb-4">
            <div class="col">
                <h4 class="mb-1 font-weight-normal">$ 1548.00</h4>
                <p class="text-default-secondary">My Balance</p>
            </div>
            <div class="col-auto">
                <button class="btn btn-default btn-40 rounded-circle" data-toggle="modal" data-target="#addmoney"><i class="material-icons">add</i></button>
            </div>
        </div>

        <ul class="nav nav-pills flex-column ">
            <li class="nav-item">
                <a class="nav-link active" href="index.html">
                    <div>
                        <span class="material-icons icon">account_balance</span>
                        Home
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('product.index')}}">
                    <div>
                        <span class="material-icons icon">insert_chart</span>
                        Elexirga product qoshish
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('loader.index')}}">
                    <div>
                        <span class="material-icons icon">insert_chart</span>
                        Loader image
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('shop-product.index')}}">
                    <div>
                        <span class="material-icons icon">insert_chart</span>
                        Market Mahsulotlari
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin-order.index')}}">
                    <div>
                        <span class="material-icons icon">insert_chart</span>
                        Buyurtma
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gift_cards.html">
                    <div>
                        <span class="material-icons icon">card_giftcard</span>
                        Gift Cards
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="my_orders.html">
                    <div>
                        <span class="material-icons icon">shopping_bag</span>
                        My Orders
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="setting.html">
                    <div>
                        <span class="material-icons icon">settings</span>
                        Settings
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages.html">
                    <div>
                        <span class="material-icons icon">layers</span>
                        Pages
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="controls.html">
                    <div>
                        <span class="material-icons icon">widgets</span>
                        Controls
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.users')}}">
                    <div>
                        <span class="material-icons icon">insert_chart</span>
                        Userlar
                    </div>
                </a>
            </li>
        </ul>
        <div class="text-center">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger text-white rounded my-3 mx-auto">Chiqish</button>
            </form>
        </div>
    </div>
</div>
