<div class="modal fade" id="recommendNews" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-scrollable h-100" role="document">
        <div class="modal-content h-100" style="background: #002bff17 !important">
            <div class="modal-header p-0" style="position:relative;height:50px;background:#384b5e">
                <button type="button" class="close" data-dismiss="modal" aria-label="allNews"
                    style="opacity: 5;position:absolute;top:8px;right:10px;z-index:20">
                    <img src="{{ asset('mobile/news/close.png') }}" width="30px">
                </button>
                <div class="supercell d-flex align-items-center justify-content-center"
                    style="position:absolute;top:0px;left:0;right:0;font-size:22px">
                    <div class="pl-4 text-white pt-2"
                        style="text-shadow: -1px 4px 0 #000, 3px 1px 0 #000, 3px -1px 0 #000, -1px -1px 0 #000">
                        Xabar</div>
                </div>
            </div>
            <div class="modal-body" style="background: #090d22c2">
                @if (Session::get('recommendNews'))
                    <div class="card border rounded">
                        <div class="card-header supercell">
                            {{ Session::get('recommendNews')->title }}
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <img width="100px" src="{{ Session::get('recommendNews')->img }}" alt="">
                                </div>
                                <div class="col-8 supercell">
                                    <?php echo htmlspecialchars_decode(htmlentities(substr(Session::get('recommendNews')->desc, 0, 50))); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-6 text-center">
                                <button onclick="showNw({{ Session::get('recommendNews')->id }})" data-toggle="modal" data-target="#showNws" class="btn w-90 btn-primary">Ko'proq</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
