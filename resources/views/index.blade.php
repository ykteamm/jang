@extends('layouts.app')
@section('content')

    <div class="container h-100 pl-0 pr-0">

        @if (Session::get('recommendNews'))
            <button class="d-none" data-toggle="modal" id="recommendNews-btn" data-target="#recommendNews"></button>
        @endif
        <div
            class="swiper-container introduction @if ($errors->any() || Session::has('smena')) active1 @else active2 @endif  text-white">
            <div class="swiper-wrapper">
                @include('w-component.profil')
                @include('w-component.smena')
                {{-- @include('w-component.mijoz') --}}
                @include('w-component.main')

                @if (Auth::user()->status == 1)
                    @include('w-component.money')
                @endif

                @include('w-component.team-battle')
                {{-- @if (count($videos) > 0 || count($infos) > 0)
                    @include('w-component.info-section')
                @endif --}}

            </div>
        </div>
    </div>


    @include('modals.change-image')
    @include('modals.change-profil')

    @include('modals.ustoz-shogird')
    @include('modals.ustoz-profil')

    @include('modals.battle')
    @include('modals.battle-day')

    @include('modals.smena')
    @include('modals.smenaclose')
    @include('modals.openkassa')
    @include('modals.opencheck')
    @include('modals.kassa')
    @include('modals.hisobot')
    @include('modals.all-sold')

    @if (count(getShogirdUser()) > 0)
        @include('modals.myshogird')
        @include('modals.myshogirdin')
        {{-- @include('modals.onemonthin') --}}
    @endif

    @if (count(getRekrut()) > 0)
        @include('modals.myrekrut')
    @endif

    @include('modals.news')
    @include('modals.recommendNews')
    @include('modals.showNw')
    @include('modals.exercise')

    @include('modals.turnir')

    @include('modals.topshiriq')
    @include('modals.lock')
    @include('modals.plan')
    @include('modals.plan_check')
    @include('modals.plan_edit')
    @include('modals.image')

    {{--    @include('modals.openkingcheck')--}}

    @include('modals.king-sold')
    @include('modals.yutuq-saroy')

    @include('modals.mega-turnir-dori')
    @include('modals.mega-turnir-battle')

    @include('modals.history-kubok')
    @include('modals.history-crystal')
    @include('modals.history-karma')
    {{-- @include('modals.history-elexir') --}}
    @include('modals.reyting')
    @include('modals.region')
    @include('modals.planuser')
    @include('modals.change_plan')
    @include('modals.region-profil')
    @include('modals.user-profil')
    {{-- @if (Auth::user()->status == 0)
        @include('modals.new-elchi')
    @endif --}}

    @include('modals.teambattle')
    @include('modals.teambattleround')


    @include('modals.bonus')
    @include('modals.money')

