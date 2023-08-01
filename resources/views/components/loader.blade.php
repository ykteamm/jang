<style>
    .main-loader {
        position: relative;
    }

    .main-loader-image {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        overflow: hidden;
    }

    .main-loader-bar {
        position: absolute;
        bottom: 20px;
        z-index: 100;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .novatio-brand-image {
        position: absolute;
        top: 40px;
        z-index: 100;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .load-kb {
        position: absolute;
        top: -35px;
        z-index: 101;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .percentage-bar {
        position: absolute;
        bottom: 55px;
        z-index: 100000;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .percentage {
        color: #fff;
        width: 100%;
        height: 100%;
    }

    .percentage_inner {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        text-align: center;
        font-size: 30px;
        font-family: system-ui;
        font-weight: 800;
        color: #000;
    }

    .progress-loader-bar {
        height: 40px;
        border-radius:50px;
        overflow: hidden;
        width: 100%;
    }

    .progress-loader-bar span {
        display: block;
    }

    .bar {
        background: rgba(0, 0, 0, 0.075);
    }

    .progress-loader {
        transition: 0.3s ease infinite;
        background: #e2e924;;
        color: #fff;
        padding: 20px;
    }

    .progress-loader-bar {
        width: 85%;
        background: #d7dddb63;
    }
</style>

<div class="container-fluid h-100 loader-display">
    <div class="row h-100 main-loader">
        <div class="main-loader-image">
            <img style="width:100%" src="https://jang.novatio.uz/product/loader.webp" alt="IMg">
            {{-- <img style="width:100%" src="http://127.0.0.1:8000/product/loader.jpg" alt="IMg"> --}}
            {{-- <div class="novatio-brand-image">
                <img style="width:60%" src="{{ asset('mobile/load-brand.webp') }}" alt="IMg">
                <div class="load-kb">
                    <img style="width:25%" src="{{ asset('mobile/load-king.png') }}" alt="IMg">
                </div>
            </div> --}}
            <div class="percentage-bar">
                <div class="percentage mb-2">
                    <div class="percentage_inner supercell">0%</div>
                </div>
            </div>
            <div class="main-loader-bar">
                <div class="progress-loader-bar">
                    <span class="bar">
                        <span class="progress-loader"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
