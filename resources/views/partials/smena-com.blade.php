<script>
    $(document).ready(function(){

        $('.live-hisobot').click(function(){
            livewire.emit('for_hisobot');
        });

        $('.live-shogird').click(function(){
            livewire.emit('for_shogird');
            livewire.emit('for_shogirdin');
        });

        $('.live-rekrut').click(function(){
            livewire.emit('for_rekrut');
        });

        // $('.live-teambattle500').click(function(){
        //     livewire.emit('for_teambattle500');
        // });

        var code = makeCode();
        $('input[name=open_code]').val(code);
        $('.open-code').text(code);

    });

    function openCode() {
            var code = makeCode();
            $('input[name=open_code]').val(code);
            $('.open-code').text(code);

        }

        function closeCode() {
            var code = makeCode();
            $('input[name=close_code]').val(code);
            $('.close-code').text(code);
        }

        function makeCode() {

            var sdf = localStorage.getItem('codes');

            var time_storage = localStorage.getItem('time_storage');
            var time_now = $.now();

            if (time_storage) {
                if ((time_now - time_storage) > 900000) {
                    var result = '';
                    var characters = 'ABCDEFGHKLMNPQRSTUVWXYZ';
                    var numbers = '123456789';
                    var charactersLength = characters.length;
                    var numbersLength = numbers.length;
                    for (var i = 0; i < 1; i++) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    for (var i = 0; i < 2; i++) {
                        result += numbers.charAt(Math.floor(Math.random() * numbersLength));
                    }
                    var sdf = localStorage.setItem('codes', result);
                    localStorage.setItem('time_storage', $.now());
                }
            }
            var sdf = localStorage.getItem('codes');

            // console.log($.now());
            if (!sdf) {
                var result = '';
                var characters = 'ABCDEFGHKLMNPQRSTUVWXYZ';
                var numbers = '123456789';
                var charactersLength = characters.length;
                var numbersLength = numbers.length;
                for (var i = 0; i < 1; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                for (var i = 0; i < 2; i++) {
                    result += numbers.charAt(Math.floor(Math.random() * numbersLength));
                }
                var sdf = localStorage.setItem('codes', result);
                localStorage.setItem('time_storage', $.now());
            }

            return sdf;

        }

        function minus($id) {
            var stock = parseInt($(`.product${$id}`).val());
            if (stock <= 1) {
                $(`.product-border${$id}`).removeClass('plus-border');
                $(`.product-border${$id}`).addClass('product-border')
            }
            if (stock != 0) {
                ;
                $(`.product${$id}`).val(stock - 1);
                var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g, ''));

                var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g, ''));

                var allprice = number_format(orderPrice - price, 0, ',', ' ');

                $('.summa-zakaz').text(allprice);
            }

        }

        function plus($id) {
            var stock = parseInt($(`.product${$id}`).val());
            $(`.product${$id}`).val(stock + 1);
            var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g, ''));
            var orderPrice = parseInt($('.summa-zakaz').text().replace(/[^0-9]/g, ''));

            console.log(orderPrice);

            var allprice = number_format(price + orderPrice, 0, ',', ' ');

            $('.summa-zakaz').text(allprice);
            $(`.product-border${$id}`).addClass('plus-border');
            $('.plus-border').removeClass('product-border');

        }

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = number.toFixed(decimals);

            var nstr = number.toString();
            nstr += '';
            x = nstr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? dec_point + x[1] : '';
            var rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

            return x1 + x2;
        }

        $("#submitSold").click(function() {
                $("#soldForm").submit();
                $("#submitSold").addClass('d-none');
                $("#close-zakaz").removeClass('d-none');
        });

        var check = <?php echo json_encode(Session::get('checksold')); ?>;
            if (check != null) {
                $("#check").click();
            }
</script>