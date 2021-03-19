@extends('admin.template.app')
@section('title')
Book
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('assets/form_wizard/css/style.css')}}"> --}}
    {{-- <style>
        .modal-open .select2-dropdown {
            z-index: 10060;
        }

        .modal-open .select2-close-mask {
            z-index: 10055;
        }
    </style> --}}
@endsection
@section('content')
    @section('breadcrumb')
        <li class="breadcrumb-item active" aria-current="page">Buku</li>
    @endsection
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title t_class_list">List Buku</h3>
                    <h3 class="card-title t_class" style="display: none;">Tambah Buku</h3>
                    <div class="card-tools">
                        @if (auth()->user()->hasAnyRole('admin|staff_teknis|staff_pengadaan_buku'))
                            <a class="btn btn-sm btn-primary btn_crt_book" title="Tambah Buku" style="color: whitesmoke"><i class="fas fa-plus" style="color: whitesmoke"></i> Tambah Buku</a>
                            <a class="btn btn-sm btn-danger btn_cancel_book" title="Batal" style="color: whitesmoke; display:none;"><i class="fas fa-window-close" style="color: whitesmoke"></i> Batal</a>
                        @endif
                    </div>
                </div>
                <div class="card-body index_c">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Judul Buku</th>
                                    {{-- <th>Penerbit</th>
                                    <th>Tahun Terbit</th> --}}
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Barcode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                @include('admin.master.book.create')
            </div>
        </div>
    </div>
    @include('admin.master.book.delete')
    @include('admin.master.author.create')
@endsection
@push('js')
    <script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('management/master/book.js')}}"></script>
@endpush
