<div class="modal fade" id="turnir" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
            
<div class="modal-content">
    <style>
        .news-menu-item {
            width: 32.2%;
            padding: 9px 25px;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
            box-sizing: border-box;
            background: #677e97;
            border-top: 1px solid #7fa0b8;
            border-left: 1px solid #7fa0b8;
            border-right: 1px solid #7fa0b8;
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
    </style>
    <div class="modal-header p-0" style="position:relative;height:90px;background:#384b5e">
        <button type="button" class="close" data-dismiss="modal" aria-label="allNews"
            style="opacity: 5;position:absolute;top:8px;right:10px;z-index:20">
            <img src="{{ asset('mobile/news/close.png') }}" width="30px">
        </button>
        <div class="supercell d-flex align-items-center justify-content-center"
            style="position:absolute;top:0px;left:0;right:0;font-size:22px">
            <div class="pl-4 text-white pt-2"
                style="text-shadow: -1px 4px 0 #000, 3px 1px 0 #000, 3px -1px 0 #000, -1px -1px 0 #000">
                Turnir</div>
        </div>
        <div style="position: absolute; bottom:3px;left:0;right:0">
            <ul class="mx-1 navbar-nav flex-row align-items-center justify-content-around">
                <li onclick="changeTab1()" id="turnirTab1" class="nav-item news-menu-item active">
                    <a class="nav-link p-0 text-white supercell" href="#">Jadval</a>
                </li>
                <li onclick="changeTab2()" id="turnirTab2" class="nav-item news-menu-item">
                    <a class="nav-link p-0 text-white supercell" href="#">Janglar</a>
                </li>
            </ul>
        </div>
        <script>
            function changeTab1() {
                let tab1 = document.querySelector(`#turnirTab1`)
                let tab2 = document.querySelector(`#turnirTab2`)
                let tabmain1 = document.querySelector(`#turnir1tab`)
                let tabmain2 = document.querySelector(`#turnir2tab`)
                tab2.classList.remove('active')
                tab1.classList.add('active')
                tabmain1.classList.remove('d-none')
                tabmain2.classList.add('d-none')
            }

            function changeTab2() {
                let tab1 = document.querySelector(`#turnirTab1`)
                let tab2 = document.querySelector(`#turnirTab2`)
                let tabmain1 = document.querySelector(`#turnir1tab`)
                let tabmain2 = document.querySelector(`#turnir2tab`)
                tab2.classList.add('active')
                tab1.classList.remove('active')
                tabmain1.classList.add('d-none')
                tabmain2.classList.remove('d-none')
            }
        </script>
        <div style="position:absolute;height:1px;top:86px;background:#74d5ff;width:100%"></div>
    </div>
    <div id="turnir2tab" class="modal-body p-0 d-none">
        
    </div>
    <div id="turnir1tab" class="modal-body p-0">
        <div class="col-12">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/tr1.webp') }}">
        </div>
        <div class="col-12">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/slavi1.webp') }}">
        </div>
        <div class="col-12 mb-3">
            <img width="100%" style="margin-top:5px" src="{{ asset('mobile/turnir/slavi2.webp') }}">
        </div>
        <div>
    </div>
    </div>
</div>

    </div>
</div>