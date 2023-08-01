@extends('layouts.app')
@section('content')

    <div class="container h-100 pl-0 pr-0">
        {{-- @if ($lock->isLocked)
        <div class="text-center text-white supercell">
            Siz blokirovkaga tushdingiz. RMingiz bilan bo'g'laning
        </div>
        @else
        @endif --}}
        {{-- @dd($user_king_liga) --}}
        {{-- @if (isset($user_king_liga->inc) && $user_king_liga->inc)
            <button class="d-none" data-toggle="modal" id="kingliga-btn" data-target="#kingliga"></button>
        @else --}}
        @if (Session::get('recommendNews'))
            <button class="d-none" data-toggle="modal" id="recommendNews-btn" data-target="#recommendNews"></button>
        @endif
            <div
                class="swiper-container introduction @if ($errors->any() || Session::has('smena')) active1 @else active2 @endif  text-white">
                <div class="swiper-wrapper">
                    {{-- @include('w-component.profil') --}}
                    @include('w-component.smena')
                    {{-- @include('w-component.mijoz') --}}
                    @include('w-component.main')
                    {{-- @include('w-component.money') --}}
                    {{-- @include('w-component.team-battle') --}}
                    {{-- @if (count($videos) > 0 || count($infos) > 0)
                        @include('w-component.info-section')
                    @endif --}}
                </div>
            </div>
        {{-- @endif --}}
    </div>

    

    @include('modals.news')
    @include('modals.recommendNews')
    @include('modals.showNw')
    @include('modals.exercise')
    @include('modals.turnir')
    @include('modals.history-kubok')
    @include('modals.history-elexir')
    @include('modals.reyting')
    @include('modals.region')
    @include('modals.planuser')
    @include('modals.change_plan')

     

    @include('modals.openkassa')
    @include('modals.opencheck')
    @include('modals.smena')
    @include('modals.kassa')
    @include('modals.smenaclose')
    @include('modals.hisobot')
    @include('modals.all-sold')


    


    {{-- @include('modals.kingliga') --}}

   

    
    {{-- @if (count($shifts) != 1)
        @include('modals.teachgradestar')
    @endif --}}
    

    

    {{-- @if (getSinovUser(Auth::id()) != 0)
        @include('modals.onemonth')
    @endif --}}
    {{-- @include('modals.teachtest') --}}
    {{-- @include('modals.lock') --}}
    {{-- @include('modals.info-modal') --}}
    {{-- @include('modals.video-modal') --}}
    {{-- @include('modals.image') --}}
    {{-- @include('modals.battle') --}}
    {{-- @include('modals.battle-day') --}}
    
   
    {{-- @include('modals.king-sold') --}}
  
    {{-- @include('modals.openkingcheck') --}}
    {{-- @include('modals.ksb') --}}
    {{-- @include('modals.myksbhistory') --}}
    {{-- @include('modals.first-enter') --}}
    {{-- @include('modals.today-check') --}}
    {{-- @include('modals.kscheck') --}}
    <button type="button" class="btn btn-info btn-block rounded m-2 d-none" data-toggle="modal" id="firstenter"
        data-target="#first-enter">
        Smena yopish
    </button>
    @include('modals.first-view')
    <button type="button" class="btn btn-info btn-block rounded m-2 d-none" data-toggle="modal" id="firstview"
        data-target="#first-view">
        Smena yopish
    </button>
    {{-- @include('modals.testtest') --}}
    {{-- @if (Session::has('kingCheck'))
        @php
            $solds = Session::get('kingCheck');
        @endphp
        @foreach ($solds as $key => $item)
            <div class="modal fade" id="openkingcheckr{{ $key * 3 }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                style="opacity: 5">
                                <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card mb-3">
                                <div class="container p-0">
                                    <img src="{{ asset('images/users/king_sold/' . $item->image) }}" width="100%"
                                        width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif --}}
