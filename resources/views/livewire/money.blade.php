<div>
    {{-- <p> {{intval(date('d',strtotime($dat[0])))}} fevral ></p> --}}
    @if (strlen($dat[0]) == 5)
     @php
         $text = 'Bugun';
         $text_date = intval(date('d'));
     @endphp
        
    @else
        @if (intval(date('d',strtotime($dat[0]))) == intval(date('d')))
            @php
            $text = 'Bugun';
            $text_date = intval(date('d'));
        @endphp
        @else
        @php
         $text = intval(date('d',strtotime($dat[0]))).'may';
         $text_date = intval(date('d',strtotime($dat[0])));

     @endphp
        @endif
    @endif
    
    {{-- <p data-toggle="modal" data-target="#money">  </p> --}}
    <button type="button" class="btn btn-sm" data-toggle="modal" onclick="liveMoneyModal()" data-target="#money">
        <span style="color:white;font-size:17px;" >{{$text}} > </span>
    </button>

    <p class="p-0 m-0" style="font-size:30px;"> {{number_format($dat[1],0,',',' ')}} so'm</p>
    <p> {{$dat[2]}} ta mijoz </p>
    <div class="row">
        @php
            $ikd = 0;
        @endphp
        @foreach ($arr[1] as $key => $value)
        @php
        $ffss = $value;
            if( $ffss== 0)
            {
                $pixel = 100;
            }else{
                if($ffss >= 1000000)
                {
                    $pixel =  number_format($ffss/1000000,2);
                }
                elseif($ffss >= 300000)
                {
                    $pixel =  100 - (number_format($ffss/10000,2)*number_format($ffss/10000,2))/14;
                }
                elseif($ffss >= 100000)
                {
                    $pixel =  100 - (number_format($ffss/10000,2)*number_format($ffss/10000,2))/8;
                }
                else
                {
                    $pixel = 100 - number_format($ffss/10000,2);
                }
            }
            if($pixel < -20)
            {
                $pixel = -20;
            }
        @endphp
            @if ($ikd==0)
            <div class="mr-1 ml-3" style="border-top:2px solid red;flex: 0 0 12.271%;max-width: 12.271%;padding-right:0px;padding-left:1px;background:yellowgreen;margin-top:{{$pixel}}px;">
                {{numb($value)}}
                {{-- {{$ffss}} --}}
            </div> 
            @else
                <div class="mr-1" style="border-top:2px solid red;flex: 0 0 12.271%;max-width: 12.271%;padding-right:0px;padding-left:1px;background:yellowgreen;margin-top:{{$pixel}}px;">
                    {{numb($value)}}
                </div> 
            @endif
            @php
                $ikd += 1;
            @endphp
        @endforeach
        @php
            $ik = 0;
        @endphp
        @foreach ($arr[0] as $key => $value)
            @if ($ik == 0)
                @if (intval(date('d',strtotime($key))) == $text_date)
                <div class="mr-1 ml-3 mt-2" wire:click="$emit('teams',{{strtotime($key)}})" style="border-radius:6px;background: white;flex: 0 0 12.271%;max-width: 12.271%;padding-right:0px;padding-left:1px;">
                    <div style="color:black;">
                        {{$value}}
                    </div> 
                    <div style="color:black;">
                        {{date('d',strtotime($key))}}
                    </div>
                </div>
                @else
                    <div class="mr-1 ml-3 mt-2" wire:click="$emit('teams',{{strtotime($key)}})" style="border-radius:6px;background: #bcbcbc;flex: 0 0 12.271%;max-width: 12.271%;padding-right:0px;padding-left:1px;">
                        <div style="color:black;">
                            {{$value}}
                        </div> 
                        <div style="color:black;">
                            {{date('d',strtotime($key))}}
                        </div>
                    </div>
                @endif
            @else
                @if (intval(date('d',strtotime($key))) == $text_date)
                    <div class="mr-1 mt-2" wire:click="$emit('teams',{{strtotime($key)}})" style="border-radius:6px;background: white;flex: 0 0 12.271%;max-width: 12.271%;padding-right:0px;padding-left:1px;">
                        <div style="color:black;">
                            {{$value}}
                        </div> 
                        <div style="color:black;">
                            {{date('d',strtotime($key))}}
                            {{-- {{date('Y-m-d',strtotime($key))}} --}}
                        </div>
                    </div>
                @else
                <div class="mr-1 mt-2" wire:click="$emit('teams',{{strtotime($key)}})" style="border-radius:6px;background: #bcbcbc;flex: 0 0 12.271%;max-width: 12.271%;padding-right:0px;padding-left:1px;">
                    <div style="color:black;">
                        {{$value}}
                    </div> 
                    <div style="color:black;">
                        {{date('d',strtotime($key))}}
                        {{-- {{date('Y-m-d',strtotime($key))}} --}}
                    </div>
                </div>
                @endif
            @endif
            @php
                $ik += 1;
            @endphp
        @endforeach
    </div>
</div>