@endsection
@section('scripts')
    @include('partials.home-com')
    @include('partials.news-com')
    @include('partials.smena-com')
    @include('partials.money-com')
    {{-- @include('partials.swiper-com') --}}

    <script type="text/javascript">
        // Turnir 1
        // Karusel avtomatik ravishda o'tsin
        $('#carouselExampleControls1').carousel();

        // Prev tugmasi bosilganda
        $('.carousel-control-prev1').click(function() {
            $('#carouselExampleControls1').carousel('prev');
        });

        // Next tugmasi bosilganda
        $('.carousel-control-next1').click(function() {
            $('#carouselExampleControls1').carousel('next');
        });

        // Turnir 2
        // Karusel avtomatik ravishda o'tsin
        $('#carouselExampleControls2').carousel();

        // Prev tugmasi bosilganda
        $('.carousel-control-prev2').click(function() {
            $('#carouselExampleControls2').carousel('prev');
        });

        // Next tugmasi bosilganda
        $('.carousel-control-next2').click(function() {
            $('#carouselExampleControls2').carousel('next');
        });


        // Turnir 3
        // Karusel avtomatik ravishda o'tsin
        $('#carouselExampleControls3').carousel();

        // Prev tugmasi bosilganda
        $('.carousel-control-prev3').click(function() {
            $('#carouselExampleControls3').carousel('prev');
        });

        // Next tugmasi bosilganda
        $('.carousel-control-next3').click(function() {
            $('#carouselExampleControls3').carousel('next');
        });
    </script>
    <script type="text/javascript">

        var PlanJamoa = document.getElementById('month_plan_jamoa').value;

        var cleanedPlanJamoa = PlanJamoa.replace(/\s+/g, '');
        var add_plan = 0;
        @foreach (getShogirdUser() as $item)

        var planInput{{$item->id}} = document.getElementById('month_plan{{$item->id}}');

        planInput{{$item->id}}.addEventListener('input', function (event) {
            var value = event.target.value.replace(/[^\d]/g, ''); // faqat sonlar
            var formattedValue = '';
            var counter = 0;
            for (var i = value.length - 1; i >= 0; i--) {
                formattedValue = value[i] + formattedValue;
                counter++;
                if (counter % 3 == 0 && i !== 0) {
                    formattedValue = ' ' + formattedValue;
                }
            }
            //console.log(formattedValue)
            event.target.value = formattedValue;

            // Qiymatlarni qo'shib chiqish
            add_plan = 0;
            @foreach (getShogirdUser() as $user)

            var plan{{$user->id}} = parseInt(document.getElementById('month_plan{{$user->id}}').value.replace(/\s/g, ''));
            if (!isNaN(plan{{$user->id}})) {
                add_plan += plan{{$user->id}};
            }
            @endforeach

            var Hisob = cleanedPlanJamoa - add_plan;

            var formattedValue123 = Hisob.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
            if (formattedValue123 === '0') {
                var block = document.getElementById('save_plan')
                block.style.display = 'block';
            }
            if (formattedValue123 !== '0') {
                var none = document.getElementById('save_plan')
                none.style.display = 'none';
            }
            document.getElementById('month_plan_jamoa').value = formattedValue123;
            // console.log(cleanedPlanJamoa - add_plan);
        });
        @endforeach


        var PlanJamoaEdit = document.getElementById('month_plan_jamoa_edit').value;

        var cleanedPlanJamoaEdit = PlanJamoaEdit.replace(/\s+/g, '');
        var add_plan_edit = 0;
        @foreach (getShogirdUser() as $item)

        var planInputEdit{{$item->id}} = document.getElementById('month_plan_edit{{$item->id}}');

        planInputEdit{{$item->id}}.addEventListener('input', function (event) {
            var value = event.target.value.replace(/[^\d]/g, ''); // faqat sonlar
            var formattedValue = '';
            var counter = 0;
            for (var i = value.length - 1; i >= 0; i--) {
                formattedValue = value[i] + formattedValue;
                counter++;
                if (counter % 3 == 0 && i !== 0) {
                    formattedValue = ' ' + formattedValue;
                }
            }
            //console.log(formattedValue)
            event.target.value = formattedValue;

            // Qiymatlarni qo'shib chiqish
            add_plan_edit = 0;
            @foreach (getShogirdUser() as $user)

            var plan{{$user->id}} = parseInt(document.getElementById('month_plan_edit{{$user->id}}').value.replace(/\s/g, ''));
            if (!isNaN(plan{{$user->id}})) {
                add_plan_edit += plan{{$user->id}};
            }
            @endforeach

            var Hisob = cleanedPlanJamoaEdit - add_plan_edit;

            var formattedValue123 = Hisob.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
            if (formattedValue123 === '0') {
                var block = document.getElementById('save_plan_edit')
                block.style.display = 'block';
            }
            if (formattedValue123 !== '0') {
                var none = document.getElementById('save_plan_edit')
                none.style.display = 'none';
            }
            document.getElementById('month_plan_jamoa_edit').value = formattedValue123;
            // console.log(cleanedPlanJamoa - add_plan);
        });
        @endforeach

    </script>
@endsection
