@extends('admin.template.app')
@section('title')
Mata Uang
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <style>
        .modal-open .select2-dropdown {
            z-index: 10060;
        }

        .modal-open .select2-close-mask {
            z-index: 10055;
        }
    </style>
@endsection
@section('content')
    @section('breadcrumb')
        <li class="breadcrumb-item" aria-current="page">Master</li>
        <li class="breadcrumb-item active" aria-current="page">Mata Uang</li>
    @endsection
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">List Mata Uang</h3>
                    <div class="card-tools">
                        <a data-toggle="modal" data-target="#modal-default" class="btn btn-sm btn-primary" title="Tambah Mata Uang" style="color: whitesmoke"><i class="fas fa-plus" style="color: whitesmoke"></i> Tambah Mata Uang</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Simbol</th>
                                    <th>Status</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Diperbaharui Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.master.currency.create')
    @include('admin.master.currency.edit')
    @include('admin.master.currency.delete')
@endsection
@push('js')
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('management/master/currency.js')}}"></script>
@endpush
