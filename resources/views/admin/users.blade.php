@extends('admin.layouts.app')
@section('admin')
    <style>
        .header,
        .footer {
            display: none;
        }

        .main {
            padding-top: 40px;
        }

        .contact {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 50px;
            text-overflow: ellipsis;
            border: 1px solid #ccc;
        }
    </style>
    <div class="content mt-1 main-wrapper">
        <div class="row align-items-center">
            <div class="col-6 mb-3">
                <input id="searchSectionInput" type="text" class="form-control form-control-sm rounded-1 rounded"
                    placeholder="Qidirish...">
            </div>
            <div class="col-6 mb-3">
                <button class="btn btn-primary w-100 btn-sm" onclick="searchUser()">Search</button>
            </div>
            <div class="col-sm-12" id="top-elchilar">
                <div class="text-center"><h4>Top elchilar</h4></div>
                <div class="card-body px-0">
                    <div class="table-responsive border ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>FIO</th>
                                    <th>pr</th>
                                    <th>username</th>
                                    <th>login</th>
                                </tr>
                            </thead>
                            <tbody id="top-users">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="text-center"><h4>Hamma elchilar</h4></div>
                <div class="card-body px-0">
                    <div class="table-responsive border ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>FIO</th>
                                    <th>pr</th>
                                    <th>username</th>
                                    <th>login</th>
                                </tr>
                            </thead>
                            <tbody id="admin-users">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    window.onload = function() {
        getUsers('all')
    }

    function searchUser() {
        let myInput = document.getElementById('searchSectionInput');
        getUsers(myInput.value)
    }

    function getUsers(value) {
        let admin_users = document.getElementById('admin-users');
        $.ajax({
            url: `/admin/searchUsers?search=${value}`,
            dataType: "json",
            type: "GET",
            async: true,
            success: function(data) {
                addData(data);
                if(value !== 'all') {
                    $('#top-elchilar').empty();
                }
            }
        })
    }
    function addData(data) {
        $('#admin-users').empty();
        $('#top-users').empty();
        var all = data.users;
        var top = data.top;
        all.forEach(item => {
            $('#admin-users').append(`
                <tr>
                    <td>${item.first_name} ${item.last_name}</td>
                    <td>${item.pr}</td>
                    <td>${item.username}</td>
                    <td>
                        <form class="form" action="{{ route('login') }}" method="POST" style="margin-block-end: 0">
                            @csrf
                            <input type="text" name="username" value="${item.username}" class="d-none">
                            <input type="number" name="password" value="${item.pr}" class="d-none">
                            <button type="submit" class="btn btn-primary btn-sm">login</button>
                        </form>
                    </td>
                </tr>
                    `)
        })
        top.forEach(item => {
            $('#top-users').append(`
                <tr>
                    <td>${item.first_name} ${item.last_name}</td>
                    <td>${item.pr}</td>
                    <td>${item.username}</td>
                    <td>
                        <form class="form" action="{{ route('login') }}" method="POST" style="margin-block-end: 0">
                            @csrf
                            <input type="text" name="username" value="${item.username}" class="d-none">
                            <input type="number" name="password" value="${item.pr}" class="d-none">
                            <button type="submit" class="btn btn-primary btn-sm">login</button>
                        </form>
                    </td>
                </tr>
                    `)
        })
    }
</script>
