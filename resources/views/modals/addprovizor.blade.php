<div class="modal fade" id="addprovizor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5">
                    <img src="{{asset('mobile/xclose.png')}}" width="30px">
                </button>
            </div>
            <form method="post" action="{{route('add.provizor')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="form-group text-center">
                        <label>Ismi:
                            <span class="open-code"></span>
                        </label>
                        <input type="text" name="first_name" class="form-control" required id="profirst">

                    </div>
                    <div class="form-group text-center">
                        <label>Familiyasi:
                        </label>
                        <input type="text" name="last_name" class="form-control" required id="prolast">

                    </div>
                    <div class="form-group text-center">
                        <label>Telefon raqami:
                        </label>
                        <input type="text" class="form-control" id="prophone" data-inputmask='"mask": "(99) 999-99-99"' data-mask name="phone_number" required>

                    </div>
                    <div class="form-group text-center">
                        <label for="exampleFormControlSelect1">Viloyat tanlang</label>
                        <select class="form-control" id="proregion" name="provizor_region" onchange="getRegionP()" required>
                                <option disabled selected hidden></option>
                            @foreach (getAllRegion() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label for="exampleFormControlSelect1">Tuman tanlang</label>
                        <select class="form-control" id="prodistrict" name="district_id" required>
                                <option disabled selected hidden></option>
                            @foreach (getAllDistrict() as $item)
                                <option value="{{$item->id}}" class="all-dist-p pdist{{$item->region_id}} d-none">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group text-center" id="for-pro-select-p2">
                        <label for="exampleFormControlSelect1">Dorixona tanlang</label>
                        <select class="form-control" id="propharm" name="pharmacy_id" onchange="deleteAddP()" required>
                                <option disabled selected hidden></option>
                            @foreach (getAllPharmacy() as $item)
                                <option value="{{$item->id}}" class="all-pharm-p pharm{{$item->region_id}} d-none">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group text-center d-none" id="for-pro-add-p2">
                        <label style="color: blue;">Ish joyini kiriting:</label>
                        <input type="text" name="apteka" class="form-control" id="propharm" required>
                    </div>
                    {{-- <div class="form-group text-center" id="for-pro-addit-p2">

                        <h6>Agar siz tanlayotgan dorixona bizda bo'lmasa <span style="color:blue;">'Dorixona qo'shish'</span> tugmasini bosib yangi dorixona qo'shishingiz mumkin.</h6>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" onclick="addProP()">Dorixona qo'shish</button>
                        </div>
                    </div> --}}

                </div>
            </div>
            <div class="modal-footer" id="for-open-smena-user-none" onclick="validPro()">
                <button type="submit" class="btn btn-success">Saqlash</button>
            </div>
            {{-- <div class="modal-footer" id="for-open-smena-user-none">
                <button type="submit"
                onclick="$('#for-open-smena-user-none').addClass('d-none');$('#for-open-smena-user').removeClass('d-none');"
                class="btn btn-success">Saqlash</button>
            </div> --}}
            <div class="modal-footer d-none" id="for-open-smena-user">
                <button type="button" class="btn btn-primary">Biroz kuting !!!</button>
            </div>
            </form>
        </div>
    </div>
</div>
