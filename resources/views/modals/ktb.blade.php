@foreach (kuratorRegion() as $key => $item)
<div class="modal fade" id="ktb{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: #94b5dfe8">
            <div class="modal-header p-0 pb-4" style="background: #a4adb8">
                <div class="container p-0"
                    style="background: #2d6ace;border-top:5px solid #e3b456;border-bottom:5px solid #e3b456">
                    <span class="supercell text-white pl-3" style="font-size:25px;">Jamoaviy jang</span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="opacity: 5;position:absolute;top:8px;right:10px;">
                    <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="container h-100 pl-0 pr-0">
    
                            <div class="row p-4">
                                @livewire('team-battle', ['user_id' => $key], key($key))
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach