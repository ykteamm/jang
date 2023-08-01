@extends('layouts.app')
@section('content')
<div class="container h-100">
    <div class="col align-self-center pl-0 pr-0">
        <div class="container mb-4 pl-0 pr-0">
            <div class="row">
                @foreach ($shifts as $item)
                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center text-center">
                                    <div class="col-6 align-self-center">
                                        <h6 class="mb-1">Dorixona</h6>
                                        <p class="small text-secondary">{{$item->pharmacy->name}}</p>
                                    </div>
                                    <div class="col-auto align-self-center border-left">
                                        <h6 class="mb-1">Smena ochilgan</h6>
                                        <p class="small text-secondary">{{date('d.m.Y H:m',strtotime($item->created_at))}}</p>
                                    </div>
                                    <div class="col-12 align-self-center mt-3">
                                        <button type="button" class="btn btn-info btn-block rounded m-2" data-toggle="modal" data-target="#smenaclose">
                                            Smena yopish
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col align-self-center">
        <div class="container mb-4">
            <div class="card-body mb-3">
                    
                    <button type="button" class="btn btn-success btn-block rounded m-2" data-toggle="modal" data-target=" @if(count($shifts) == 0) #smena @else #nosmena @endif">
                        Smena ochish
                    </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="smena" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Smena ochish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <form method="post" action="{{route('shift.open')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group text-center">
                        <label for="exampleFormControlSelect1">Dorixona tanlang</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="pharmacy" required>
                                <option disabled selected hidden></option>
                            @foreach ($pharmacy as $item)
                                <option value="{{$item->pharmacy->id}}">{{$item->pharmacy->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <label>Smena ochish kodi: {{$shift_code->open}}</label>
                    </div>
                    <div class="form-group text-center btn-block">
                        <label for="choose-file-user" class="custom-file-upload" id="choose-file-label-user">
                            Selfi
                        </label>    
                        <input name="open_selfi" type="file" id="choose-file-user" 
                        accept=".jpg,.jpeg,.png" style="display: none;" required/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success btn-block rounded m-2">
                            Smena ochishni saqlash
                        </button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
            </div>
        </div> 
    </div>
</div>
<div class="modal fade" id="nosmena" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Smena ochish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <div class="form-group text-center">
                        <label for="exampleFormControlSelect1">Ochilgan smenangizni yoping</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
            </div>
        </div> 
    </div>
</div>
<div class="modal fade" id="smenaclose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Smena ochish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <form method="post" action="{{route('shift.close')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group text-center">
                        <label>Smena yopish kodi: @if(isset($shift_close_code)) {{$shift_close_code->close}} @endif</label>
                    </div>
                    <div class="form-group text-center btn-block">
                        <label for="choose-file-user-close" class="custom-file-upload" id="choose-file-label-user">
                            Selfi
                        </label>    
                        <input name="close_selfi" type="file" id="choose-file-user-close" 
                        accept=".jpg,.jpeg,.png" style="display: none;" required/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success btn-block rounded m-2">
                            Smena yopishni saqlash
                        </button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
            </div>
        </div> 
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#choose-file-user').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user')[0].files[0].name;
                $(this).prev('label').text(file);
            });
            $('#choose-file-user-close').change(function () {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file-user-close')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
    </script>
@endsection

