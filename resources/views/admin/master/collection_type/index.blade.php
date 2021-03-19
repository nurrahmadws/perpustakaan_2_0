@extends('admin.template.app')
@section('title')
Jenis Koleksi
@endsection
@section('content')
    @section('breadcrumb')
        <li class="breadcrumb-item" aria-current="page">Master</li>
        <li class="breadcrumb-item active" aria-current="page">Jenis Koleksi</li>
    @endsection
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">List Jenis Koleksi</h3>
                    <div class="card-tools">
                        <a data-toggle="modal" data-target="#modal-default" class="btn btn-sm btn-primary" title="Tambah Jenis Koleksi" style="color: whitesmoke"><i class="fas fa-plus" style="color: whitesmoke"></i> Tambah Jenis Koleksi</a>
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
    @include('admin.master.collection_type.create')
    @include('admin.master.collection_type.edit')
    @include('admin.master.collection_type.delete')
@endsection
@push('js')
    <script src="{{asset('management/master/collection_type.js')}}"></script>
@endpush