@endsection
@section('scripts')
    <script src="{{ asset('promo/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        function rekrutSuccess(id)
    {
        var comment = $(`#rekruting${id}`).val();

        if(comment.length > 5)
        {
            $('.rekrutbutton').addClass('d-none');
            $('.rekrutbutton2').removeClass('d-none');
            $(`.rekrutinput${id}`).val(1);
            $(`#rekrutform${id}`).submit();
        }

    }
    function rekrutCancel(id)
    {
        var comment = $(`#rekruting${id}`).val();

        if(comment.length > 5)
        {
            $('.rekrutbutton').addClass('d-none');
            $('.rekrutbutton2').removeClass('d-none');
            $(`.rekrutinput${id}`).val(2);
            $(`#rekrutform${id}`).submit();
        }

    }
        $(function() {
            $('[data-toggle="popover"]').popover()
        })

        function teachStar($i) {
            $('.allteachstar').css('color', 'white');
            $('#teachstarinput').val($i);
            for (let index = 1; index <= $i; index++) {
                $(`#teachstar${index}`).css('color', '#d4ed3c');
            }
        }
        $(document).ready(function() {
            $("#kingliga-btn").click();
            $("#recommendNews-btn").click();
            var first = <?php echo json_encode(Auth::user()->first_enter); ?>;
            if (first == 0) {
                // $('#firstenter').click();
            }
            var shogird = <?php echo json_encode(count(getShogird())); ?>;


            if (shogird > 0) {
                // $('#firstview').click();
            }
            // getShogird
        });

        function firstSuccess() {
            var _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/first-success",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#first-close').click();
                }
            });
        }

        function firstViewSuccess() {
            var _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/first-view",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#first-view-close22').click();
                }
            });
        }

        function teachStar($i) {
            $('.allteachstar').css('color', 'white');
            $('#teachstarinput').val($i);
            for (let index = 1; index <= $i; index++) {
                $(`#teachstar${index}`).css('color', '#d4ed3c');
            }
        }


        function upModal(id) {
            $(`#user-profil${id}`).click();
        }

        function ksCheck(id, b, e) {
            $(`#kscheck${id}${b}${e}`).click();
        }
    </script>
    <script>
        $(function() {
            $('[data-mask]').inputmask()
        });
        var dday = <?php echo json_encode(date('d', strtotime(getKSDay()['this_end']))); ?>;
        var dname = <?php echo json_encode(date('F', strtotime(getKSDay()['this_end']))); ?>;
        var countDownDate = new Date(dname + " " + dday + ", 2023 23:59:59").getTime();

        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("count-timer-day").innerHTML = days;
            document.getElementById("count-timer-hour").innerHTML = hours;
            document.getElementById("count-timer-minut").innerHTML = minutes;
        }, 1000);

        var countDownDate2 = new Date(dname + " " + dday + ", 2023 23:59:59").getTime();


        var x2 = setInterval(function() {

            // Get today's date and time
            var now2 = new Date().getTime();

            var distance2 = countDownDate2 - now2;
            var days2 = Math.floor(distance2 / (1000 * 60 * 60 * 24));
            var hours2 = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes2 = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
            var seconds2 = Math.floor((distance2 % (1000 * 60)) / 1000);
            document.getElementById("count-timer-day2").innerHTML = days2;
            document.getElementById("count-timer-hour2").innerHTML = hours2;
            document.getElementById("count-timer-minut2").innerHTML = minutes2;
        }, 1000);
    </script>
    <script>
        $(function() {
            var img = $('.imgvvv'),
                imgshow = $('#imgshowimg'),
                overly = $('#overimg'),
                close = $('#closeimg');
            img.on('click', function() {
                overly.show();
                imgshow.attr('src', $(this).attr('src'));
                close.click(function() {
                    overly.hide();
                });
            });
        });

        function changeTextPlan() {
            $('.for-plan-text-active').addClass('d-none');
            $('.for-plan-text').removeClass('d-none');
        }

        function clickPlan() {
            $('.click-plan').click();
            changeReytingTab(2);
            changeReytingTab(2);
            changeReytingTab(2);
        }

        function openKassa() {
            $(".kassa-input").each(function() {
                $(this).val(0);
                $('.summa-zakaz').text(0);
            })

        }

        
        
        function changeReytingTab23(number) {
            $('.reyting-tab-class23').removeClass('reyting-tab-active23');
            $('.reyting-tab-class23').addClass('reyting-tab23');

            $(`.reyting-tab${number}`).removeClass('reyting-tab23');
            $(`.reyting-tab${number}`).addClass('reyting-tab-active23');
        }

        function changeKingSoldTab(number) {
            $(`.king-sold-tab${number}`).removeClass('king-sold-tab');
            $(`.king-sold-tab${number}`).addClass('king-sold-tab-active');
            if (number == 2) {
                $('.king-sold-tab1').addClass('king-sold-tab');
                $('.king-sold-tab1').removeClass('king-sold-tab-active');

                $('.king-sold-tab3').addClass('king-sold-tab');
                $('.king-sold-tab3').removeClass('king-sold-tab-active');
            }
            if (number == 3) {
                $('.king-sold-tab1').addClass('king-sold-tab');
                $('.king-sold-tab1').removeClass('king-sold-tab-active');

                $('.king-sold-tab2').addClass('king-sold-tab');
                $('.king-sold-tab2').removeClass('king-sold-tab-active');
            }
            if (number == 1) {
                $('.king-sold-tab2').addClass('king-sold-tab');
                $('.king-sold-tab2').removeClass('king-sold-tab-active');

                $('.king-sold-tab3').addClass('king-sold-tab');
                $('.king-sold-tab3').removeClass('king-sold-tab-active');
            }
        }

        function changeColorReyting(d) {
            $('.delete-reyting-bg').css('background', 'white');
            $(`.${d}`).css('background', '#6a74b570');
        }
    </script>
    <script>
        

        

        
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('.alert-danger').remove();
                $('.alert-success').remove();
            }, 4000);
            $('#choose-file-user').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-user-close').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user-close')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-king-sold').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-king-sold')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            
            // $("#kas").click();

            

            var kingsold = <?php echo json_encode(Session::get('kingSold')); ?>;
            if (kingsold != null) {
                $(`#opencheck${kingsold}`).click();
            }

            var kingsoldcheck = <?php echo json_encode(Session::get('kingCheck')); ?>;
            if (kingsoldcheck != null) {
                $('#openkingchecksold').click();
            }

            // function openCode() {

                

            // }
        });

        

        

        
        function changeDay(number) {
            // console.log(number);
            if (number == 0) {
                $('.first_one').addClass('d-none');
                $('.first_two').removeClass('d-none');
            } else {
                $('.first_two').addClass('d-none');
                $('.first_one').removeClass('d-none');
            }

        }
    </script>
    
@endsection
