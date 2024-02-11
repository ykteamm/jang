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

    {{-- @include('modals.news') --}}
    @include('modals.recommendNews')
    @include('modals.showNw')
    @include('modals.exercise')

    @include('modals.turnir')

    @include('modals.topshiriq')

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


@endsection
