<div class="modal fade" id="planuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <img src="{{asset('mobile/ligam.webp')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
            </div>
            <div class="modal-body p-0">

            <div class="container p-0">

                <ul class="nav nav-tabs mr-2 ml-2" id="myTab" role="tablist">
                    <li class="nav-item active reyting-tab-active reyting-tab1  reyting-tab-class" onclick="changeReytingTab(1)">
                      <a class="supercel-text-stroke text-center align-items-center" id="home-tabw2" data-toggle="tab" href="#homew2" role="tab" aria-controls="homew2" aria-selected="true">Liga</a>
                    </li>
                    <li class="nav-item reyting-tab reyting-tab2 reyting-tab-class live-plan" onclick="changeReytingTab(2)">
                      <a class="supercel-text-stroke text-center align-items-center" id="profile-tabw2" data-toggle="tab" href="#profilew2" role="tab" aria-controls="profilew2" aria-selected="false">Plan</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active " id="homew2" role="tabpanel" aria-labelledby="home-tabw2" style="background: #677e97">
                        <livewire:liga />
                    </div>
                    <div class="tab-pane fade" id="profilew2" role="tabpanel" aria-labelledby="profile-tabw2" style="background: #fff;">
                        <div class="mb-3 pt-3">
                            <livewire:plan />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
