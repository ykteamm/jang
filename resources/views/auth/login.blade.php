@extends('layouts.login')
@section('login')
<div class="main-landing @if(Session::has('user')) d-none @endif">
    <main class="flex-shrink-0 main has-footer pt-2">

        <div class="container h-100">
            <div class="swiper-container introduction text-white">
                <div class="swiper-wrapper">
                    <div class="swiper-slide overflow-hidden text-center">
                        <div class="row no-gutters h-100">
                            <div class="col align-self-center px-3">
                                <img src="{{asset('mobile/wdwd.png')}}" alt="" class="mw-100 my-5">
                                <div class="row">
                                    <div class="container mb-5">
                                        {{-- <h4>Amazing Finance template</h4> --}}
                                        {{-- <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide overflow-hidden text-center">
                        <div class="row no-gutters h-100">
                            <div class="col align-self-center px-3">
                                <img src="{{asset('mobile/img/about.png')}}" alt="" class="mw-100 my-5">
                                <div class="row">
                                    <div class="container mb-5">
                                        <h4>Best Wallet app</h4>
                                        <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide overflow-hidden text-center">
                        <div class="row no-gutters h-100">
                            <div class="col align-self-center px-3">
                                <img src="{{asset('mobile/img/install-app.png')}}" alt="" class="mw-100 my-5">
                                <div class="row">
                                    <div class="container mb-5">
                                        <h4>World Class Design</h4>
                                        <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </main>

    <!-- footer-->
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="button" onclick="login()" class="btn btn-warning rounded btn-block">Profilga kirish</button>
            </div>
            <div class="col">
                <a href="{{route('provizor')}}"  class="btn btn-outline-warning rounded btn-block">Provizor</a>
            </div>
            {{-- <div class="col">
                <a href="{{route('register')}}" class="btn btn-outline-warning rounded btn-block">Registratsiya</a>
            </div> --}}
        </div>
    </div>
</div>
<div class="main-login @if(!Session::has('user')) d-none @endif">
    {{-- <div class="main-login"> --}}
    <form action="{{route('login')}}" method="POST" id="loginForm">
        @csrf
        <div class="container py-5">
            <div style="margin-top:50%">
              <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                  <div class="card-body p-3 text-center">

                    <h3 class="mb-5">Kirish</h3>

                    <div class="form-outline mb-4">
                      <input name="username" type="text" id="typeEmailX-2" class="form-control rounded rounded-1 form-control" placeholder="Nickname" />
                    </div>
                    <div class="form-outline mb-4">
                      <input name="password" type="password" id="typePasswordX-2" class="form-control rounded rounded-1 form-control" placeholder="Parol" />
                    </div>
                    <div class="form-check d-flex justify-content-start mb-4">
                      <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                      <label class="form-check-label" for="form1Example3"> Parolni eslab qolish</label>
                    </div>
                    <button class="btn btn-primary btn-block" onclick="loginEnter()">Kirish</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
    {{-- <main class="flex-shrink-0 main has-footer">
        <div class="container h-100 text-white" style="margin-top:50%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Novatio Jang</h2>
                            <div class="form-group float-label position-relative">
                                <input type="text" class="form-control text-white" name="username" onfocus="this.removeAttribute('readonly');" readonly>
                                <label class="form-control-label text-white">Login</label>
                            </div>
                            <div class="form-group float-label position-relative">
                                <input type="password" class="form-control text-white" onfocus="this.removeAttribute('readonly');" readonly name="password">
                                <label class="form-control-label text-white">Parol</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main> --}}

    <!-- footer-->
    {{-- <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="button" onclick="loginEnter()" class="btn btn-default rounded btn-block">Profilga kirish</button>
            </div>
        </div>
    </div> --}}
    </form>

</div>
@endsection
@section('login-scripts')
<script src="{{asset('promo/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
        function loginEnter()
        {
            $("#loginForm").submit();
        }
        $(function () {
            $('[data-mask]').inputmask()
        });
        function login()
        {
            $('.main-landing').addClass('d-none');
            $('.main-login').removeClass('d-none');
        }
        function landing()
        {
            $('.main-landing').removeClass('d-none');
            $('.main-login').addClass('d-none');
        }
    </script>
@endsection
