@extends('layouts.app')
@section('content')
    
<div class="main-container overflow-auto product-margin">

    <div class="container bg-default-light mb-4 py-3 overflow-auto" >
        
        <div class="row">
            <form action="{{route('order.store')}}" method="POST" style="display: contents !important;" id="myForm">
                @csrf
            @foreach ($products as $item)
            
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="bottom-left m-2">
                            <button type="button" class="btn btn-sm btn-default rounded">Bonus: <span class="product-bonus{{$item->id}}">{{number_format($item->bonus,0,',',' ')}}</span></button>
                        </div>
                        <figure class="background">
                            <img src="{{asset('images/'.$item->image)}}" alt="">
                        </figure>
                    </div>
                    <div class="card-body ">
                        {{-- <p class="mb-0"><small class="text-secondary">Rockstar</small></p> --}}
                        <a href="product.html">
                            <p class="mb-0">{{$item->name}}</p>
                        </a>
                        <a href="product.html">
                            <p class="mb-0"><span class="product-price{{$item->id}}">{{number_format($item->price,0,',',' ')}}</span></p>
                        </a>
                        <div class="container">

                        <div class="btn-group mb-2" role="group" aria-label="Basic example">
                            <button type="button" onclick="minus({{$item->id}})" class="btn btn-sm btn-danger">-</button>
                            <input type="number" name="{{$item->id}}" value="0" class="form-control product{{$item->id}}" style="border-radius: 0px;">

                            {{-- <button type="button" class="product{{$item->id}} btn btn-sm btn-secondary">0</button> --}}
                            <button type="button" onclick="plus({{$item->id}})" class="btn btn-sm btn-primary">+</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </form>


        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("#submitBtn").click(function(){        
            $("#myForm").submit(); // Submit the form
        });
    });
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
    function minus($id)
    {
        var stock = parseInt($(`.product${$id}`).val());
        if(stock != 0)
        {
            $(`.product${$id}`).val(stock-1);
            var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g,''));
            var bonus = parseInt($(`.product-bonus${$id}`).text().replace(/[^0-9]/g,''));

            var orderPrice = parseInt($('.summa-header').text().replace(/[^0-9]/g,''));
            var orderBonus = parseInt($('.bonus-header').text().replace(/[^0-9]/g,''));

            var allprice = number_format(orderPrice-price, 0, ',', ' ');
            var allbonus = number_format(orderBonus-bonus, 0, ',', ' ');

            $('.order-header').css('display','');
            $('.summa-header').text(allprice);
            $('.bonus-header').text(allbonus);
            var orderPrice = parseInt($('.summa-header').text());
            if(orderPrice == 0)
            {
                $('.order-header').css('display','none');
                $('.product-margin').css('margin-top','0%');
            }
        }
        
    }
    function plus($id)
    {
        var stock = parseInt($(`.product${$id}`).val());
        $(`.product${$id}`).val(stock+1);
        var price = parseInt($(`.product-price${$id}`).text().replace(/[^0-9]/g,''));
        var bonus = parseInt($(`.product-bonus${$id}`).text().replace(/[^0-9]/g,''));

        var orderPrice = parseInt($('.summa-header').text().replace(/[^0-9]/g,''));
        var orderBonus = parseInt($('.bonus-header').text().replace(/[^0-9]/g,''));

        var allprice = number_format(price+orderPrice, 0, ',', ' ');
        var allbonus = number_format(bonus+orderBonus, 0, ',', ' ');

        $('.order-header').css('display','');
        $('.product-margin').css('margin-top','35%');
        $('.summa-header').text(allprice);
        $('.bonus-header').text(allbonus);
    }
</script>
@endsection

