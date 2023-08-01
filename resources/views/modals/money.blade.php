<style>
    .zigzak {
        aspect-ratio: 1;
        margin-bottom: 5px;
        background-color: #7681a569;
        -webkit-mask: conic-gradient(from -45deg at bottom, #0000, #000 1deg 89deg, #0000 90deg) 50%/40px 100%;
    }
</style>

<div class="modal fade" id="money" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                </button>
            </div>

            <div class="modal-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="0">
                    <livewire:money-modal>
            </div>
        </div>
    </div>
</div>
