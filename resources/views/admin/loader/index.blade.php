@extends('admin.layouts.app')
@section('admin')


    <div class="main-container">
        <!-- page content start -->
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-block px-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Rasm o'zgartirish
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <form action="{{route('loader.store')}}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="card-body">
                                <div class="form-group float-label position-relative">
                                    <label for="exampleFormControlInput2">Rasm tanlang</label>
                                <input type="file" class="form-control is-invalid" name="image">
                                </div>
                            </div>
                            <div class="container mb-2">
                                <button type="submit" class="btn btn-default btn-block rounded">Saqlash</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
