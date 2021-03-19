@extends('admin.template.app')
@section('title')
Jenis Pengadaan
@endsection
@section('content')
    @section('breadcrumb')
        <li class="breadcrumb-item" aria-current="page">Master</li>
        <li class="breadcrumb-item active" aria-current="page">Jenis Pengadaan</li>
    @endsection
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">List Jenis Pengadaan</h3>
                    <div class="card-tools">
                        <a data-toggle="modal" data-target="#modal-default" class="btn btn-sm btn-primary" title="Tambah Jenis Pengadaan" style="color: whitesmoke"><i class="fas fa-plus" style="color: whitesmoke"></i> Tambah Jenis Pengadaan</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.master.procurement.create')
    @include('admin.master.procurement.edit')
    @include('admin.master.procurement.delete')
@endsection
@push('js')
    <script src="{{asset('management/master/procurement.js')}}"></script>
@endpush
