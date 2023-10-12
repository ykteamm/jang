<button type="button" class="btn pr-0 p-0 live-turnir" data-toggle="modal" data-target="#turnir" style="position: relative">
    
    @if (!in_array(Auth::user()->rm,[1,2]))

    {{-- <div style="position: absolute;top:89px;left:16px;width:160px;height:20px;color:#fff;overflow:hidden"
        class="supercell d-flex align-items-center justify-content-center">
        @if ($turnir)
            @if (Auth::user()->first_name == $team1names[0]->first_name)
                <div>
                    {{ substr($team1names[0]->first_name, 0, 3) }}{{ ' + ' }}{{ substr($team1names[1]->first_name, 0, 3) }}
                </div>
            @else
                <div>
                    {{ substr($team1names[1]->first_name, 0, 3) }}{{ ' + ' }}{{ substr($team1names[0]->first_name, 0, 3) }}
                </div>
            @endif
        @else
            <div class="text-center">
                TEZ ORADA
            </div>
        @endif
    </div> --}}
    {{-- <div style="position: absolute;top:89px;right:15px;width:54px;height:20px;color:#fff"
        class="supercell d-flex align-items-center justify-content-center">
        <div>
            {{ $point }}
        </div>
    </div> --}}
    @endif

    <img src="{{ asset('mobile/turnir/mtlogo.webp') }}" class="for-media-shox" width="230px" alt=""
        style="margin-left:10px">

</button>
