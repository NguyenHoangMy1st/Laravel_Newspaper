@extends('admin.layouts.app_admin_master')
@section('content')
    <main role="main" class="container-fluid">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-2">Thêm mới menu</h6>
            @include('admin.menu.form')
        </div>
    </main>
@stop
