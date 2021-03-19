@extends('admin.template.app')
@section('title')
    Permissions
@endsection
@section('content')
    @section('breadcrumb')
        <li class="breadcrumb-item" aria-current="page">Management</li>
        <li class="breadcrumb-item" aria-current="page">Hak Akses</li>
        <li class="breadcrumb-item active" aria-current="page">Permission</li>
    @endsection
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">List Permission</h3>
                    <div class="card-tools">
                        <a data-toggle="modal" data-target="#modal-default" class="btn btn-sm btn-primary" title="Tambah Permission" style="color: whitesmoke"><i class="fas fa-plus" style="color: whitesmoke"></i> Tambah Permission</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Permission</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.role_management.permission.create')
    @include('admin.role_management.permission.edit')
    @include('admin.role_management.permission.delete')
@endsection
@push('js')
    <script src="{{asset('management/role_management/permission.js')}}"></script>
@endpush
