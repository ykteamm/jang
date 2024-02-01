<script>
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
    $(document).ready(function(){
        
        $(".live-reyting").click(function(){
            livewire.emit('for_reyting');
        });

        $(".live-region").click(function(){
            livewire.emit('for_region');
        });

        $(".live-turnir").click(function(){
            livewire.emit('for_turnir');
        });

        $(".live-plan").click(function(){
            livewire.emit('for_plan');
        });

        $(".live-liga").click(function(){
            livewire.emit('for_liga');
        });

        $('.live-market').click(function(){
            livewire.emit('for_market');
        });

        $('.live-history-crystal').click(function(){
            livewire.emit('for_history_crystal');
        });
        


        getUserCrystall()


        setTimeout(function() { 
            livewire.emit('for_turnir');
        }, 4000);


        setTimeout(function() { 
                livewire.emit('for_profil'); 
                livewire.emit('for_money'); 
        }, 2500);

        setTimeout(function() { 
                // livewire.emit('for_teambattle'); 
                // livewire.emit('for_rekrut'); 
                // var rekrut_count = <?php echo json_encode(count(getRekrut())); ?>;
                // if(rekrut_count > 0)
                // {
                    // $('.live-rekrut').click();
                // }
        }, 2000);
        
        setTimeout(function() { 
                // livewire.emit('for_info'); 
        }, 3000);

        
    });
    
    function showRegion(id) {
        livewire.emit('regionlive',id);
    }


    function upModal(id) {
        livewire.emit('profiluserlive',id);
    }

    function changeReytingTabrey(number) {
        $('.reyting-tab-class').removeClass('new-reyting-tab-active');
        $('.reyting-tab-class').addClass('new-reyting-tab');

        $(`.reyting-tab${number}`).removeClass('new-reyting-tab');
        $(`.reyting-tab${number}`).addClass('new-reyting-tab-active');
    }

    function changeReytingTab(number) {
        $('.reyting-tab-class').removeClass('reyting-tab-active');
        $('.reyting-tab-class').addClass('reyting-tab');

        $(`.reyting-tab${number}`).removeClass('reyting-tab');
        $(`.reyting-tab${number}`).addClass('reyting-tab-active');
    }

    function getUserCrystall() {
            $.ajax({
                url: '/user-crystall',
                method: 'get',
                contentType: false,
                processData: false,
                success: (response) => {
                    $("#userCrystall").append(`<div>${response}</div>`);
                    $("#userCrystallMain").append(`<div>${response}</div>`);
                }
            })
        }
</script>
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

    function validPro()
    {
        var first = $('#profirst').val();
        var last = $('#prolast').val();
        var phone = $('#prophone').val();
        var region = $('#proregion').val();
        var district = $('#prodistrict').val();
        var pharm = $('#propharm').val();
        if(first.length > 0 && last.length > 0 && phone && region.length > 0 && district.length > 0 && pharm.length > 0)
        {
            $('#for-open-smena-user-none').addClass('d-none');
            $('#for-open-smena-user').removeClass('d-none');
        }
        // console.log(first,last,phone,region,district,pharm)
    }

    function minusPromo($id)
        {
            var proId = [36,37,38,39,29,47,61,62,63,64,65];

            var stock = parseInt($(`.productPro${$id}`).val());
            if(stock <= 1)
            {
                $(`.product-borderPro${$id}`).removeClass('plus-borderPro');
                 $(`.product-borderPro${$id}`).addClass('product-borderPro')
            }
            if(stock != 0)
            {
                 $(`.productPro${$id}`).val(stock-1);
                var price = parseInt($(`.product-pricePro${$id}`).text().replace(/[^0-9]/g,''));

                var orderPrice = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));

                var allprice = number_format(orderPrice-price, 0, ',', ' ');

                $('.summa-zakazPro').text(allprice);

                if(proId.includes($id))
                {

                    var orderPricePro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
                    var allpricePro = number_format(orderPricePro-price, 0, ',', ' ');
                    $('.summa-promoPro').text(allpricePro);


                }

                var allP = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));
                var allPro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
                if(allP == 0)
                    {
                        var p = 0;

                    }else{
                        var p = (allPro*100)/(allP);

                    }

                var pfor = p.toFixed(1);
                $('#promop').text(pfor);

                if(parseInt(p) >= 60)
                {
                    $('.propropro').removeClass('d-none');
                    $('#def-zakazPro').addClass('d-none');
                }else{
                    $('.propropro').addClass('d-none');
                    $('#def-zakazPro').removeClass('d-none');
                }

            }



        }
        function minusPlus()
        {
            var proId = [36,37,38,39,29,47,61,62,63,64,65];

            var allprice = 0;
            var allpricePro = 0;

            $( '.allmp' ).each(function(index) {
                var n = $(this).val();
                if(!n)
                {
                    n = 0;
                }
                allprice += parseInt($(this).attr('narxi'))*parseInt(n)
                if(proId.includes(parseInt($(this).attr('proid'))))
                    {
                        allpricePro += parseInt($(this).attr('narxi'))*parseInt(n)
                    }
            });
            $('.summa-zakazPro').text(allprice);
            $('.summa-promoPro').text(allpricePro);

            var allP = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));
            var allPro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
            if(allP == 0)
            {
                var p = 0;

            }else{
                var p = (allPro*100)/(allP);

            }

                var pfor = p.toFixed(1);


                $('#promop').text(pfor);

                if(parseInt(p) >= 60)
                {
                    $('.propropro').removeClass('d-none');
                    $('#def-zakazPro').addClass('d-none');
                }else{
                    $('.propropro').addClass('d-none');
                    $('#def-zakazPro').removeClass('d-none');
                }

        }
        function plusPromo($id)
        {

            var stock = parseInt($(`.productPro${$id}`).val());
            $(`.productPro${$id}`).val(stock+1);

            var price = parseInt($(`.product-pricePro${$id}`).text().replace(/[^0-9]/g,''));

            var orderPrice = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));
            var allprice = number_format(price+orderPrice, 0, ',', ' ');


            $('.summa-zakazPro').text(allprice);
            $(`.product-borderPro${$id}`).addClass('plus-borderPro');
            $('.plus-borderPro').removeClass('product-borderPro');

            var proId = [36,37,38,39,29,47,61,62,63,64,65];

            if(proId.includes($id))
            {

                var orderPricePro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
                var allpricePro = number_format(price+orderPricePro, 0, ',', ' ');
                $('.summa-promoPro').text(allpricePro);






            }

            var allP = parseInt($('.summa-zakazPro').text().replace(/[^0-9]/g,''));
            var allPro = parseInt($('.summa-promoPro').text().replace(/[^0-9]/g,''));
            if(allP == 0)
            {
                var p = 0;

            }else{
                var p = (allPro*100)/(allP);

            }


                var pfor = p.toFixed(1);


                $('#promop').text(pfor);

                if(parseInt(p) >= 60)
                {
                    $('.propropro').removeClass('d-none');
                    $('#def-zakazPro').addClass('d-none');
                }else{
                    $('.propropro').addClass('d-none');
                    $('#def-zakazPro').removeClass('d-none');
                }
        }

        $("#submitSoldPro").click(function(){
                $("#soldFormPro").submit();
                $("#submitSoldPro").addClass('d-none');
                $("#close-zakazPro").removeClass('d-none');
            });

            function openKassa() {
            $(".kassa-input").each(function() {
                $(this).val(0);
                $('.summa-zakaz').text(0);
            })

        }

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
</script>