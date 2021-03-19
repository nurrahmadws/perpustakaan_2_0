@extends('admin.template.app')
@section('title')
Author
@endsection
@section('content')
    @section('breadcrumb')
        <li class="breadcrumb-item" aria-current="page">Master</li>
        <li class="breadcrumb-item active" aria-current="page">Author</li>
    @endsection
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">List Author</h3>
                    <div class="card-tools">
                        <a data-toggle="modal" data-target="#modal-default" class="btn btn-sm btn-primary" title="Tambah Author" style="color: whitesmoke"><i class="fas fa-plus" style="color: whitesmoke"></i> Tambah Author</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Author</th>
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
    @include('admin.master.author.create')
    @include('admin.master.author.edit')
    @include('admin.master.author.delete')
@endsection
@push('js')
    <script src="{{asset('management/master/author.js')}}"></script>
@endpush
