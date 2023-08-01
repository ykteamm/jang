@extends('layouts.login')
@section('login')
<div class="main-landing">

    <!-- footer-->
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="button" onclick="login()" class="btn btn-warning rounded btn-block">Profilga kirish</button>
            </div>
            <div class="col">
                <a href="{{route('provizor')}}"  class="btn btn-outline-warning rounded btn-block">Provizor</a>
            </div>
            <div class="col">
                <a href="{{route('register')}}" class="btn btn-outline-warning rounded btn-block">Registratsiya</a>
            </div>
        </div>
    </div>
</div>
<div class="main-login">
    <form action="{{route('provizor.store')}}" method="POST" id="loginForm">
        @csrf
        <div class="container py-5">
            <div style="margin-top:50%">
              <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                  <div class="card-body p-3 text-center">
                    <h3 class="mb-5">Kirish</h3>
                    <div class="form-outline mb-4">
                        <label for="">Parol</label>
                      <input name="password" type="password" id="typePasswordX-2" class="form-control rounded rounded-1 form-control" placeholder="Parol" />
                    </div>
                    <button class="submit btn btn-primary btn-block">Kirish</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
